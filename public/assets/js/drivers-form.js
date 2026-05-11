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

    const MSG_FIO = '\u0424\u0418\u041e \u0434\u043e\u043b\u0436\u043d\u043e \u0431\u044b\u0442\u044c \u0432 \u0444\u043e\u0440\u043c\u0430\u0442\u0435: \u0424\u0430\u043c\u0438\u043b\u0438\u044f \u0418\u043c\u044f \u041e\u0442\u0447\u0435\u0441\u0442\u0432\u043e';
    const MSG_EMAIL = '\u041d\u0435\u043a\u043e\u0440\u0440\u0435\u043a\u0442\u043d\u044b\u0439 email';
    const MSG_PASSPORT = '\u041d\u043e\u043c\u0435\u0440 \u043f\u0430\u0441\u043f\u043e\u0440\u0442\u0430 \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c 10 \u0446\u0438\u0444\u0440';
    const MSG_LICENSE = '\u041d\u043e\u043c\u0435\u0440 \u0412\u0423 \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c 10 \u0446\u0438\u0444\u0440';
    const MSG_SNILS = '\u0421\u041d\u0418\u041b\u0421 \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c 11 \u0446\u0438\u0444\u0440';

    if (fullNameInput) {
        fullNameInput.addEventListener('blur', function() { validateField(this, validateFullName, MSG_FIO); });
        fullNameInput.addEventListener('input', function() { clearError(this); });
    }

    if (emailInput) {
        emailInput.addEventListener('blur', function() { validateField(this, validateEmail, MSG_EMAIL); });
        emailInput.addEventListener('input', function() { clearError(this); });
    }

    if (passportInput) {
        passportInput.addEventListener('blur', function() { validateField(this, validatePassportNumber, MSG_PASSPORT); });
        passportInput.addEventListener('input', function() { clearError(this); });
    }

    if (licenseInput) {
        licenseInput.addEventListener('blur', function() { validateField(this, validateLicenseNumber, MSG_LICENSE); });
        licenseInput.addEventListener('input', function() { clearError(this); });
    }

    if (snilsInput) {
        snilsInput.addEventListener('blur', function() { validateField(this, validateSnils, MSG_SNILS); });
        snilsInput.addEventListener('input', function() { clearError(this); });
    }

    form.addEventListener('submit', function(e) {
        let isValid = true;
        if (fullNameInput && !validateField(fullNameInput, validateFullName, MSG_FIO)) isValid = false;
        if (emailInput && !validateField(emailInput, validateEmail, MSG_EMAIL)) isValid = false;
        if (passportInput && !validateField(passportInput, validatePassportNumber, MSG_PASSPORT)) isValid = false;
        if (licenseInput && !validateField(licenseInput, validateLicenseNumber, MSG_LICENSE)) isValid = false;
        if (snilsInput && !validateField(snilsInput, validateSnils, MSG_SNILS)) isValid = false;

        if (!isValid) {
            e.preventDefault();
            if (validationAlert) validationAlert.style.display = 'block';
            const firstInvalid = form.querySelector('.error:not(:empty)');
            if (firstInvalid && firstInvalid.previousElementSibling) firstInvalid.previousElementSibling.focus();
        }
    });
});
