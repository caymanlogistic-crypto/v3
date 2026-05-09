# Deployment

## Shared hosting deployment

- Set document root to `public/` or use `/v3/public` as the public path.
- Keep the application lightweight and compatible with shared hosting constraints.
- Use PHP 8.4 on the host.

## Git pull deployment

- Pull changes into the deployment directory.
- Run `php8.4 composer.phar install --no-dev` if Composer dependencies change.
- Ensure `.env` is present and configured.

## GitHub Actions

- The project can use GitHub Actions for CI, but avoid heavy build steps.
- Validate code with simple PHP linting and syntax checks.
- Keep workflow lightweight and compatible with shared hosting.

## php8.4 usage

- Document that the global `php` binary on hosting may not be PHP 8.4.
- Always prefer `php8.4` for local and deployment commands.
- Example: `php8.4 -v` and `php8.4 composer.phar install`.

## Logs

- Application logs are stored in `storage/logs/`.
- Use log entries for debugging rather than exposing stack traces in production.

## Common commands

- `php8.4 composer.phar install`
- `php8.4 -l path/to/file.php` for syntax checks.
- `git status` to inspect pending changes.
- `git diff` before committing.

## Troubleshooting

- Verify `public/index.php` is reachable through the web server.
- Confirm environment variables are loaded from `.env`.
- Check database connection settings in `.env`.
- Ensure `storage/` directories are writable by the web server.
