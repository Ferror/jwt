ci:
	composer validate
	vendor/bin/ecs check
	bin/phpunit tests --coverage-clover=coverage.xml
	#vendor/bin/phpstan analyze -c phpstan.neon
run:
	composer install --no-interaction --prefer-dist
	exec /usr/bin/supervisord -c /etc/supervisor/supervisord.conf
