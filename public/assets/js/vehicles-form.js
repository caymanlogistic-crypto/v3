document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    if (!form) return;

    const trailerSection = document.getElementById('trailerSection');
    const toggleButton = document.getElementById('toggleTrailerSection');

    const truckPlateInput = document.querySelector('input[name="truck_plate"]');
    const trailerPlateInput = document.querySelector('input[name="trailer_plate"]');
    const truckLoadCapacityInput = document.querySelector('input[name="truck_load_capacity"]');
    const truckBodyVolumeInput = document.querySelector('input[name="truck_body_volume"]');
    const trailerLoadCapacityInput = document.querySelector('input[name="trailer_load_capacity"]');
    const trailerBodyVolumeInput = document.querySelector('input[name="trailer_body_volume"]');
    const statusSelect = document.querySelector('select[name="status"]');
    const validationAlert = document.getElementById('vehicleFormValidationAlert');

    const MSG_TRUCK = '\u0413\u043e\u0441\u043d\u043e\u043c\u0435\u0440 \u0442\u044f\u0433\u0430\u0447\u0430 \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043e\u0442 6 \u0434\u043e 20 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432';
    const MSG_TRAILER = '\u0413\u043e\u0441\u043d\u043e\u043c\u0435\u0440 \u043f\u0440\u0438\u0446\u0435\u043f\u0430 \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043e\u0442 6 \u0434\u043e 20 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432';
    const MSG_NUM = '\u041f\u043e\u043b\u0435 \u0434\u043e\u043b\u0436\u043d\u043e \u0431\u044b\u0442\u044c \u0447\u0438\u0441\u043b\u043e\u043c';
    const MSG_STATUS = '\u041d\u0435\u043a\u043e\u0440\u0440\u0435\u043a\u0442\u043d\u044b\u0439 \u0441\u0442\u0430\u0442\u0443\u0441';

    function hasValue(input) {
        return !!(input && input.value && input.value.trim() !== '');
    }

    function showTrailerSection(show) {
        if (!trailerSection) return;
        trailerSection.style.display = show ? '' : 'none';
    }

    if (toggleButton) {
        toggleButton.addEventListener('click', function() {
            const opened = trailerSection && trailerSection.style.display !== 'none';
            showTrailerSection(!opened);
        });
    }

    if (
        hasValue(document.querySelector('input[name="trailer_brand"]')) ||
        hasValue(document.querySelector('input[name="trailer_model"]')) ||
        hasValue(trailerPlateInput) ||
        hasValue(document.querySelector('input[name="trailer_vin"]')) ||
        hasValue(trailerLoadCapacityInput) ||
        hasValue(trailerBodyVolumeInput)
    ) {
        showTrailerSection(true);
    }

    function validatePlate(value) {
        const t = value.trim();
        return t.length >= 6 && t.length <= 20;
    }

    function validateNumeric(value) {
        if (!value.trim()) return true;
        const n = value.replace(/,/g, '.').replace(/\s/g, '');
        return !isNaN(parseFloat(n)) && isFinite(n) && parseFloat(n) >= 0;
    }

    function validateStatus(value) {
        return ['active', 'blocked', 'archive'].includes(value);
    }

    function showError(input, message) {
        const errorDiv = input.parentNode.querySelector('.error');
        if (errorDiv) {
            errorDiv.textContent = message;
        }
    }

    function clearError(input) {
        const errorDiv = input.parentNode.querySelector('.error');
        if (errorDiv) {
            errorDiv.textContent = '';
        }
    }

    function validateField(input, validationFn, errorMsg) {
        if (!input) return true;
        if (!validationFn(input.value)) {
            showError(input, errorMsg);
            return false;
        }
        clearError(input);
        return true;
    }

    function bindNumeric(input) {
        if (!input) return;
        input.addEventListener('blur', function() {
            validateField(this, validateNumeric, MSG_NUM);
            this.value = this.value.replace(/,/g, '.');
        });
        input.addEventListener('input', function() { clearError(this); });
    }

    if (truckPlateInput) {
        truckPlateInput.addEventListener('blur', function() {
            validateField(this, validatePlate, MSG_TRUCK);
            this.value = this.value.toUpperCase().replace(/\s/g, '');
        });
        truckPlateInput.addEventListener('input', function() { clearError(this); });
    }

    if (trailerPlateInput) {
        trailerPlateInput.addEventListener('blur', function() {
            if (this.value.trim() !== '') {
                validateField(this, validatePlate, MSG_TRAILER);
            } else {
                clearError(this);
            }
            this.value = this.value.toUpperCase().replace(/\s/g, '');
        });
        trailerPlateInput.addEventListener('input', function() { clearError(this); });
    }

    bindNumeric(truckLoadCapacityInput);
    bindNumeric(truckBodyVolumeInput);
    bindNumeric(trailerLoadCapacityInput);
    bindNumeric(trailerBodyVolumeInput);

    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            validateField(this, validateStatus, MSG_STATUS);
        });
    }

    form.addEventListener('submit', function(e) {
        let isValid = true;

        if (truckPlateInput) {
            isValid = validateField(truckPlateInput, validatePlate, MSG_TRUCK) && isValid;
        }

        if (trailerPlateInput && trailerPlateInput.value.trim() !== '') {
            isValid = validateField(trailerPlateInput, validatePlate, MSG_TRAILER) && isValid;
        }

        isValid = validateField(truckLoadCapacityInput, validateNumeric, MSG_NUM) && isValid;
        isValid = validateField(truckBodyVolumeInput, validateNumeric, MSG_NUM) && isValid;
        isValid = validateField(trailerLoadCapacityInput, validateNumeric, MSG_NUM) && isValid;
        isValid = validateField(trailerBodyVolumeInput, validateNumeric, MSG_NUM) && isValid;
        isValid = validateField(statusSelect, validateStatus, MSG_STATUS) && isValid;

        if (validationAlert) {
            validationAlert.style.display = isValid ? 'none' : 'block';
        }

        if (!isValid) {
            e.preventDefault();
            const firstInvalid = form.querySelector('.error:not(:empty)');
            if (firstInvalid && firstInvalid.previousElementSibling) {
                firstInvalid.previousElementSibling.focus();
            }
        }
    });
});
