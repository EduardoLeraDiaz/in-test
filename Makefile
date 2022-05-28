dev:
	USERID=$$(id -u) \
	USERGID=$$(id -g) \
	docker-compose -p insider -f docker/docker-compose.yml up -d --build

nodev:
	docker-compose -p insider -f docker/docker-compose.yml kill
	docker-compose -p insider -f docker/docker-compose.yml rm -f

enter:
	docker exec -ti insider_php /bin/bash

enter-nginx:
	docker exec -ti insider_nginx /bin/bash

status:
	docker-compose -p insider -f docker/docker-compose.yml ps
