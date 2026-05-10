document.addEventListener('DOMContentLoaded', function() {
    const innInput = document.querySelector('input[name="inn"]');
    const autofillButton = document.getElementById('contractorDadataAutofill');
    const messageDiv = document.getElementById('contractorDadataMessage');

    if (!innInput || !autofillButton || !messageDiv) return;

    function normalizeInn(value) {
        return value.replace(/\D/g, '');
    }

    function isValidInn(inn) {
        return inn.length === 10 || inn.length === 12;
    }

    function updateButton() {
        const inn = normalizeInn(innInput.value);
        autofillButton.disabled = !isValidInn(inn);
    }

    innInput.addEventListener('input', updateButton);
    updateButton(); // initial check

    autofillButton.addEventListener('click', function() {
        const inn = normalizeInn(innInput.value);
        if (!isValidInn(inn)) return;

        autofillButton.disabled = true;
        autofillButton.textContent = 'Загрузка...';

        const formData = new FormData();
        formData.append('inn', inn);
        formData.append('_token', document.querySelector('input[name="_token"]').value);

        fetch(window.contractorDadataLookupUrl, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Fill fields
                const fields = ['name', 'inn', 'kpp', 'ogrn', 'okved', 'legal_address', 'director', 'director_post'];
                fields.forEach(field => {
                    const input = document.querySelector(`input[name="${field}"], textarea[name="${field}"]`);
                    if (input && data.data[field]) {
                        input.value = data.data[field];
                        input.dispatchEvent(new Event('input', { bubbles: true }));
                        input.dispatchEvent(new Event('change', { bubbles: true }));
                    }
                });
                messageDiv.style.display = 'none';
            } else {
                messageDiv.textContent = data.message;
                messageDiv.style.display = 'block';
            }
        })
        .catch(() => {
            messageDiv.textContent = 'Не удалось получить данные по ИНН. Заполните поля вручную.';
            messageDiv.style.display = 'block';
        })
        .finally(() => {
            autofillButton.disabled = false;
            autofillButton.textContent = 'Автозаполнить';
            updateButton();
        });
    });
});