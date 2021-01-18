ci:
	vendor/bin/ecs check
	bin/phpunit tests
run:
	composer install --no-interaction --prefer-dist
	exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
