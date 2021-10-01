<p align="center">
    <h2 align="center">Построено на базе</h2>
    <h1 align="center">Yii 2 Advanced Project Template</h1>
    <br>
</p>

Структура
-------------------

```
api
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    web/                 contains the entry script and Web resources
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```


Реализация RestFull API на базе модели заявок (Tickets) со след. св-вами:
- id - первичный ключ;
- title - заголовок;
- description - описание;
- image - прикрепленное изображение.

Был реализован контроллер CRUD;  

Методы API:
- GET /tikets      -  получение списка всех заявок;
- GET /tikets/1    -  получение заявки по id;
- POST /tikets     -  создание новой заявки;
- PUT /tikets/1    -  изменение заявки;
- DELETE /tikets/1 -  удаление заявки;

Для запуска тестов: 
```
открыть консоль -> перейти в корень проекта -> выполнить команду `vendor/bin/codecept run -- -c api`
```
