test:
	composer run-script phpunit tests
install:
	composer install
run:
	php -S localhost:8001 -t public
logs:
	tail -f storage/logs/lumen.log
lint:
	composer run-script phpcs -- --standard=PSR2 public routes app
