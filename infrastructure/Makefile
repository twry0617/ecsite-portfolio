up:
	docker-compose up -d
build:
	docker-compose build --no-cache --force-rm
create-project:
	mkdir -p ./docker/php/bash/psysh
	touch ./docker/php/bash/.bash_history
	@make build
	@make up
	docker-compose exec app composer create-project --prefer-dist "laravel/laravel=6.8" .
	docker-compose exec app composer require predis/predis
	docker-compose exec app composer require doctrine/dbal
	docker-compose exec app composer require laravel/helpers
install-recommend-packages:
	docker-compose exec app composer require --dev barryvdh/laravel-ide-helper
	docker-compose exec app composer require --dev beyondcode/laravel-dump-server:1.3.0
	docker-compose exec app composer require --dev barryvdh/laravel-debugbar
	docker-compose exec app php artisan vendor:publish --provider="BeyondCode\DumpServer\DumpServerServiceProvider"
	docker-compose exec app php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"