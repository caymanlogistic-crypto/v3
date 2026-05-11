document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    if (!form) {
        return;
    }

    const trailerSection = document.getElementById('trailerSection');
    const toggleButton = document.getElementById('toggleTrailerSection');
    const validationAlert = document.getElementById('vehicleFormValidationAlert');

    function getInput(name) {
        return form.querySelector('[name="' + name + '"]');
    }

    function hasValue(name) {
        const input = getInput(name);
        return !!(input && input.value && input.value.trim() !== '');
    }

    function isTrailerActive() {
        return ['trailer_plate', 'trailer_brand', 'trailer_model', 'trailer_vin', 'trailer_load_capacity', 'trailer_body_volume'].some(hasValue);
    }

    function showTrailerSection(show) {
        if (trailerSection) {
            trailerSection.style.display = show ? '' : 'none';
        }
    }

    if (toggleButton) {
        toggleButton.addEventListener('click', function () {
            const opened = trailerSection && trailerSection.style.display !== 'none';
            showTrailerSection(!opened);
        });
    }

    if (isTrailerActive()) {
        showTrailerSection(true);
    }

    const rules = {
        truck_plate: { required: true, message: 'Госномер тягача обязателен', validate: validatePlate },
        truck_brand: { required: true, message: 'Марка тягача обязательна', validate: nonEmpty },
        truck_vin: { required: true, message: 'VIN тягача обязателен', validate: nonEmpty },
        truck_load_capacity: { required: true, message: 'Грузоподъёмность тягача обязательна', validate: validateNumber },
        truck_body_volume: { required: true, message: 'Объём кузова тягача обязателен', validate: validateNumber },
        trailer_plate: { requiredWhenTrailer: true, message: 'Если заполнен полуприцеп, укажите его госномер', validate: validatePlate },
        trailer_brand: { requiredWhenTrailer: true, message: 'Если заполнен полуприцеп, укажите его марку', validate: nonEmpty },
        trailer_vin: { requiredWhenTrailer: true, message: 'Если заполнен полуприцеп, укажите его VIN', validate: nonEmpty },
        trailer_load_capacity: { requiredWhenTrailer: true, message: 'Если заполнен полуприцеп, укажите его грузоподъёмность', validate: validateNumber },
        trailer_body_volume: { requiredWhenTrailer: true, message: 'Если заполнен полуприцеп, укажите его объём кузова', validate: validateNumber },
    };

    function nonEmpty(value) {
        return value.trim() !== '';
    }

    function validatePlate(value) {
        const cleaned = value.trim();
        return cleaned.length >= 6 && cleaned.length <= 20;
    }

    function validateNumber(value) {
        const cleaned = value.trim().replace(/,/g, '.').replace(/\s/g, '');
        if (cleaned === '') {
            return false;
        }
        return !isNaN(parseFloat(cleaned)) && isFinite(cleaned) && parseFloat(cleaned) >= 0;
    }

    function errorNode(name) {
        return document.getElementById('error-' + name);
    }

    function setError(name, message) {
        const node = errorNode(name);
        if (node) {
            node.textContent = message;
        }
    }

    function clearError(name) {
        const node = errorNode(name);
        if (node) {
            node.textContent = '';
        }
    }

    function validateField(name) {
        const rule = rules[name];
        const input = getInput(name);
        if (!rule || !input) {
            return true;
        }

        const value = input.value || '';
        const trailerActive = isTrailerActive();
        const required = rule.required || (rule.requiredWhenTrailer && trailerActive);

        if (required && value.trim() === '') {
            setError(name, rule.message);
            return false;
        }

        if (!required && value.trim() === '') {
            clearError(name);
            return true;
        }

        if (!rule.validate(value)) {
            if (name.includes('load_capacity') || name.includes('body_volume')) {
                setError(name, 'Поле должно быть числом');
            } else if (name.includes('plate')) {
                setError(name, 'Госномер должен содержать от 6 до 20 символов');
            } else {
                setError(name, rule.message);
            }
            return false;
        }

        clearError(name);
        return true;
    }

    Object.keys(rules).forEach(function (name) {
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
            if (name.includes('plate') || name.includes('vin')) {
                input.value = input.value.toUpperCase().replace(/\s/g, '');
            }
            if (name.includes('load_capacity') || name.includes('body_volume')) {
                input.value = input.value.replace(/,/g, '.');
            }
            validateField(name);
        });
    });

    form.addEventListener('submit', function (event) {
        let valid = true;
        let firstInvalid = null;

        Object.keys(rules).forEach(function (name) {
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
