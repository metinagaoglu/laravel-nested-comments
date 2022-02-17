# Comment system example with Laravel8 / MariaDB


This project is a test project that contains a nested comment example.


## Tech Stack

**Client:** Vue.js

**Server:** PHP8, Laravel 8

**Database:** MariaDB


## Run Locally (manually)

Clone the project

```bash
  git clone https://github.com/metinagaoglu/Laravel-Nested-Comment-SPA
```

Go to the project directory

```bash
  cd Laravel-Nested-Comment-SPA/src
```

```bash
  composer install
```

```bash
  php artisan key:generate
```

```bash
  edit .env file related your database credentials
```

Migrate your tables

```bash
  php artisan migrate
```

For sample data

```bash
  php artisan db:seed
```

For client side

```bash
  npm run dev
```

```bash
  php artisan serve --host=0.0.0.0
```

## Run Locally (automatic with docker composer)


```bash
  git clone https://github.com/metinagaoglu/Laravel-Nested-Comment-SPA
```

Go to the project directory

```bash
  cd Laravel-Nested-Comment-SPA
```

```bash
  docker-composer up
```

## Running Tests

To run tests, run the following command

```bash
  cd src/
  php artisan test
```


## Roadmap


- Optimize SQL queries

- Improve validation

- Don't use root account for database



## Useful resource

 - [Nested set model](https://en.wikipedia.org/wiki/Nested_set_model)
 - [Hierarchical and recursive queries in SQL](https://en.wikipedia.org/wiki/Hierarchical_and_recursive_queries_in_SQL)
 - [Laravel nestedset](https://github.com/lazychaser/laravel-nestedset)

