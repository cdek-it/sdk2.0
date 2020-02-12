# SDK2.0 для сервиса интеграции СДЭК
Реализация API v2.0 для [интеграции со службой доставки СДЭК](https://www.cdek.ru/clients/integrator.html).
Данная SDK поможет быстрее внедрить в свой проект взаимодействие со службой доставки СДЭК.


## Установка  {: #install }

```bash
composer require cdek-it/sdk2.0
```
Требования — минимальны. Нужен PHP 7.0 или выше.


## Инициализация {: #initialize }

```php
$client = new Psr18Client();
$cdek = new \CdekSDK2\Client($client);
$cdek->setAccount('account');
$cdek->setSecure('secure');
```
***Важно: Доступы к сервису интеграции (account и secure) необходимо [запросить по почте у СДЭК](mailto=integrator@cdek.ru).*** 

Доступы от личного кабинета не подходят.

Далее для всей работы с API используются методы объёкта `$cdek`, который мы получили выше.


### Тестирование работы сервиса {: #testing }

Для тестирования работы с API необходимо установить специальный режим для этого:

```php
$cdek->setTest(true);
```
В этом режиме будут применены тестовые доступы к сервису и запросы будут отправляться на тестовый сервер integration.edu.cdek.ru 


## Использование {: #methods }

Список реализованных методов для API

Перечень основных методов класса `Client` ниже.

| Действие| Название метода |
| ----- | -------------- |
| [Авторизация](#authorize) | `authorize` |
| [Создание заказа](#orders_add) | `orders()->add()` |
| [Получение информации по заказу](#orders_get) | `orders()->get()` |
| [Удаление заказа](#orders_delete) | `orders()->delete()` |
| [Подписка на вебхуки](#webhooks_add) | `webhooks()->add()` |
| [Получение информации о подписке на вебхуки](#webhooks_get) | `webhooks()->get()` |
| [Удаление подписки на вебхуки](#webhooks_delete) | `webhooks()->delete()` |
| [Получение информации из пришедших вебхуков](#webhooks_parse) | `webhooks()->parse()` |
| [Создание заявки на вызов курьера](#intakes_add) | `intakes()->add()` |
| [Получение информации о заявке на вызов курьера](#intakes_get) | `intakes()->get()` |
| [Удаление заявки на вызов курьера](#intakes_delete) | `intakes()->delete()` |
| [Получение списка ПВЗ](#offices_get) | `offices()->get()` |
| [Получение списка ПВЗ с применением фильтра](#offices_getFiltered) | `offices()->getFiltered()` |


>***И список методов, которые в разработке:***
> - Изменение заказа
> - Списки городов и регионов
> - Печать накладной
> - Печать ШК

Документация по API 2.0 сервиса интеграции доступна по [ссылке](https://confluence.cdek.ru/pages/viewpage.action?pageId=29923741)


### Обработка ошибок {: #hasErrors }

Все возвращаемые ответы содержат методы для проверки на успешность запроса и на ошибку, также для получения сообщений об ошибках.

```php
/** @var \CdekSDK2\Http\ApiResponse $result */
$result = $cdek->orders()->add($order);

if ($result->hasErrors()) {
    // Обрабатываем ошибки
    foreach ($result->getErrors() as $error) {
        $error['code'];
        $error['message'];
    }
}
if ($result->isOk()) {
    //Запрос успешно выполнился
}
```


### Валидация введенных данных {: #validations }

Во всех базовых классах реализована валидация данных, которая позволяет проверять введенные данные на корерктность, т.е. указаны минимальные требования для успешного выполнения запросов на стороне API СДЭК.

```php
$sender = \CdekSDK2\BaseTypes\Contact::create([
    'name' => 'Иван Васильев',
    'company' => 'CDEK-IT',
    'email' => 'ivan.vasylyevich@cdek.it',
    'phones' => [
        \CdekSDK2\BaseTypes\Phone::create(['number' => '+79998887777'])
    ]
]);

$rec = \CdekSDK2\BaseTypes\Contact::create([
    'name' => 'Витька Балотоев',
    'email' => 'vitya@cdek.it',
    'phones' => [
        \CdekSDK2\BaseTypes\Phone::create(['number' => '+78008887777'])
    ]
]);

if ($sender->validate() && $rec->validate()) {
    // данные отправителя и получателя заполнены верно
}
```

### Исключения {: #exceptions}
На данный момент реализовано 3 типа исключений:
* AuthException - при ошибке авторизации
* RequestException - при ошибках в запросах (замена ClientExceptionInterface из PRS-18) 
* ParsingException - при преобразовании в объекты SDK


### Авторизация {: #authorize }

```php
$cdek = new \CdekSDK2\Client();
$cdek->setAccount('account');
$cdek->setSecure('secure');
try {
    $cdek->authorize();
    $cdek->getToken();
    $cdek->getExpire();
} catch (AuthException $exception) {
    //Авторизация не выполнена, не верные account и secure
    echo $exception->getMessage();
}
```
При ошибки авторизации выбрасывается исключение AuthException, которое сообщает, что данные для авторизации неверные.

***Важно:*** при выполнении любой операции (создание, удаление, получение информации) 
с любыми данными (офисы, вызовы курьера, заказы, хуки) 
если авторизация не выполнялась или истекло ее время жизни, то она будет выполнена.  

В связи с тем, что используется токенная авторизация, то после прохождения авторизации, результат выполнения - можно сохранить в кэш и в течении 6 минут использовать.

Токен и его время устаревания можно получить методами `getToken()` и `getExpire()` соответвенно.


### Создание заказа {: #orders_add }

```php
use CdekSDK2\BaseTypes;

$cdek = new \CdekSDK2\Client();
$cdek->setAccount('account');
$cdek->setSecure('secure');

$order = BaseTypes\Order::create([
    'number' => '3627',
    'tariff_code' => '1',
    'sender' => BaseTypes\Contact::create([
        'name' => 'Vasya',
    ]),
    'recipient' => BaseTypes\Contact::create([
        'name' => 'Alexander',
        'phones' => [
            BaseTypes\Phone::create(['number' => '88001234567'])
        ]
    ]),
    'from_location' => BaseTypes\Location::create([
        'code' => 137,
        'country_code' => 'ru'
    ]),
    'to_location' => BaseTypes\Location::create([
        'code' => 270,
        'country_code' => 'ru',
        'address' => 'Титова 21 кв 9'
    ]),
    'packages' => [
        BaseTypes\Package::create([
            'number' => 'number1',
            'weight' => '1',
            'length' => '12',
            'width' => '11',
            'height' => '8',
            'items' => [
                BaseTypes\Item::create([
                    'name' => 'Toys for man',
                    'ware_key' => 'Items_number_5',
                    'payment' => BaseTypes\Money::create(['value' => 0]),
                    'cost' => 0,
                    'weight' => 1,
                    'amount' => 1,
                ]),
            ]
        ])
    ],
]);

try {
    $res = $cdek->orders()->add($order);
    if ($result->isOk()) {
        //Запрос успешно выполнился
        $response_order = $cdek->formatResponse($result, BaseTypes\Order::class);
        $response_order->uuid;
    }
    if ($result->hasErrors()) {
        // Обрабатываем ошибки
    }
} catch (RequestException $exception) {
    echo $exception->getMessage();
}

```
В случае успеха - мы преобразуем ответ системы в наш класс Order, и извлекаем его `uuid` для дальнейших операций.


### Получение информации по заказу {: #orders_get }

```php
$cdek = new \CdekSDK2\Client();
$cdek->setAccount('account');
$cdek->setSecure('secure');

$result = $cdek->orders()->get($uuid);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $response_order = $cdek->formatResponse($result, BaseTypes\Order::class);
    $response_order->uuid;
}

```
В ответе возвращается структура, которая у нас описана в классе `Order` 


### Удаление заказа {: #orders_delete }

```php
$cdek = new \CdekSDK2\Client();
$cdek->setAccount('account');
$cdek->setSecure('secure');

$result = $cdek->orders()->delete($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response_order = $client->formatResponse($result, BaseTypes\Order::class);
    $response_order->uuid;
}

```
В ответ получаем объект `Order`, у которого в статусах указано, что он удален. 
Все повторные обращения к данному заказу по uuid будут возвращать ошибку.  

### Подписка на вебхуки {: #webhooks_add }

```php
use CdekSDK2\BaseTypes;

$cdek = new \CdekSDK2\Client();
$cdek->setAccount('account');
$cdek->setSecure('secure');

$hook = BaseTypes\WebHook::create([
            'url' => 'https://url_in_your_site/webhooks',
            'type' => CdekSDK2\Constants::HOOK_TYPE_STATUS
        ]);

$result = $cdek->webhooks()->add($hook);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $webhook = $cdek->formatResponse($result, BaseTypes\WebHook::class);
    $webhook->uuid;
}
```


### Получение информации о подписке на вебхуки {: #webhooks_get }

```php
$cdek = new \CdekSDK2\Client();
$result = $cdek->webhooks()->get($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $webhook = $cdek->formatResponse($result, BaseTypes\WebHook::class);
    $webhook->uuid;
}
```


### Удаление подписки на вебхуки {: #webhooks_delete }

```php
$cdek = new \CdekSDK2\Client();
$result = $cdek->webhooks()->delete($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $webhook = $cdek->formatResponse($result, BaseTypes\WebHook::class);
    $webhook->uuid;
}
```


### Получение информации из пришедших вебхуков {: #webhooks_parse }

```php
$cdek = new \CdekSDK2\Client();
$result = $cdek->webhooks()->parse($data);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $input_hook = $cdek->formatResponse($result, BaseTypes\InputHook::class);
    $input_hook->uuid;
}
```


### Получение списка ПВЗ {: #offices_get }

```php
$cdek = new \CdekSDK2\Client();
$result = $cdek->offices()->get();
if ($result->isOk()) {
    //Запрос успешно выполнился
    $pvzlist = $client->formatResponse($result, BaseTypes\PickupPointList::class);
    foreach($pvzlist->pvz as $pvz) {
        $pvz->Code;
        $pvz->Address;
    }
}
```
Получить весь список офисов.



### Получение списка ПВЗ с применением фильтра {: #offices_getFiltered }

```php
$cdek = new \CdekSDK2\Client();
$result = $cdek->offices()->getFiltered(['countryiso' => 'kz']);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $pvzlist = $client->formatResponse($result, BaseTypes\PickupPointList::class);
    foreach($pvzlist->pvz as $pvz) {
        $pvz->Code;
        $pvz->Address;
    }
}
```
В результате данного запроса будут отображены пункты выдачи заказов расположенные в Казахстане.

Доступные фильтры описаны в константе `\CdekSDK2\Constants::OFFICE_FILTER` 
