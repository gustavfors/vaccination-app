# setup

Clone repo:
```
git clone https://github.com/gustavfors/vaccination-app
```

cd into the folder:
```
cd vaccination-app
```

Run the containers for the web server:
```
docker-compose up -d --build site
```

Migrate the database:
```
docker-compose run --rm artisan migrate
```

Seed the database:
```
docker-compose run --rm artisan db:seed
```

Create a symbolic link for images to work:
```
docker-compose run --rm artisan storage:link
```

Ports:
```
nginx- :8080
mysql - :3306
php - :9000
```

If ports are already in use, change them in the docker-compose.yml

example old:
```
mysql:
    ports:
      - "3306:3306"
```

example new:
```
mysql
    ports:
      - "4306:3306"
```

Regular user example (contains example family with some vaccinations)
```
username: demo@healthzone.com
password: healthzone123
```

admin user example (empty, but can add new vaccines to the database)
```
username: admin@healthzone.com
password: healthzone123
```
