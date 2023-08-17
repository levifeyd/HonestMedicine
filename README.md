# HonesMedicine
Тестовое задание для компании "Честная медицина"
## Описание
* Приложение включает : (Авторизацию + Регистрацию). CRUD система для компонентов( Items).
# Инструкция для установки"
* git clone https://github.com/levifeyd/HonestMedicine.git
* composer install
* npm install
* npm run build
* Добавить файл .env и создать базу данных DB_DATABASE = "имя базы данных"  и базу для тестов DB_DATABASE_TESTING = "имя базы данных"_testing
* Для тестов в используется другая база, указано в config/database.php -> 'testing'=[], а также в файле phpunit.xml <env name="DB_CONNECTION" value="testing"/>)
* Сделать миграции и сиды : php artisan migrate --seed для рабочей таблицы и для тестовой
* Сгенирировать ключ для приложения php artisan key:generate 
* Для тестов : php artisan test, для покрытия php artisan test --coverage
* Покрытие тестов 90%, для отображения % покрытия использовался Xdebug.
* Для тестирования api нужен api токен, его пожно получить отправив post запрос на /api/personal-access-tokens c телом запроса email и password указынные UserSeeder.php
