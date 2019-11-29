# SDK2.0 для сервиса интеграции СДЭК
[![Build Status](https://scrutinizer-ci.com/g/cdek-it/sdk2.0/badges/build.png?b=master)](https://scrutinizer-ci.com/g/cdek-it/sdk2.0/build-status/master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/cdek-it/sdk2.0/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/cdek-it/sdk2.0/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/cdek-it/sdk2.0/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/cdek-it/sdk2.0/?branch=master)
![Packagist](https://img.shields.io/packagist/l/cdek-it/sdk2.0)

Реализация API v2.0 для [интеграции со службой доставки СДЭК](https://www.cdek.ru/clients/integrator.html).
Данная SDK поможет быстрее внедрить в свой проект взаимодействие со службой доставки СДЭК.

Возможности SDK:
 
- создание заказа
- информация о заказе
- удаление заказа
- подписка на вебхуки
- информация о подписке на вебхуки
- удаление подписки на вебхуки
- получение списка ПВЗ
- создание заявки на вызов курьера
- информация о заявке на вызов курьера
- удаление заявки на вызов курьера

Работа со всеми методами API возможна только при наличии доступов к сервису интеграции, которые выдаются только при наличии договора с компанией СДЭК. 

***
### Требования
Требования — минимальны. Нужен PHP 7.0 или выше.

Данный SDK использует спецификацию [PSR-18 (HTTP-client)](https://www.php-fig.org/psr/psr-18/). 
Это значит в качестве HTTP-клиента можно использовать любой - клиент, поддерживающий данную спецификацию.
Если у вашего клиента нет поддержки этой спецификации, можно посмотреть [имеющиеся адаптеры для большинства популярных HTTP-клиентов](http://docs.php-http.org/en/latest/clients.html)


***
### Установка
Установка осуществляется с помощью менеджера пакетов Composer

```bash
composer require cdek-it/sdk2.0
```


***
### Документация

Полная документация располагается [тут](https://github.com/cdek-it/sdk2.0/blob/master/docs/index.md)


***
### Примеры использования

```php
$client = new Psr18Client();
$cdek = new \CdekSDK2\Client($client);
$cdek->setAccount('account');
$cdek->setSecure('secure');

// создание заказа
$order = Order::create([...]);
$res = $cdek->orders()->add($order);

if ($res->hasErrors()) {
    // Обрабатываем ошибки
    foreach ($res->getErrors() as $error) {
        //считываем ошибки
    }
}
if ($res->isOk()) {
    $cdek_order = $cdek->formatResponse($res, Order::class);
    //$cdek_order->uuid;
}

//получить список офисов
$res = $cdek->offices()->getFiltered(['countryiso' => 'kz']);
if ($res->isOk()) {
    $pvzlist = $cdek->formatResponse($res, \CdekSDK2\BaseTypes\PickupPointList::class)
    //$pvzlist->getCount();
}
```


### Тесты
Запуск тестов:
``` bash
$ composer test
```


### Лицензия
Данный проект распространяется [под лицензией MIT](LICENSE).
