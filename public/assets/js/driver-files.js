document.addEventListener('DOMContentLoaded', function () {
    const maxSize = 20 * 1024 * 1024;
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

    const forms = document.querySelectorAll('form[action*="/drivers/"][action*="/files/upload"]');

    forms.forEach(function (form) {
        const fileInputs = form.querySelectorAll('input[type="file"]');

        fileInputs.forEach(function (fileInput) {
            fileInput.addEventListener('change', function () {
                validateFileInput(fileInput);
            });
        });

        form.addEventListener('submit', function (event) {
            let valid = true;

            fileInputs.forEach(function (fileInput) {
                if (!validateFileInput(fileInput)) {
                    valid = false;
                }
            });

            if (!valid) {
                event.preventDefault();
            }
        });
    });
});