##Тестовое задание

Тема: Проверка способностей кандидатов в PHP, MySQL, HTML, CSS, JavaScript и основы Linux.

Задача: Создать страницы для отображения движения транспорта и фиксации событий.

Условия:
1. База данных: одна БД, одна таблица. В БД требуется хранить информацию о номере транспортного средства. Важные поля: ID записи, наименование транспорта, номер транспорта, дата-время фиксации события, направление, маркер ручного ввода

2. Первая страница - отображение (index.html). Выводить элементы таблицы в порядке убывания по дате, исключая ID записи и маркер ручного ввода. Автоматически обновлять таблицу на странице раз в 5 секунд с дополнением новых записей (старые не удалять из DOM), создать обработчик для чтения данных по AJAX

3. Вторая страница - добавление путей вручную (form.html). Создать форму, в которую можно вводить наименование транспорта, номер транспорта и направление. Добавлять данные в таблицу с маркером ручного ввода и текущей датой, создать обработчик для приема данных формы по AJAX

4. Автоматическая периодическая задача: раз в 7 секунд добавлять в таблицу случайные данные о наименовании транспорта (например автобус, троллейбус, трамвай), номер от 1 до 100 и направление (перечень предопределенных улиц, например: Чехова, Пушкина, Герцена и т.д.) + удаление старых записей старше 2х минут, кроме тех, что добавлены вручную пользователем на второй странице.

5. Конечная программа должна работать на сервере Apache или nginx с поддержкой PHP 5.6+. Все запросы и автоматические операции, включая листинг SQL-запросов с параметрами должны записываться в лог-файл в корне директории сайта.

6. Использование backend-технологий не ограничено (разрешено использовать любые фреймворки, свои наработки и/или библиотеки).

## Установка:

```bash
git clone https://github.com/SkyNetRU/TestTask.git your_project_name
```
```bash
cd your_project_name
```
```bash
composer install
```

```bash
cp .env.example .env
```

configure .env

```bash
php artisan key:generate
```
```bash
php artisan migrate
```


```bash
sudo nano your_project_name/script.sh
```

paste this script
```bash
#!/bin/bash
curl -i -H "Accept: application/json" -H "Content-Type: application/json" http://your_domain_or_ip/generateTransport
curl -i -H "Accept: application/json" -H "Content-Type: application/json" http://your_domain_or_ip/deleteOldTransports
```

exit
```bash
ctrl+x 
```

and save
```bash
y
```

Run script in background every 7 seconds
```bash
nohup bash -c ' while true; do sleep 7; sh /var/www/your_project_name/script.sh ; done & '
```




