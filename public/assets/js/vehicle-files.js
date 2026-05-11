document.addEventListener('DOMContentLoaded', function () {
    var uploadForms = document.querySelectorAll('.vehicle-file-upload-form');

    if (!uploadForms.length) {
        return;
    }

    uploadForms.forEach(function (form) {
        var fileInput = form.querySelector('input[type="file"]');
        var submitButton = form.querySelector('button[type="submit"]');
        var fileTypeSelect = form.querySelector('select[name="file_type"]');

        form.addEventListener('submit', function (event) {
            if (!fileInput || !fileInput.value) {
                event.preventDefault();
                return;
            }

            var allowedExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'jpg', 'jpeg', 'png', 'webp'];
            var fileName = fileInput.value.toLowerCase();
            var extension = fileName.split('.').pop();

            if (!allowedExtensions.includes(extension)) {
                event.preventDefault();
                alert('Недопустимое расширение файла. Разрешены: pdf, doc, docx, xls, xlsx, jpg, jpeg, png, webp.');
                return;
            }

            if (fileInput.files && fileInput.files[0] && fileInput.files[0].size > 20971520) {
                event.preventDefault();
                alert('Файл слишком большой. Максимальный размер: 20 MB.');
                return;
            }

            if (fileTypeSelect && !fileTypeSelect.value) {
                event.preventDefault();
                alert('Пожалуйста, выберите тип файла.');
                return;
            }

            if (submitButton) {
                submitButton.disabled = true;
            }
        });
    });
});
