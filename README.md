# Название вашего API

Простое API для CRUD операций с сущностью пользователя

## Требования

- PHP >= 7.3
- MySQL (или MariaDB)
- Composer
- Laravel
- Laravel Sanctum

## Начало работы

Эти инструкции помогут вам запустить копию проекта на вашем локальном компьютере для разработки и тестирования.

### Установка

Следуйте этим шагам для настройки вашего проекта локально.

1. Клонировать репозиторий:
   
   git clone https://github.com/childofemptiness/userAPI.git
   cd your-project-name
   

2. Установить зависимости Composer:
   
   composer install
   

3. Настроить файл .env для подключения к базе данных и других настроек:
   - Скопируйте .env.example в .env:
     
     copy .env.example .env
     
   - Отредактируйте .env, установив параметры подключения к вашей базе данных:
     
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=your_database_name
     DB_USERNAME=your_database_user
     DB_PASSWORD=your_database_password
     

4. Запустите миграции базы данных:
   
   php artisan migrate
   

5. Генерация ключа приложения:
   
   php artisan key:generate
   

6. Запустить локальный сервер:
   
   php artisan serve
   

### Утилиты API
#### Аутентификация

Для доступа к защищенным ресурсам API (например, получение, обновление и удаление пользователя) необходимо использовать токен аутентификации. Токен должен быть включен в заголовок запроса как Authorization:

```http
Authorization: Bearer <token>
```

## Использование

### Создание пользователя

```http
POST /api/users 
```

**Тело запроса:**

```json
{
    "name": "Alex",
    "email": "examplemail@mail.ru",
    "password": "123456",
}
```

**Ответ:**

```json
{
    "token": "3|2Q2gBjRBR7FiNOQqnpcxCaCxYmBERA3o9VKckmEv6084431c",
}
```

### Аутентификация пользователя

```http
POST /api/users/login
```

**Тело запроса:**

```json
{
    "name": "Alex",
    "email": "examplemail@mail.ru",
    "password": "123456",
}
```

**Ответ:**

```json
{
    "token": "3|2Q2gBjRBR7FiNOQqnpcxCaCxYmBERA3o9VKckmEv6084431c",
}
```

### Получение пользователя

```http
GET /api/users/{id}
Authorization: Bearer <token>
```

**Ответ:**

```json
{
    "id": 2,
    "name": "Alex",
    "email": "newmail@mail.ru",
    "email_verified_at": null,
    "created_at": "2024-05-05T11:38:11.000000Z",
    "updated_at": "2024-05-05T11:38:11.000000Z"
}
```

### Обновление пользователя

```http
PUT /api/users/{id}
Authorization: Bearer <token>
```

**Тело запроса:**

```json
{
    "name": "Jack",
    "email": "newexamplemail@mail.ru",
    "password": "123456",
}
```

**Ответ:**

```json
{
    "id": 2,
    "name": "Jack",
    "email": "newexamplemail@mail.ru",
    "email_verified_at": null,
    "created_at": "2024-05-05T11:38:11.000000Z",
    "updated_at": "2024-05-05T11:45:30.000000Z"
}
```

### Удаление пользователя

```http
DELETE /api/users/{id}
Authorization: Bearer <token>
```

**Ответ:**
```json
{}
```

## Лицензия

Этот проект распространяется под лицензией MIT.