<?php

declare(strict_types=1);

namespace App\Core\Auth;

use App\Core\Database\Database;
use PDO;

final class Auth
{
    public static function attempt(
        string $email,
        string $password
    ): bool {

        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            "
            SELECT *
            FROM users
            WHERE email = :email
            LIMIT 1
            "
        );

        $stmt->execute([
            'email' => $email
        ]);

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return false;
        }

        if (
            !password_verify(
                $password,
                $user['password']
            )
        ) {
            return false;
        }

        $_SESSION['user_id'] = $user['id'];

        return true;
    }

    public static function logout(): void
    {
        unset($_SESSION['user_id']);
    }

    public static function check(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public static function id(): ?int
    {
        return $_SESSION['user_id'] ?? null;
    }

    public static function user(): ?array
    {
        if (!self::check()) {
            return null;
        }

        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            "
            SELECT *
            FROM users
            WHERE id = :id
            LIMIT 1
            "
        );

        $stmt->execute([
            'id' => self::id()
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC)
            ?: null;
    }

    public static function can(
        string $permission
    ): bool {

        if (!self::check()) {
            return false;
        }

        $pdo = Database::connection();

        $stmt = $pdo->prepare(
            "
            SELECT COUNT(*) as total

            FROM permissions p

            INNER JOIN role_permissions rp
                ON rp.permission_id = p.id

            INNER JOIN roles r
                ON r.id = rp.role_id

            INNER JOIN user_roles ur
                ON ur.role_id = r.id

            WHERE ur.user_id = :user_id
            AND p.name = :permission

            LIMIT 1
            "
        );

        $stmt->execute([
            'user_id' => self::id(),
            'permission' => $permission
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return (int)$result['total'] > 0;
    }
}
