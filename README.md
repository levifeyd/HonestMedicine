# HonesMedicine
Тестовое задание для компании "Честная медицина"
## Описание
* Приложение включает : (Авторизацию + Регистрацию). CRUD система для компонентов( Items).
# Инструкция для установки"
* git clone https://github.com/levifeyd/HonestMedicine.git
* composer install
* npm install
* npm run dev
* установить файл env (для тестов в используется другая база : 'имя базы данных для проекта'_testing')
* Сделать миграции и сиды : php artisan migrate --seed
* Для тестов : php artisan test
