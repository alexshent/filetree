# FileTree

в приложении использован паттерн MVC

core/Controller.php - базовый контроллер
core/Model.php - базовая модель, работа с базой через PDO
core/Router.php - маршрутизатор
core/View.php - базовое представление

application/Config.php - класс конфигурации приложения (доступ к базе, подключаемые CSS и JavaScript)

application/controllers/MainController.php - основной контроллер приложения
application/controllers/AjaxController.php - контроллер получения данных через асинхронные запросы (поддерево каталога читается при открытии каталога)

application/models/Node.php - модель данных типа Adjacency List Model (для изменения модели например на Path Enumeration Model или Nested Set Model нужно создать новый класс модели и переключить приложение на использование другой модели)

application/views/main/index.php - отображение по умолчанию
application/views/main/index.php - отображение шаблона HTML5 документа с включением стилей и скриптов
application/views/main/index.php - отображение дерева

public - открытый каталог вебсервера
public/index.php - точка входа в веб приложение
public/.htaccess - используется RewriteEngine для скрытия index.php

запрос вывода дерева
http://<webserver ip>/main/tree
например
http://192.168.1.103/main/tree

public/gettree.php - консольный скрипт сбора дерева, рекурсивно обходит каталог и сохраняет файлы в базу через модель application/models/Node.php
запускать из шелла
php gettree.php

treedb.sql - дамп базы на 50 тысяч записей из каталога /proc тестового сервера
