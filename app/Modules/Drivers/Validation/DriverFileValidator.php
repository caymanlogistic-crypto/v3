<?php

declare(strict_types=1);

namespace App\Modules\Drivers\Validation;

final class DriverFileValidator
{
    private const ALLOWED_EXTENSIONS = [
        'pdf',
        'doc',
        'docx',
        'xls',
        'xlsx',
        'jpg',
        'jpeg',
        'png',
        'webp',
    ];

    private const ALLOWED_TYPES = [
        'passport',
        'license',
        'snils',
        'other',
    ];

    private const MAX_FILE_SIZE = 20971520; // 20 MB

    public function validate(array $data, array $file): array
    {
        $errors = [];

        if (empty($data['file_type']) || !in_array($data['file_type'], self::ALLOWED_TYPES, true)) {
            $errors['file_type'] = 'Недопустимый тип файла';
        }

        if (empty($file) || !isset($file['error'])) {
            $errors['file'] = 'Файл не выбран';
            return $errors;
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            $errors['file'] = $this->getUploadErrorMessage($file['error']);
            return $errors;
        }

        if (!is_uploaded_file($file['tmp_name'])) {
            $errors['file'] = 'Неверный файл';
            return $errors;
        }

        $extension = strtolower(pathinfo((string) $file['name'], PATHINFO_EXTENSION));

        if ($extension === '' || !in_array($extension, self::ALLOWED_EXTENSIONS, true)) {
            $errors['file'] = 'Недопустимое расширение файла';
        }

        if ((int) $file['size'] > self::MAX_FILE_SIZE) {
            $errors['file'] = 'Файл слишком большой. Максимальный размер: 20 MB';
        }

        return $errors;
    }

    private function getUploadErrorMessage(int $error): string
    {
        return match ($error) {
            UPLOAD_ERR_INI_SIZE, UPLOAD_ERR_FORM_SIZE => 'Файл слишком большой. Максимальный размер: 20 MB',
            UPLOAD_ERR_PARTIAL => 'Файл был загружен не полностью',
            UPLOAD_ERR_NO_FILE => 'Файл не выбран',
            UPLOAD_ERR_NO_TMP_DIR => 'Временная папка недоступна',
            UPLOAD_ERR_CANT_WRITE => 'Не удалось записать файл на диск',
            UPLOAD_ERR_EXTENSION => 'Загрузка файла прервана расширением',
            default => 'Ошибка загрузки файла',
        };
    }
}
