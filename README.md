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
* Для тестов в используется другая база : 'имя базы данных для проекта'_testing', указано в config/database.php -> 'testing'=[], а также в файле phpunit.xml <env name="DB_CONNECTION" value="testing"/>)
* Сделать миграции и сиды : php artisan migrate --seed
* Для тестов : php artisan test
* Покрытие тестов 90%, для покрытия использовался Xdebug
