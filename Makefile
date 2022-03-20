# VARIABLES
DOCKER_COMPOSE = docker-compose
CONTAINER      = apache-tasting
EXEC           = docker exec -ti $(CONTAINER)
EXEC_PHP       = $(EXEC) php
SYMFONY        = $(EXEC_PHP) bin/console
COMPOSER       = $(EXEC) composer

.DEFAULT_GOAL := deploy

deploy: build
	@echo "📦 Build done"

build: create_env_file rebuild test

deps: composer-install create-database migrate fixture

create_env_file:
	@if [ ! -f .env.local ]; then cp .env .env.local; fi

# 🧪 Testing
test:
	$(EXEC) make run-tests
	@echo "Test Executed ✅"
run-tests:
	./vendor/bin/phpunit

# 🔦 Linter
lint:
	$(EXEC) ./vendor/bin/php-cs-fixer fix --diff
	@echo "Coding Standar Fixer Executed ✅"
lint-diff:
	$(EXEC_TI) ./vendor/bin/php-cs-fixer fix --dry-run --diff
	@echo "Coding Standar Fixer Executed ✅"

# 🐘 Composer
composer-install: ACTION=install

composer-update: ACTION=update $(module)

composer-require: ACTION=require $(module)

composer composer-install composer-update composer-require: create_env_file
	$(COMPOSER) $(ACTION) \
			--ignore-platform-reqs \
			--no-ansi

# 🐳 Docker Compose
start:
	@echo "🚀 Deploy!!!"
	$(DOCKER_COMPOSE) up -d
stop:
	@echo "🛑 Stop container!!!"
	$(DOCKER_COMPOSE) stop
recreate:
	@echo "🔥 Recreate container!!!"
	$(DOCKER_COMPOSE) up -d --build --remove-orphans --force-recreate
rebuild:
	@echo "🔥 Rebuild container!!!"
	$(DOCKER_COMPOSE) build --pull --force-rm --no-cache
	make start
	make deps

# 🦝 Apache
reload:
	$(EXEC) /bin/bash service apache2 restart || true

# 📦 Database
create-database:
	$(SYMFONY) doctrine:database:create --if-not-exists
	@echo "🎊 Database created!"

fixture:
	@$(SYMFONY) doctrine:fixtures:load --purge-with-truncate -q


# Migraciones
migrate-generate:
	$(SYMFONY) doctrine:migrations:generate

migrate:
	@$(SYMFONY) doctrine:migrations:migrate --no-interaction

migrate-diff:
	@$(SYMFONY) bin/console doctrine:migrations:diff

migrate-down : ACTION=down $(file)
migrate-up : ACTION=up $(file)
migrate-down migrate-up:
	@$(SYMFONY) bin/console --$(ACTION)


# Make Bundle
migration:
	$(SYMFONY) make:migration

entity:
	$(SYMFONY) make:entity

controller:
	$(SYMFONY) make:controller

#cache
clear:
	$(SYMFONY) cache:clear