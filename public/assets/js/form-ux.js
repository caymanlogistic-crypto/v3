(function () {
    let activeButton = null;
    let activePopup = null;

    function collapseSpaces(value) {
        return String(value).replace(/\s+/g, ' ').trim();
    }

    function toTitleCaseWord(word) {
        if (!word) {
            return '';
        }
        const lower = word.toLocaleLowerCase('ru-RU');
        return lower.charAt(0).toLocaleUpperCase('ru-RU') + lower.slice(1);
    }

    function normalizeFullName(value) {
        const cleaned = collapseSpaces(value);
        if (cleaned === '') {
            return '';
        }
        return cleaned.split(' ').map(toTitleCaseWord).join(' ');
    }

    function normalizeEmail(value) {
        return String(value).replace(/\s+/g, '').trim().toLowerCase();
    }

    function normalizeDigits(value) {
        return String(value).replace(/\D/g, '');
    }

    function formatPhoneFromDigits(digits) {
        if (digits.length !== 11) {
            return null;
        }

        let normalized = digits;
        if (normalized.charAt(0) === '8') {
            normalized = '7' + normalized.slice(1);
        }

        if (normalized.charAt(0) !== '7') {
            return null;
        }

        const code = normalized.slice(1, 4);
        const p1 = normalized.slice(4, 7);
        const p2 = normalized.slice(7, 9);
        const p3 = normalized.slice(9, 11);

        return '+7 (' + code + ') ' + p1 + '-' + p2 + '-' + p3;
    }

    function normalizePhoneDisplay(value) {
        const digits = normalizeDigits(value);
        if (digits === '') {
            return '';
        }

        const formatted = formatPhoneFromDigits(digits);
        return formatted || digits;
    }

    function normalizeSnilsDisplay(value) {
        const digits = normalizeDigits(value);
        if (digits.length !== 11) {
            return digits;
        }

        return digits.slice(0, 3) + '-' + digits.slice(3, 6) + '-' + digits.slice(6, 9) + ' ' + digits.slice(9, 11);
    }

    function normalizeVin(value) {
        return collapseSpaces(value).replace(/\s+/g, '').toUpperCase();
    }

    function normalizeDecimal(value) {
        const source = collapseSpaces(value);
        if (source === '') {
            return '';
        }

        const normalized = source.replace(/\s+/g, '').replace(/,/g, '.');
        let result = '';
        let dotUsed = false;

        for (let i = 0; i < normalized.length; i += 1) {
            const ch = normalized.charAt(i);
            if (/\d/.test(ch)) {
                result += ch;
                continue;
            }
            if (ch === '.' && !dotUsed) {
                result += '.';
                dotUsed = true;
            }
        }

        return result;
    }

    function mapEnToRuPlateLetters(value) {
        const map = {
            A: 'А',
            B: 'В',
            E: 'Е',
            K: 'К',
            M: 'М',
            H: 'Н',
            O: 'О',
            P: 'Р',
            C: 'С',
            T: 'Т',
            Y: 'У',
            X: 'Х'
        };

        return value.replace(/[ABEKMHOPCTYX]/g, function (letter) {
            return map[letter] || letter;
        });
    }

    function normalizeTruckPlate(value) {
        const cleaned = collapseSpaces(value).replace(/\s+/g, '').toUpperCase();
        if (cleaned === '') {
            return '';
        }
        return mapEnToRuPlateLetters(cleaned);
    }

    function normalizeTrailerPlate(value) {
        const cleaned = collapseSpaces(value).replace(/\s+/g, '').toUpperCase();
        if (cleaned === '') {
            return '';
        }
        return mapEnToRuPlateLetters(cleaned);
    }

    function parseDateParts(value) {
        if (!value) {
            return null;
        }

        const raw = String(value).trim();
        if (raw === '') {
            return null;
        }

        const digitsOnly = raw.replace(/\D/g, '');
        if (digitsOnly.length === 8) {
            if (/^\d{4}/.test(raw) && (raw.includes('-') || raw.includes('/'))) {
                return {
                    year: parseInt(digitsOnly.slice(0, 4), 10),
                    month: parseInt(digitsOnly.slice(4, 6), 10),
                    day: parseInt(digitsOnly.slice(6, 8), 10)
                };
            }
            return {
                year: parseInt(digitsOnly.slice(4, 8), 10),
                month: parseInt(digitsOnly.slice(2, 4), 10),
                day: parseInt(digitsOnly.slice(0, 2), 10)
            };
        }

        const parts = raw.split(/[.,\/-]/).filter(Boolean);
        if (parts.length !== 3) {
            return null;
        }

        if (parts[0].length === 4) {
            return {
                year: parseInt(parts[0], 10),
                month: parseInt(parts[1], 10),
                day: parseInt(parts[2], 10)
            };
        }

        return {
            year: parseInt(parts[2], 10),
            month: parseInt(parts[1], 10),
            day: parseInt(parts[0], 10)
        };
    }

    function isValidDateParts(year, month, day) {
        if (!Number.isInteger(year) || !Number.isInteger(month) || !Number.isInteger(day)) {
            return false;
        }
        if (year < 1900 || year > 2100) {
            return false;
        }
        if (month < 1 || month > 12 || day < 1 || day > 31) {
            return false;
        }

        const date = new Date(year, month - 1, day);
        return date.getFullYear() === year
            && date.getMonth() === month - 1
            && date.getDate() === day;
    }

    function pad2(number) {
        return number < 10 ? '0' + number : String(number);
    }

    function normalizeDateDisplay(value) {
        const raw = String(value).trim();
        if (raw === '') {
            return '';
        }

        const parts = parseDateParts(raw);
        if (!parts) {
            return raw;
        }

        if (!isValidDateParts(parts.year, parts.month, parts.day)) {
            return raw;
        }

        return pad2(parts.day) + '.' + pad2(parts.month) + '.' + String(parts.year);
    }

    function attachNormalizer(selector, normalizer) {
        const elements = document.querySelectorAll(selector);
        if (!elements.length) {
            return;
        }

        elements.forEach(function (element) {
            element.addEventListener('blur', function () {
                const next = normalizer(element.value);
                if (typeof next === 'string' && next !== element.value) {
                    element.value = next;
                }
            });

            element.addEventListener('paste', function () {
                window.setTimeout(function () {
                    const next = normalizer(element.value);
                    if (typeof next === 'string' && next !== element.value) {
                        element.value = next;
                    }
                }, 0);
            });
        });
    }

    function attachGlobalNormalizers() {
        const map = [
            { names: ['full_name', 'contact1_name', 'director'], fn: normalizeFullName },
            { names: ['email', 'contact1_email', 'contact2_email'], fn: normalizeEmail },
            { names: ['phone', 'contact1_phone', 'contact2_phone'], fn: normalizePhoneDisplay },
            { names: ['inn', 'kpp', 'ogrn', 'bank_bik', 'bank_account', 'bank_corr_account'], fn: normalizeDigits },
            { names: ['snils'], fn: normalizeSnilsDisplay },
            { names: ['truck_vin', 'trailer_vin'], fn: normalizeVin },
            { names: ['truck_plate'], fn: normalizeTruckPlate },
            { names: ['trailer_plate'], fn: normalizeTrailerPlate },
            { names: ['load_capacity', 'body_volume'], fn: normalizeDecimal },
            { names: ['passport_issue_date', 'license_issue_date', 'issued_at', 'expires_at'], fn: normalizeDateDisplay }
        ];

        map.forEach(function (item) {
            item.names.forEach(function (name) {
                attachNormalizer('[name="' + name + '"]', item.fn);
            });
        });
    }

    function closeTooltip() {
        if (activePopup) {
            activePopup.hidden = true;
            activePopup.remove();
            activePopup = null;
        }

        if (activeButton) {
            activeButton.setAttribute('aria-expanded', 'false');
            activeButton = null;
        }
    }

    function createPopup(text) {
        const popup = document.createElement('div');
        popup.className = 'form-help-popup';
        popup.textContent = text;
        popup.hidden = true;
        popup.setAttribute('role', 'tooltip');
        return popup;
    }

    function openTooltip(button) {
        const text = button.getAttribute('data-help');
        if (!text) {
            return;
        }

        if (activeButton === button) {
            closeTooltip();
            return;
        }

        closeTooltip();

        const popup = createPopup(text);
        const wrapper = document.createElement('span');
        wrapper.className = 'form-help';
        button.parentNode.insertBefore(wrapper, button);
        wrapper.appendChild(button);
        wrapper.appendChild(popup);

        popup.hidden = false;
        button.setAttribute('aria-expanded', 'true');

        activeButton = button;
        activePopup = popup;
    }

    document.addEventListener('click', function (event) {
        const button = event.target.closest('.form-help-button');

        if (button) {
            event.preventDefault();
            openTooltip(button);
            return;
        }

        if (activePopup && !activePopup.contains(event.target) && event.target !== activeButton) {
            closeTooltip();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') {
            closeTooltip();
        }
    });

    window.FormUx = {
        normalize: {
            fullName: normalizeFullName,
            email: normalizeEmail,
            digits: normalizeDigits,
            phoneDisplay: normalizePhoneDisplay,
            snilsDisplay: normalizeSnilsDisplay,
            vin: normalizeVin,
            dateDisplay: normalizeDateDisplay,
            decimal: normalizeDecimal,
            truckPlate: normalizeTruckPlate,
            trailerPlate: normalizeTrailerPlate
        },
        showFormAlert: function (alertNode, message) {
            if (!alertNode) {
                return;
            }
            alertNode.textContent = message;
            alertNode.style.display = 'block';
        },
        hideFormAlert: function (alertNode) {
            if (!alertNode) {
                return;
            }
            alertNode.style.display = 'none';
        },
        closeTooltip: closeTooltip
    };

    document.addEventListener('DOMContentLoaded', function () {
        attachGlobalNormalizers();
    });
})();
