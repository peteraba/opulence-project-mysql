# opulence-project-postgres

This only serves as a test project for testing [opulence/Opulence](https://github.com/opulencephp/Opulence) changes with PostgreSQL.
It is based on [opulence/Project](https://github.com/opulencephp/Project), but provides a few (useless) migrations and a docker-compose file.

### To test [PR #122](https://github.com/opulencephp/Opulence/pull/122) (Primary key for migrations)

We need to ensure that both new installs work without any hassle and old installs can upgrade using the fix tool. To repeat the test

#### Test new installs

1. Check out this project
2. Bring up new containers with `docker-compose up -d`
3. Install dependencies with `docker-compose run php composer.phar install`
4. Play around with running migrations `docker-compose exec php sh`

Commands combined:
```
docker-compose up -d
docker-compose run php composer.phar install
docker-compose exec php sh
./apex migrations:up
./apex migrations:down
./apex migrations:down
./apex migrations:down
./apex migrations:down
./apex migrations:up
./apex migrations:down
./apex migrations:up
exit
```

Expected output:
```
/website # ./apex migrations:up
Running "up" migrations...
Successfully ran the following migrations:
Project\Infrastructure\Databases\Migrations\Init
Project\Infrastructure\Databases\Migrations\Second
Project\Infrastructure\Databases\Migrations\Third
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Third
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Second
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Init
/website # ./apex migrations:up
Running "up" migrations...
Successfully ran the following migrations:
Project\Infrastructure\Databases\Migrations\Init
Project\Infrastructure\Databases\Migrations\Second
Project\Infrastructure\Databases\Migrations\Third
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:up
Running "up" migrations...
Successfully ran the following migrations:
Project\Infrastructure\Databases\Migrations\Fourth
```

#### Test existing installs

1. Check out this project
2. Bring up new containers with `docker-compose up -d`
3. Install dependencies with `docker-compose run php composer.phar install`
4. Checkout the `master` branch from `vendor/opulence/opulence`
  - You can do this on your local computer
  - or you can log into the `php` container to do this:
    ```
    docker-compose exec php sh
    cd vendor/opulence/opulence
    git checkout master
    cd ../../../
    ```
5. Run migrations `docker-compose run php ./apex migrations:up`
4. Checkout the `primary-key-for-migrations` branch from `vendor/opulence/opulence`
    ```
    docker-compose exec php sh
    cd vendor/opulence/opulence
    git checkout primary-key-for-migrations
    cd ../../../
    ```
7. Fix the database schema migrations `docker-compose run php ./apex migrations:fix`
8. Play around with running migrations `docker-compose exec php sh`

Commands combined:
```
docker-compose up -d
docker-compose run php composer.phar install
docker-compose exec php sh
cd vendor/opulence/opulence
git checkout master
cd ../../../
./apex migrations:up
cd vendor/opulence/opulence
git checkout primary-key-for-migrations
cd ../../../
./apex migrations:fix
./apex migrations:down
./apex migrations:down
./apex migrations:down
./apex migrations:down
./apex migrations:up
./apex migrations:down
./apex migrations:up
exit
```

Expected output:
```
/website # ./apex migrations:up
Running "up" migrations...
Successfully ran the following migrations:
Project\Infrastructure\Databases\Migrations\Init
Project\Infrastructure\Databases\Migrations\Second
Project\Infrastructure\Databases\Migrations\Third
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Third
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Second
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Init
/website # ./apex migrations:up
Running "up" migrations...
Successfully ran the following migrations:
Project\Infrastructure\Databases\Migrations\Init
Project\Infrastructure\Databases\Migrations\Second
Project\Infrastructure\Databases\Migrations\Third
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:down
Rolling back last migration...
Successfully rolled back the following migrations:
Project\Infrastructure\Databases\Migrations\Fourth
/website # ./apex migrations:up
Running "up" migrations...
Successfully ran the following migrations:
Project\Infrastructure\Databases\Migrations\Fourth
```

#### Optionally play around with the database

You can check the database manually running the following command:

```
docker-compose exec db psql -U opulence opulence
```
