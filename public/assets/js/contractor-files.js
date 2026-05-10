document.addEventListener('DOMContentLoaded', function() {
    const maxSize = 20 * 1024 * 1024; // 20 MB
    const errorMsg = 'Файл слишком большой. Максимальный размер: 20 MB';

    function validateFile(fileInput) {
        const file = fileInput.files[0];
        if (file && file.size > maxSize) {
            showError(fileInput, errorMsg);
            return false;
        } else {
            clearError(fileInput);
            return true;
        }
    }

    function showError(fileInput, msg) {
        const errorDiv = fileInput.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('file-error')) {
            errorDiv.textContent = msg;
        }
    }

    function clearError(fileInput) {
        const errorDiv = fileInput.nextElementSibling;
        if (errorDiv && errorDiv.classList.contains('file-error')) {
            errorDiv.textContent = '';
        }
    }

    // Attach to all file inputs
    const fileInputs = document.querySelectorAll('input[type="file"][name="file"]');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            validateFile(this);
        });
    });

    // Before submit, validate all
    const forms = document.querySelectorAll('form[action*="/files/upload"]');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const fileInput = form.querySelector('input[type="file"][name="file"]');
            if (fileInput && !validateFile(fileInput)) {
                e.preventDefault();
            }
        });
    });
});