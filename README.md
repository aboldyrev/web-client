# Веб клиент

![PHP version](https://img.shields.io/packagist/php-v/aboldyrev/web-client.svg)
[![Latest Stable Version](https://img.shields.io/packagist/v/aboldyrev/web-client.svg)](https://packagist.org/packages/aboldyrev/web-client)
[![Build Status](https://img.shields.io/travis/aboldyrev/web-client/master.svg?branch=master)](https://travis-ci.org/aboldyrev/web-client)
[![codecov](https://img.shields.io/codecov/c/github/aboldyrev/web-client/master.svg)](https://codecov.io/gh/aboldyrev/web-client)
[![Total Downloads](https://img.shields.io/packagist/dt/aboldyrev/web-client.svg)](https://packagist.org/packages/aboldyrev/web-client)
[![License](https://img.shields.io/github/license/aboldyrev/web-client.svg)](https://packagist.org/packages/aboldyrev/web-client)


Данный пакет является обёрткой над `guzzlehttp/guzzle` и добавляет следующий функционал:

 - возможность кешировать запросы
 - имитация «посещений» разными пользователями (автоматически/полуавтоматически)
   - обновлять user-agent
   - обновлять прокси-серверы (необходимо предварительно указать список прокси-серверов)
   - выставлять рандомную задержку перед запросом (от 0,5 до 5 секунд, либо любую свою)

Для user-agent'ов в пакете предусмотрен предустановленный список. Но можно задавать свои списки.
При использовании прокси-серверов необходимо заранее загрузить список (в пакете их нет). Формат записи должен быть один из следующих:
 - хост
 - хост:порт
 - логин@хост 
 - логин@хост:порт
 - логин:пароль@хост
 - логин:пароль@хост:порт
  
 ## Установка
 
 ``
 composer require aboldyrev/web-client
 ``
 
 ## Использование

Описание всех методов класса можно посмотреть [тут](https://aboldyrev.github.io/web-client/index.html)