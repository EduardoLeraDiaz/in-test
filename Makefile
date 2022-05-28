dev:
	USERID=$$(id -u) \
	USERGID=$$(id -g) \
	docker-compose -p insider -f docker/docker-compose.yml up -d --build

composer:
	docker exec -ti insider_php composer install

test-unit:
	docker exec -ti insider_php vendor/bin/phpunit

nodev:
	docker-compose -p insider -f docker/docker-compose.yml kill
	docker-compose -p insider -f docker/docker-compose.yml rm -f

enter:
	docker exec -ti insider_php /bin/bash

nginx-enter:
	docker exec -ti insider_nginx /bin/bash

nginx-reload:
	docker exec -ti insider_nginx service nginx reload

status:
	docker-compose -p insider -f docker/docker-compose.yml ps
