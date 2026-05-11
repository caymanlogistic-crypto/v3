document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const truckPlateInput = document.querySelector('input[name="truck_plate"]');
    const trailerPlateInput = document.querySelector('input[name="trailer_plate"]');
    const loadCapacityInput = document.querySelector('input[name="load_capacity"]');
    const bodyVolumeInput = document.querySelector('input[name="body_volume"]');
    const statusSelect = document.querySelector('select[name="status"]');
    const validationAlert = document.getElementById('vehicleFormValidationAlert');

    if (!form) return;

    const MSG_TRUCK = '\u0413\u043e\u0441\u043d\u043e\u043c\u0435\u0440 \u0442\u044f\u0433\u0430\u0447\u0430 \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043e\u0442 6 \u0434\u043e 20 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432';
    const MSG_TRAILER = '\u0413\u043e\u0441\u043d\u043e\u043c\u0435\u0440 \u043f\u0440\u0438\u0446\u0435\u043f\u0430 \u0434\u043e\u043b\u0436\u0435\u043d \u0441\u043e\u0434\u0435\u0440\u0436\u0430\u0442\u044c \u043e\u0442 6 \u0434\u043e 20 \u0441\u0438\u043c\u0432\u043e\u043b\u043e\u0432';
    const MSG_LOAD = '\u0413\u0440\u0443\u0437\u043e\u043f\u043e\u0434\u044a\u0435\u043c\u043d\u043e\u0441\u0442\u044c \u0434\u043e\u043b\u0436\u043d\u0430 \u0431\u044b\u0442\u044c \u0447\u0438\u0441\u043b\u043e\u043c';
    const MSG_VOLUME = '\u041e\u0431\u044a\u0435\u043c \u043a\u0443\u0437\u043e\u0432\u0430 \u0434\u043e\u043b\u0436\u0435\u043d \u0431\u044b\u0442\u044c \u0447\u0438\u0441\u043b\u043e\u043c';
    const MSG_STATUS = '\u041d\u0435\u043a\u043e\u0440\u0440\u0435\u043a\u0442\u043d\u044b\u0439 \u0441\u0442\u0430\u0442\u0443\u0441';

    function validateTruckPlate(value) { const t = value.trim(); return t.length >= 6 && t.length <= 20; }
    function validateTrailerPlate(value) { if (!value.trim()) return true; const t = value.trim(); return t.length >= 6 && t.length <= 20; }
    function validateNumeric(value) { if (!value.trim()) return true; const n = value.replace(/,/g, '.').replace(/\s/g, ''); return !isNaN(parseFloat(n)) && isFinite(n) && parseFloat(n) >= 0; }
    function validateStatus(value) { return ['active', 'blocked', 'archive'].includes(value); }

    function showError(input, message) { const errorDiv = input.nextElementSibling; if (errorDiv && errorDiv.classList.contains('error')) errorDiv.textContent = message; }
    function clearError(input) { const errorDiv = input.nextElementSibling; if (errorDiv && errorDiv.classList.contains('error')) errorDiv.textContent = ''; }
    function validateField(input, validationFn, errorMsg) { if (!validationFn(input.value)) { showError(input, errorMsg); return false; } clearError(input); return true; }

    function validateForm() {
        let isValid = true;
        if (truckPlateInput) isValid = validateField(truckPlateInput, validateTruckPlate, MSG_TRUCK) && isValid;
        if (trailerPlateInput) isValid = validateField(trailerPlateInput, validateTrailerPlate, MSG_TRAILER) && isValid;
        if (loadCapacityInput) isValid = validateField(loadCapacityInput, validateNumeric, MSG_LOAD) && isValid;
        if (bodyVolumeInput) isValid = validateField(bodyVolumeInput, validateNumeric, MSG_VOLUME) && isValid;
        if (statusSelect) isValid = validateField(statusSelect, validateStatus, MSG_STATUS) && isValid;
        if (validationAlert) validationAlert.style.display = isValid ? 'none' : 'block';
        return isValid;
    }

    if (truckPlateInput) {
        truckPlateInput.addEventListener('blur', function() { validateField(this, validateTruckPlate, MSG_TRUCK); this.value = this.value.toUpperCase().replace(/\s/g, ''); });
        truckPlateInput.addEventListener('input', function() { clearError(this); });
    }
    if (trailerPlateInput) {
        trailerPlateInput.addEventListener('blur', function() { validateField(this, validateTrailerPlate, MSG_TRAILER); this.value = this.value.toUpperCase().replace(/\s/g, ''); });
        trailerPlateInput.addEventListener('input', function() { clearError(this); });
    }
    if (loadCapacityInput) {
        loadCapacityInput.addEventListener('blur', function() { validateField(this, validateNumeric, MSG_LOAD); this.value = this.value.replace(/,/g, '.'); });
        loadCapacityInput.addEventListener('input', function() { clearError(this); });
    }
    if (bodyVolumeInput) {
        bodyVolumeInput.addEventListener('blur', function() { validateField(this, validateNumeric, MSG_VOLUME); this.value = this.value.replace(/,/g, '.'); });
        bodyVolumeInput.addEventListener('input', function() { clearError(this); });
    }
    if (statusSelect) {
        statusSelect.addEventListener('change', function() { validateField(this, validateStatus, MSG_STATUS); });
    }

    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            const firstInvalid = form.querySelector('.error:not(:empty)');
            if (firstInvalid && firstInvalid.previousElementSibling) firstInvalid.previousElementSibling.focus();
        }
    });
});
