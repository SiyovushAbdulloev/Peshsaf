DC := docker compose exec
FPM := $(DC) php-fpm
NODE := $(DC) node yarn
ARTISAN := $(FPM) php artisan

build:
	@docker compose build --no-cache

start:
	@docker compose up -d

stop:
	@docker compose stop

restart: stop start

setup: start composer-install migrate seed

composer-install:
	@$(FPM) composer install

composer-dumpautoload:
	@$(FPM) composer dumpautoload

keygen:
	@$(ARTISAN) key:generate

clear:
	@$(ARTISAN) optimize:clear

cache-clear:
	@$(ARTISAN) cache:clear

fresh:
	@$(ARTISAN) migrate:fresh

migrate:
	@$(ARTISAN) migrate

rollback:
	@$(ARTISAN) migrate:rollback

seed:
	@$(ARTISAN) db:seed

bash:
	@$(FPM) bash

node-install:
	@$(NODE) install

node-dev:
	@$(NODE) run dev

node-build:
	@$(NODE) run build
