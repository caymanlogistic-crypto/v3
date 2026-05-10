document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const fullNameInput = document.querySelector('input[name="full_name"]');
    const emailInput = document.querySelector('input[name="email"]');
    const passportInput = document.querySelector('input[name="passport_number"]');
    const licenseInput = document.querySelector('input[name="license_number"]');
    const snilsInput = document.querySelector('input[name="snils"]');
    const validationAlert = document.getElementById('driverFormValidationAlert');

    if (!form) return;

    function validateFullName(value) {
        const normalized = value.trim().replace(/\s+/g, ' ');
        const parts = normalized.split(' ').filter(p => p.length > 0);
        if (parts.length !== 3) return false;
        for (let part of parts) {
            if (part.length < 2) return false;
        }
        return true;
    }

    function validateEmail(value) {
        if (!value) return true;
        return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
    }

    function validatePassportNumber(value) {
        if (!value) return true;
        const digits = value.replace(/\D/g, '');
        return digits.length === 10;
    }

    function validateLicenseNumber(value) {
        const digits = value.replace(/\D/g, '');
        return digits.length === 10;
    }

    function validateSnils(value) {
        if (!value) return true;
        const digits = value.replace(/\D/g, '');
        return digits.length === 11;
    }

    function showError(input, message) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error')) {
            errorDiv.textContent = message;
        }
    }

    function clearError(input) {
        const errorDiv = input.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('error')) {
            errorDiv.textContent = '';
        }
    }

    function validateField(input, validationFn, errorMsg) {
        if (!validationFn(input.value)) {
            showError(input, errorMsg);
            return false;
        } else {
            clearError(input);
            return true;
        }
    }

    if (fullNameInput) {
        fullNameInput.addEventListener('blur', function() {
            validateField(this, validateFullName, 'ФИО должно быть в формате: Фамилия Имя Отчество');
        });

        fullNameInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (emailInput) {
        emailInput.addEventListener('blur', function() {
            validateField(this, validateEmail, 'Некорректный email');
        });

        emailInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (passportInput) {
        passportInput.addEventListener('blur', function() {
            validateField(this, validatePassportNumber, 'Номер паспорта должен содержать 10 цифр');
        });

        passportInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (licenseInput) {
        licenseInput.addEventListener('blur', function() {
            validateField(this, validateLicenseNumber, 'Номер ВУ должен содержать 10 цифр');
        });

        licenseInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (snilsInput) {
        snilsInput.addEventListener('blur', function() {
            validateField(this, validateSnils, 'СНИЛС должен содержать 11 цифр');
        });

        snilsInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    form.addEventListener('submit', function(e) {
        let isValid = true;

        if (fullNameInput && !validateField(fullNameInput, validateFullName, 'ФИО должно быть в формате: Фамилия Имя Отчество')) {
            isValid = false;
        }

        if (emailInput && !validateField(emailInput, validateEmail, 'Некорректный email')) {
            isValid = false;
        }

        if (passportInput && !validateField(passportInput, validatePassportNumber, 'Номер паспорта должен содержать 10 цифр')) {
            isValid = false;
        }

        if (licenseInput && !validateField(licenseInput, validateLicenseNumber, 'Номер ВУ должен содержать 10 цифр')) {
            isValid = false;
        }

        if (snilsInput && !validateField(snilsInput, validateSnils, 'СНИЛС должен содержать 11 цифр')) {
            isValid = false;
        }

        if (!isValid) {
            e.preventDefault();
            validationAlert.style.display = 'block';
            const firstInvalid = form.querySelector('.error:not(:empty)');
            if (firstInvalid && firstInvalid.previousElementSibling) {
                firstInvalid.previousElementSibling.focus();
            }
        }
    });
});
