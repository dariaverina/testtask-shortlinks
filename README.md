# URL Shortener

**URL Shortener** — это простое веб-приложение для сокращения длинных URL-адресов.

## 🚀 Установка и настройка

### 1. Клонирование репозитория

Если вы ещё не клонировали репозиторий, используйте команду:

git clone https://github.com/dariaverina/testtask-shortlinks.git

Важно: Убедитесь, что вы клонируете репозиторий в корневую папку вашего веб-сервера. Например, для OpenServer это может быть папка domains/ваш-проект.

### 2. Настройка конфигурации

Создайте файл конфигурации `config.php` на основе примера:

cp config.example.php config.php

### 3. Инициализация базы данных

Перейдите по следующему адресу в вашем браузере для создания базы данных и таблиц:

[http://ваш-проект/install.php](http://ваш-проект/install.php)

### 4. Запуск приложения

Перейдите по следующему адресу для использования приложения:

[http://ваш-проект/](http://ваш-проект/)

## 🛠 Используемые технологии

- **PHP**: 8.1
- **MySQL**: 8.0 

## 📂 Файлы проекта

- **`index.php`**: Главная страница приложения.
- **`shorten.php`**: Обрабатывает запросы на сокращение URL.
- **`redirect.php`**: Перенаправляет короткие URL на исходные.
- **`install.php`**: Инициализирует базу данных и таблицы.
- **`src/Database.php`**: Класс для работы с базой данных.
- **`src/UrlShortener.php`**: Класс для сокращения URL.
- **`config.php`**: Конфигурационный файл для базы данных.
- **`styles.css`**: Стили для веб-страницы.

## 👤 Автор

Разработчик: **[Верина Дарья]**