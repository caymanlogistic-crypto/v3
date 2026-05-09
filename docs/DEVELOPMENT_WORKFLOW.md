# Development Workflow

## Roles

- ChatGPT / AI: provide architecture-aware guidance, document current implementation, and suggest stabilization improvements.
- Copilot: assist with code editing, file creation, and practical refactoring suggestions within existing architecture.
- Developer: review, validate, and apply changes carefully in the real codebase.

## Git workflow

- Keep a clean working tree before starting work.
- Use feature branches for stabilizing architecture or adding modules.
- Commit documentation and code changes together when they are related.

## Deployment workflow

- Deploy to shared hosting using `git pull` or manual sync.
- Use the public directory `public/` as the web root.
- Verify `php8.4` is available on the production host.

## Debugging workflow

- Reproduce issues locally with the same PHP version if possible.
- Use the current exception handler only for development.
- Log errors and avoid exposing stack traces in production.

## Shared hosting limitations

- Keep the application lightweight and framework-free.
- Avoid runtime dependencies that are hard to install on shared hosts.
- Use Composer only for essential packages.
- Document deployment and troubleshooting steps clearly.
