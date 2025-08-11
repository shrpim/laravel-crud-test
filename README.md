# Laravel CRUD Test

Простое CRUD API на Laravel с тремя сущностями:
- **Пользователи** (`users`)
- **Посты** (`posts`)
- **Комментарии** (`comments`)

Проект реализует:
- REST API с методами CRUD для всех сущностей
- Связи: 
  - пользователь → посты
  - пользователь → комментарии
  - пост → комментарии
- Валидацию данных через **FormRequest**
- Документацию API через **Swagger (L5-Swagger)**

---

## 🚀 Установка и запуск

### 1. Клонирование репозитория
```bash
git clone https://github.com/shrpim/laravel-crud-test.git
cd laravel-crud-test
```

### 2. Установка зависимостей
```bash
./vendor/bin/sail composer install
./vendor/bin/sail npm install && ./vendor/bin/sail npm run dev
```

### 3. Настройка `.env`
Скопируйте `.env.example` в `.env` и настройте подключение к базе данных MySQL:
```env
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=sail
DB_PASSWORD=password
```

### 4. Запуск окружения
```bash
./vendor/bin/sail up -d
```

### 5. Миграции и наполнение тестовыми данными
```bash
./vendor/bin/sail artisan migrate --seed
```

### 6. Генерация Swagger-документации
```bash
./vendor/bin/sail artisan l5-swagger:generate
```

---

## 📌 API

Доступные маршруты:

| Метод | URI | Описание |
|-------|-----|----------|
| GET | `/api/users` | Список пользователей |
| POST | `/api/users` | Создать пользователя |
| GET | `/api/users/{id}` | Получить пользователя |
| PUT/PATCH | `/api/users/{id}` | Обновить пользователя |
| DELETE | `/api/users/{id}` | Удалить пользователя |
| GET | `/api/users/{id}/posts` | Посты пользователя |
| GET | `/api/users/{id}/comments` | Комментарии пользователя |
| GET | `/api/posts` | Список постов |
| POST | `/api/posts` | Создать пост |
| GET | `/api/posts/{id}` | Получить пост |
| PUT/PATCH | `/api/posts/{id}` | Обновить пост |
| DELETE | `/api/posts/{id}` | Удалить пост |
| GET | `/api/posts/{id}/comments` | Комментарии поста |
| GET | `/api/comments` | Список комментариев |
| POST | `/api/comments` | Создать комментарий |
| GET | `/api/comments/{id}` | Получить комментарий |
| PUT/PATCH | `/api/comments/{id}` | Обновить комментарий |
| DELETE | `/api/comments/{id}` | Удалить комментарий |

---

## 📄 Документация API
После генерации документации Swagger, она будет доступна по адресу:
```
http://localhost/api/documentation
```

---

## 🎯 Дополнительно реализовано
- Использование **FormRequest** для валидации при создании/обновлении записей
- Swagger-документация
- Возможность расширения тестами для контроллеров и FormRequest

---

## 📜 Лицензия
Проект распространяется под лицензией **MIT**.
