up:
	docker-compose up -d

down:
	docker-compose down

start:
	docker-compose start

stop:
	docker-compose stop

destroy:
	docker system prune -a

migrate-install:
	cd backend && php artisan migrate:install

migrate:
	cd backend && php artisan migrate