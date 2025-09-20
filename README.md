
# Peshsaf

A modern Laravel project running inside Docker with:

- PHP-FPM, Nginx, MySQL containers
- Easy CLI via Makefile

---

## 🚀 Quick Start

### Prerequisites

- Docker & Docker Compose installed
- Make (for using Makefile commands)

### Setup & Run

```bash
# Build containers (without cache)
make build

# Start containers (in detached mode)
make start

# Install PHP dependencies
make composer-install

# Generate application key
make keygen

# Run migrations and seed database
make migrate
make seed

# Alternatively, run full setup in one go:
make setup
```
