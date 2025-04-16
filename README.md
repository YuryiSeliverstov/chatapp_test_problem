# Тестовое задание для ООО "ЧатАпп"
# Стек технологий для выполнения задания
Laravel 12
MySQL
Docker
# Задание
Создать 2 таблицы
chats
messages
# Заполнить таблицы тестовыми данными
Создать 100 чатов.
Для каждого чата создать от 10 до 100 сообщений с рандомными датами и текстами различной длины.
Реализовать REST API метод, который позволит получить список чатов порциями по 20 шт. за один запрос.
Список должен быть отсортирован по time последнего сообщения в чате по убыванию (чтобы "свежие" чаты были вверху списка).
Для каждого чата в списке должен выводиться обрезанный текст последнего сообщения (до 100 символов).
Предположим, что система развивается и сообщений для каждого чата может быть от 10 тыс. и более. Необходимо оптимизировать метод получения списка чатов для работы с большими данными с учетом всех вышеперечисленных условий. Допускается добавлять или изменять поля в таблицах при необходимости.
# Обязательные требования
Ответ REST API метода должен быть в формате json.
Проект должен разворачиваться и работать через docker-compose. Для этого можно использовать Laravel Sail или собственную сборку.
В файле README.md необходимо описать точные шаги, которые позволят поднять проект на сервере при помощи docker-compose.
Код выложить на github.

# Компоненты
- Laravel v12.x
- PHP v8.4.x
- MySQL v8.1.x (default)
- phpMyAdmin v5.x
- Mailpit v1.x
- Vite v5.x
- Rector v1.x
- Redis v7.2.x

# Как развернуть
## Требования
	- Стабильная версия [Docker](https://docs.docker.com/engine/install/)
	- Совместимая версия [Docker Compose](https://docs.docker.com/compose/install/#install-compose)

### Первый запуск	
- `git clone https://github.com/YuryiSeliverstov/chatapp_test_problem.git`
- `cd chatapp_test_problem`
- `docker compose up -d --build`
- `docker compose exec php bash`
- `composer install`
- `php artisan migrate`
- `php artisan app:generate-chats`

### GET Метод для получения списка чатов
- URL: http://localhost/latest-chats?offset=0&limit=20

### Повторный запуск
- `docker compose up -d`

### phpMyAdmin
- URL: http://localhost:8080
- Server: `db`
- Username: `root`
- Password: `root`
- Database: `chatapp`