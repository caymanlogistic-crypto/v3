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

    const fields = {
        inn: {
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
                const digits = value.replace(/\D/g, '');
                return digits.length === 9;
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
        bank_bik: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                const digits = value.replace(/\D/g, '');
                return digits.length === 9;
            },
            message: 'БИК должен содержать 9 цифр',
        },
        bank_account: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                const digits = value.replace(/\D/g, '');
                return digits.length === 20;
            },
            message: 'Номер счета должен содержать 20 цифр',
        },
        bank_corr_account: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                const digits = value.replace(/\D/g, '');
                return digits.length === 20;
            },
            message: 'Корр. счет должен содержать 20 цифр',
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
                const parts = value.trim().split(/\s+/);
                return parts.length === 3 && parts.every(function (part) {
                    return part.length >= 2;
                });
            },
            message: 'ФИО должно быть в формате: Фамилия Имя Отчество',
        },
        contact1_name: {
            validator: function (value) {
                if (value === '') {
                    return true;
                }
                const parts = value.trim().split(/\s+/);
                return parts.length === 3 && parts.every(function (part) {
                    return part.length >= 2;
                });
            },
            message: 'ФИО должно быть в формате: Фамилия Имя Отчество',
        },
    };

    function findErrorContainer(name) {
        return document.getElementById('error-' + name);
    }

    function setError(name, message) {
        const container = findErrorContainer(name);
        if (!container) {
            return;
        }
        container.textContent = message;
    }

    function clearError(name) {
        const container = findErrorContainer(name);
        if (!container) {
            return;
        }
        container.textContent = '';
    }

    function validateField(name, value) {
        const rule = fields[name];
        if (!rule) {
            return true;
        }

        const normalized = value.trim().replace(/\s+/g, ' ');
        if (!rule.validator(normalized)) {
            setError(name, rule.message);
            return false;
        }

        clearError(name);
        return true;
    }

    Object.keys(fields).forEach(function (name) {
        const input = document.querySelector('[name="' + name + '"]');
        if (!input) {
            return;
        }

        input.addEventListener('input', function () {
            validateField(name, input.value);
        });
    });

    forms.forEach(function (form) {
        form.addEventListener('submit', function (event) {
            let valid = true;

            Object.keys(fields).forEach(function (name) {
                const input = form.querySelector('[name="' + name + '"]');
                if (!input) {
                    return;
                }
                const fieldValid = validateField(name, input.value);
                if (!fieldValid) {
                    valid = false;
                }
            });

            if (!valid) {
                event.preventDefault();
            }
        });
    });
})();
