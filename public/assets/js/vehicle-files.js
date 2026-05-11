document.addEventListener('DOMContentLoaded', function () {
    const maxSize = 20 * 1024 * 1024; // 20 MB
    const errorMsg = 'Один или несколько файлов слишком большие. Максимальный размер одного файла: 20 MB';

    function getErrorContainer(fileInput) {
        return fileInput.parentElement.querySelector('.file-error');
    }

    function showError(fileInput, message) {
        const errorDiv = getErrorContainer(fileInput);
        if (errorDiv) {
            errorDiv.textContent = message;
        }
    }

    function clearError(fileInput) {
        const errorDiv = getErrorContainer(fileInput);
        if (errorDiv) {
            errorDiv.textContent = '';
        }
    }

    function validateFileInput(fileInput) {
        const files = fileInput.files || [];

        for (let index = 0; index < files.length; index += 1) {
            if (files[index].size > maxSize) {
                showError(fileInput, errorMsg);
                return false;
            }
        }

        clearError(fileInput);
        return true;
    }

    const forms = document.querySelectorAll('form[action*="/vehicles/"][action*="/files/upload"]');

    forms.forEach(function (form) {
        const fileInput = form.querySelector('input[type="file"][name="files[]"], input[type="file"][name="file"]');

        if (!fileInput) {
            return;
        }

        fileInput.addEventListener('change', function () {
            validateFileInput(fileInput);
        });

        form.addEventListener('submit', function (event) {
            if (!validateFileInput(fileInput)) {
                event.preventDefault();
            }
        });
    });
});
