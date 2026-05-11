document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const truckPlateInput = document.querySelector('input[name="truck_plate"]');
    const trailerPlateInput = document.querySelector('input[name="trailer_plate"]');
    const loadCapacityInput = document.querySelector('input[name="load_capacity"]');
    const bodyVolumeInput = document.querySelector('input[name="body_volume"]');
    const statusSelect = document.querySelector('select[name="status"]');
    const validationAlert = document.getElementById('vehicleFormValidationAlert');

    if (!form) return;

    function validateTruckPlate(value) {
        const trimmed = value.trim();
        return trimmed.length >= 6 && trimmed.length <= 20;
    }

    function validateTrailerPlate(value) {
        if (!value.trim()) return true;
        const trimmed = value.trim();
        return trimmed.length >= 6 && trimmed.length <= 20;
    }

    function validateNumeric(value) {
        if (!value.trim()) return true;
        const normalized = value.replace(/,/g, '.').replace(/\s/g, '');
        return !isNaN(parseFloat(normalized)) && isFinite(normalized) && parseFloat(normalized) >= 0;
    }

    function validateStatus(value) {
        return ['active', 'blocked', 'archive'].includes(value);
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

    function validateForm() {
        let isValid = true;

        if (truckPlateInput) {
            isValid = validateField(truckPlateInput, validateTruckPlate, 'Госномер тягача должен содержать от 6 до 20 символов') && isValid;
        }

        if (trailerPlateInput) {
            isValid = validateField(trailerPlateInput, validateTrailerPlate, 'Госномер прицепа должен содержать от 6 до 20 символов') && isValid;
        }

        if (loadCapacityInput) {
            isValid = validateField(loadCapacityInput, validateNumeric, 'Грузоподъемность должна быть числом') && isValid;
        }

        if (bodyVolumeInput) {
            isValid = validateField(bodyVolumeInput, validateNumeric, 'Объем кузова должен быть числом') && isValid;
        }

        if (statusSelect) {
            isValid = validateField(statusSelect, validateStatus, 'Некорректный статус') && isValid;
        }

        if (validationAlert) {
            validationAlert.style.display = isValid ? 'none' : 'block';
        }

        return isValid;
    }

    if (truckPlateInput) {
        truckPlateInput.addEventListener('blur', function() {
            validateField(this, validateTruckPlate, 'Госномер тягача должен содержать от 6 до 20 символов');
            this.value = this.value.toUpperCase().replace(/\s/g, '');
        });

        truckPlateInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (trailerPlateInput) {
        trailerPlateInput.addEventListener('blur', function() {
            validateField(this, validateTrailerPlate, 'Госномер прицепа должен содержать от 6 до 20 символов');
            this.value = this.value.toUpperCase().replace(/\s/g, '');
        });

        trailerPlateInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (loadCapacityInput) {
        loadCapacityInput.addEventListener('blur', function() {
            validateField(this, validateNumeric, 'Грузоподъемность должна быть числом');
            this.value = this.value.replace(/,/g, '.');
        });

        loadCapacityInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (bodyVolumeInput) {
        bodyVolumeInput.addEventListener('blur', function() {
            validateField(this, validateNumeric, 'Объем кузова должен быть числом');
            this.value = this.value.replace(/,/g, '.');
        });

        bodyVolumeInput.addEventListener('input', function() {
            clearError(this);
        });
    }

    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            validateField(this, validateStatus, 'Некорректный статус');
        });
    }

    form.addEventListener('submit', function(e) {
        if (!validateForm()) {
            e.preventDefault();
            const firstInvalid = form.querySelector('.error:not(:empty)');
            if (firstInvalid && firstInvalid.previousElementSibling) {
                firstInvalid.previousElementSibling.focus();
            }
        }
    });
});
