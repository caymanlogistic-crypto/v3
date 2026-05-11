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
            isValid &= validateField(truckPlateInput, validateTruckPlate, 'Госномер тягача должен содержать от 6 до 20 символов');
        }

        if (trailerPlateInput) {
            isValid &= validateField(trailerPlateInput, validateTrailerPlate, 'Госномер прицепа должен содержать от 6 до 20 символов');
        }

        if (loadCapacityInput) {
            isValid &= validateField(loadCapacityInput, validateNumeric, 'Грузоподъёмность должна быть числом');
        }

        if (bodyVolumeInput) {
            isValid &= validateField(bodyVolumeInput, validateNumeric, 'Объём кузова должен быть числом');
        }

        if (statusSelect) {
            isValid &= validateField(statusSelect, validateStatus, 'Некорректный статус');
        }

        if (validationAlert) {
            validationAlert.style.display = isValid ? 'none' : 'block';
        }

        return isValid;
    }

    if (truckPlateInput) {
        truckPlateInput.addEventListener('blur', function() {
            validateField(this, validateTruckPlate, 'Госномер тягача должен содержать от 6 до 20 символов');
        });

        truckPlateInput.addEventListener('input', function() {
            clearError(this);
        });

        truckPlateInput.addEventListener('blur', function() {
            this.value = this.value.toUpperCase().replace(/\s/g, '');
        });
    }

    if (trailerPlateInput) {
        trailerPlateInput.addEventListener('blur', function() {
            validateField(this, validateTrailerPlate, 'Госномер прицепа должен содержать от 6 до 20 символов');
        });

        trailerPlateInput.addEventListener('input', function() {
            clearError(this);
        });

        trailerPlateInput.addEventListener('blur', function() {
            this.value = this.value.toUpperCase().replace(/\s/g, '');
        });
    }

    if (loadCapacityInput) {
        loadCapacityInput.addEventListener('blur', function() {
            validateField(this, validateNumeric, 'Грузоподъёмность должна быть числом');
        });

        loadCapacityInput.addEventListener('input', function() {
            clearError(this);
        });

        loadCapacityInput.addEventListener('blur', function() {
            this.value = this.value.replace(/,/g, '.');
        });
    }

    if (bodyVolumeInput) {
        bodyVolumeInput.addEventListener('blur', function() {
            validateField(this, validateNumeric, 'Объём кузова должен быть числом');
        });

        bodyVolumeInput.addEventListener('input', function() {
            clearError(this);
        });

        bodyVolumeInput.addEventListener('blur', function() {
            this.value = this.value.replace(/,/g, '.');
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
            if (firstInvalid) {
                firstInvalid.previousElementSibling.focus();
            }
        }
    });
});