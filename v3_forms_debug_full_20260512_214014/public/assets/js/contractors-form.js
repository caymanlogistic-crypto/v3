(function () {
    const forms = Array.from(document.querySelectorAll('form')).filter(function (form) {
        const action = form.getAttribute('action') || '';

        if (action.includes('/contractors/contacts/')) {
            return false;
        }

        return action.endsWith('/store') || /\/contractors\/\d+\/update$/.test(action);
    });

    if (forms.length === 0) {
        return;
    }

    const validationAlert = document.getElementById('contractorFormValidationAlert');

    const fields = {
        name: {
            required: true,
            validator: function (value) {
                return value.length > 0 && value.length <= 255;
            },
            message: 'Название подрядчика обязательно',
        },
        inn: {
            required: true,
            validator: function (value) {
                const digits = value.replace(/\D/g, '');
                return digits.length === 10 || digits.length === 12;
            },
            message: 'ИНН должен содержать 10 или 12 цифр',
        },
        kpp: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return value.replace(/\D/g, '').length === 9;
            },
            message: 'КПП должен содержать 9 цифр',
        },
        ogrn: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                const digits = value.replace(/\D/g, '');
                return digits.length === 13 || digits.length === 15;
            },
            message: 'ОГРН должен содержать 13 или 15 цифр',
        },
        okved: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return /^\d{2}(?:\.\d{1,4})*$/.test(value);
            },
            message: 'ОКВЭД может содержать только цифры и точки',
        },
        bank_bik: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return value.replace(/\D/g, '').length === 9;
            },
            message: 'БИК должен содержать 9 цифр',
        },
        bank_account: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return value.replace(/\D/g, '').length === 20;
            },
            message: 'Номер счета должен содержать 20 цифр',
        },
        bank_corr_account: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return value.replace(/\D/g, '').length === 20;
            },
            message: 'Корреспондентский счет должен содержать 20 цифр',
        },
        contact1_phone: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                const digits = value.replace(/\D/g, '');
                return /^(7|8)\d{10}$/.test(digits);
            },
            message: 'Телефон должен содержать 11 цифр и начинаться с 7 или 8',
        },
        contact1_email: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());
            },
            message: 'Некорректный email',
        },
        director: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return value.length <= 255;
            },
            message: 'ФИО директора не должно превышать 255 символов',
        },
        contact1_name: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                return value.length <= 255;
            },
            message: 'ФИО контакта не должно превышать 255 символов',
        },
    };

    function findErrorContainer(name) {
        return document.getElementById('error-' + name);
    }

    function setError(name, message) {
        const container = findErrorContainer(name);
        if (container) {
            container.textContent = message;
        }
    }

    function clearError(name) {
        const container = findErrorContainer(name);
        if (container) {
            container.textContent = '';
        }
    }

    function validateField(name, value) {
        const rule = fields[name];
        if (!rule) {
            return true;
        }

        const normalized = value.trim().replace(/\s+/g, ' ');

        if (rule.required && normalized === '') {
            setError(name, rule.message);
            return false;
        }

        if (!rule.validator(normalized)) {
            setError(name, rule.message);
            return false;
        }

        clearError(name);
        return true;
    }

    forms.forEach(function (form) {
        Object.keys(fields).forEach(function (name) {
            const input = form.querySelector('[name="' + name + '"]');
            if (!input) {
                return;
            }

            input.addEventListener('input', function () {
                validateField(name, input.value);

                if (validationAlert) {
                    validationAlert.style.display = 'none';
                }
            });
        });

        form.addEventListener('submit', function (event) {
            let valid = true;
            let firstInvalidField = null;

            Object.keys(fields).forEach(function (name) {
                const input = form.querySelector('[name="' + name + '"]');
                if (!input) {
                    return;
                }

                const fieldValid = validateField(name, input.value);
                if (!fieldValid && firstInvalidField === null) {
                    firstInvalidField = input;
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

                if (firstInvalidField && typeof firstInvalidField.focus === 'function') {
                    firstInvalidField.focus();
                }
            }
        });
    });
})();
