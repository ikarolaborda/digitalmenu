.DEFAULT_GOAL := help

help:
	@echo "Please choose what you want to do: \n" \
	" make docker-up: start docker container \n" \
	" make docker-down: stop docker container \n" \
	" make docker-restart: restart docker container \n" \
	" make dci: composer install inside container \n" \
	" make dcu: composer update inside container \n" \
	" make access-mysql: go into the mysql container \n" \
	" make access-php: go into the php container \n"

docker-up:
	export COMPOSE_FILE=docker-compose.yml; docker-compose up -d

docker-down:
	export COMPOSE_FILE=docker-compose.yml; docker-compose down --volumes

docker-restart:
	export COMPOSE_FILE=docker-compose.yml; docker-compose down --volumes && docker-compose up -d

dci:
	docker exec -it php composer install && sudo chown -R $(USER):$(shell id -g) vendor

dcu:
	docker exec -it php composer update && sudo chown -R $(USER):$(shell id -g) vendor

access-mysql:
	docker exec -it database bash

access-php:
	docker exec -it php bash