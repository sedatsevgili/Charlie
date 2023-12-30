up:
	docker-compose up -d

down:
	docker-compose down

build:
	docker-compose build

logs:
	docker-compose logs -f

bash:
	docker-compose exec app bash