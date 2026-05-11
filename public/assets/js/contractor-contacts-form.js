(function () {
    const forms = Array.from(document.querySelectorAll('form')).filter(function (form) {
        const action = form.getAttribute('action') || '';

        return /\/contractors\/contacts\/[0-9]+\/update$/.test(action) || /\/contractors\/[0-9]+\/contacts\/store$/.test(action);
    });

    if (forms.length === 0) {
        return;
    }

    const validationAlert = document.getElementById('contractorContactValidationAlert');

    const fields = {
        full_name: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }

                const normalized = value.trim().replace(/\s+/g, ' ');
                const parts = normalized.split(' ');

                return parts.length === 3 && parts.every(function (part) {
                    return part.length >= 2;
                });
            },
            message: 'ФИО должно быть в формате: Фамилия Имя Отчество',
        },
        email: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }

                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());
            },
            message: 'Некорректный email',
        },
        role: {
            validator: function (value) {
                return ['director', 'manager', 'accounting', 'dispatcher', 'owner', 'other'].includes(value);
            },
            message: 'Роль указана неверно',
        },
        status: {
            validator: function (value) {
                return ['active', 'inactive'].includes(value);
            },
            message: 'Статус указан неверно',
        },
    };

    function findErrorContainer(form, name) {
        return form.querySelector('.contact-error-' + name);
    }

    function setError(form, name, message) {
        const container = findErrorContainer(form, name);
        if (container) {
            container.textContent = message;
        }
    }

    function clearError(form, name) {
        const container = findErrorContainer(form, name);
        if (container) {
            container.textContent = '';
        }
    }

    function normalizeFullName(value) {
        const cleaned = value.trim().replace(/\s+/g, ' ');
        const parts = cleaned.split(' ').filter(Boolean);

        return parts
            .map(function (part) {
                const lower = part.toLowerCase();
                return lower.charAt(0).toUpperCase() + lower.slice(1);
            })
            .join(' ');
    }

    function validateField(form, name, value) {
        const rule = fields[name];
        if (!rule) {
            return true;
        }

        const normalized = value.trim().replace(/\s+/g, ' ');
        if (!rule.validator(normalized)) {
            setError(form, name, rule.message);
            return false;
        }

        clearError(form, name);
        return true;
    }

    function formHasErrors(form) {
        let invalid = false;

        Object.keys(fields).forEach(function (name) {
            const input = form.querySelector('[name="' + name + '"]');
            if (!input) {
                return;
            }

            if (!validateField(form, name, input.value)) {
                invalid = true;
            }
        });

        return invalid;
    }

    function updateValidationAlert() {
        if (!validationAlert) {
            return;
        }

        const anyInvalid = forms.some(function (form) {
            return formHasErrors(form);
        });

        validationAlert.style.display = anyInvalid ? 'block' : 'none';
    }

    forms.forEach(function (form) {
        ['full_name', 'email'].forEach(function (name) {
            const input = form.querySelector('[name="' + name + '"]');
            if (!input) {
                return;
            }

            input.addEventListener('input', function () {
                validateField(form, name, input.value);
                updateValidationAlert();
            });
        });

        ['role', 'status'].forEach(function (name) {
            const input = form.querySelector('[name="' + name + '"]');
            if (!input) {
                return;
            }

            input.addEventListener('change', function () {
                validateField(form, name, input.value);
                updateValidationAlert();
            });
        });

        const fullNameInput = form.querySelector('[name="full_name"]');
        if (fullNameInput) {
            fullNameInput.addEventListener('blur', function () {
                const normalized = normalizeFullName(fullNameInput.value);
                if (normalized !== fullNameInput.value) {
                    fullNameInput.value = normalized;
                }

                validateField(form, 'full_name', fullNameInput.value);
                updateValidationAlert();
            });
        }

        form.addEventListener('submit', function (event) {
            let valid = true;
            let firstInvalid = null;

            Object.keys(fields).forEach(function (name) {
                const input = form.querySelector('[name="' + name + '"]');
                if (!input) {
                    return;
                }

                const fieldValid = validateField(form, name, input.value);
                if (!fieldValid && firstInvalid === null) {
                    firstInvalid = input;
                }

                if (!fieldValid) {
                    valid = false;
                }
            });

            if (!valid) {
                event.preventDefault();

                if (validationAlert) {
                    validationAlert.style.display = 'block';
                    validationAlert.scrollIntoView({ block: 'center' });
                }

                if (firstInvalid && typeof firstInvalid.focus === 'function') {
                    firstInvalid.focus();
                }
            }
        });
    });
})();
