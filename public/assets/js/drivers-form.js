document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (!form) {
        return;
    }

    const validationAlert = document.getElementById('driverFormValidationAlert');

    const fields = {
        full_name: {
            required: true,
            validate: function (value) {
                const normalized = value.trim().replace(/\s+/g, ' ');
                const parts = normalized.split(' ').filter(function (part) { return part.length > 0; });
                return parts.length === 3 && parts.every(function (part) { return part.length >= 2; });
            },
            message: 'ФИО должно быть в формате: Фамилия Имя Отчество',
        },
        phone: {
            required: true,
            validate: function (value) {
                const digits = value.replace(/\D/g, '');
                return /^(7|8)\d{10}$/.test(digits);
            },
            message: 'Телефон должен содержать 11 цифр и начинаться с 7 или 8',
        },
        email: {
            required: true,
            validate: function (value) {
                return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value.trim());
            },
            message: 'Некорректный email',
        },
        passport_number: {
            required: true,
            validate: function (value) {
                return value.replace(/\D/g, '').length === 10;
            },
            message: 'Номер паспорта должен содержать 10 цифр',
        },
        passport_issue_date: {
            required: true,
            validate: function (value) {
                return value.trim() !== '';
            },
            message: 'Дата выдачи паспорта обязательна',
        },
        passport_issued_by: {
            required: true,
            validate: function (value) {
                return value.trim() !== '';
            },
            message: 'Кем выдан паспорт — обязательное поле',
        },
        license_number: {
            required: true,
            validate: function (value) {
                return value.replace(/\D/g, '').length === 10;
            },
            message: 'Номер ВУ должен содержать 10 цифр',
        },
        license_issue_date: {
            required: true,
            validate: function (value) {
                return value.trim() !== '';
            },
            message: 'Дата выдачи ВУ обязательна',
        },
        snils: {
            required: true,
            validate: function (value) {
                return value.replace(/\D/g, '').length === 11;
            },
            message: 'СНИЛС должен содержать 11 цифр',
        },
    };

    function getInput(name) {
        return form.querySelector('[name="' + name + '"]');
    }

    function getErrorNode(name) {
        return document.getElementById('error-' + name);
    }

    function setError(name, message) {
        const node = getErrorNode(name);
        if (node) {
            node.textContent = message;
        }
    }

    function clearError(name) {
        const node = getErrorNode(name);
        if (node) {
            node.textContent = '';
        }
    }

    function validateField(name) {
        const rule = fields[name];
        const input = getInput(name);
        if (!rule || !input) {
            return true;
        }

        const value = input.value || '';
        const trimmed = value.trim();

        if (rule.required && trimmed === '') {
            setError(name, name === 'email' ? 'Email обязателен' : rule.message);
            return false;
        }

        if (!rule.validate(value)) {
            setError(name, rule.message);
            return false;
        }

        clearError(name);
        return true;
    }

    Object.keys(fields).forEach(function (name) {
        const input = getInput(name);
        if (!input) {
            return;
        }

        input.addEventListener('input', function () {
            clearError(name);
            if (validationAlert) {
                validationAlert.style.display = 'none';
            }
        });

        input.addEventListener('blur', function () {
            validateField(name);
        });
    });

    form.addEventListener('submit', function (event) {
        let valid = true;
        let firstInvalid = null;

        Object.keys(fields).forEach(function (name) {
            const fieldValid = validateField(name);
            if (!fieldValid && firstInvalid === null) {
                firstInvalid = getInput(name);
            }
            valid = valid && fieldValid;
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
