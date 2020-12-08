# Тестовое задание на вакансию PHP Developer

## Содержание тестового задания
Используя PHP 7 и фреймворк Symfony 5 (последние версии PHP 7.4 и Symfony 5.2), а также Doctrine ORM и с использованием Docker контейнера, написать REST API для создания и получения книг и авторов из базы данных в формате JSON. 

Требования к заданию:
- Написать миграцию, засеивающую тестовые таблицы ~10 000 книгами и ~10 000 авторами
- Реализовать запросы на создание книги и автора в базе /book/create, /author/create
- Реализовать запрос на получение списка книг с автором из базы /book/search c поиском по названию книги
- Написать Unit-тест
- Используя возможности Symfony по локализации контента, сделать мультиязычный метод получения информации о книге /{lang}/book/{Id}, где {lang} = en|ru и {Id} = Id книги. Формат ответа: {Id: 1, 'Name':'War and Peace|Война и мир'} - поле Name выводить на языке локализации запроса.

## Локальное развертывание проекта
Для запуска проекта на локальной машине должны быть установлены `docker` и `docker-compose`.

Для установки зависимостей запустите контейнер-уствновшик:

`$ docker-compose -f docker-compose-install.yml up`

Запустите требуемые сервисы, при необходимости измените конфликтующие порты nginx и postgres в `/docker-compose.yml`:

`$ docker-compose -f docker-compose.yml up`

Войдите в контейнер `symfony5_php` и накатите миграции в ручном режиме:

`$ docker exec -it symfony5_php /bin/bash`

`$ php bin/console doctrine:migrations:migrate`

Развернутый проект доступен по адресу http://localhost:80/

## Проверка работоспособности методов API

### 1. Поиск книг (параметр locale опциональный)
`GET localhost:81/book/search?search=книга11&locale=ru`

### 2. Просмотр локализованных данных о книге
`GET localhost:81/ru/book/1`

### 3. Добавление автора
`POST localhost:81/author/create`

```
{
    "translations":[
        {
            "locale":"en",
            "name":"Sergey Esenin"
        },
        {
            "locale":"ru",
            "name":"Сергей Есенин"
        }
    ]
}
```

### 4. Добавление книги
`POST localhost:81/book/create`

```
{
    "author":{
        "id":10002
    },
    "translations":[
        {
            "locale":"en",
            "title":"Hooligan's Confession"
        },
        {
            "locale":"ru",
            "title":"Исповедь хулигана"
        }
    ]
}
```
