install:
	docker-compose build
	docker-compose up -d
	cp project/.env.example project/.env
	docker exec zoo-app bash -c "composer install && php artisan key:generate"
	sudo chmod -R 777 ./project/storage ./project/bootstrap
	sudo chown -R ${USER} ./project
