# SDK2.0 для сервиса интеграции СДЭК
Реализация API v2.0 для [интеграции со службой доставки СДЭК](https://www.cdek.ru/clients/integrator.html).
Данная SDK поможет быстрее внедрить в свой проект взаимодействие со службой доставки СДЭК.


## Установка

```bash
composer require ttatpuot/cdek-sdk2.0
```
Требования — минимальны. Нужен PHP 7.1/8.0 или выше.


## Инициализация

```php
$client = new Psr18Client();
$cdek = new \CdekSDK2\Client($client, 'account', 'secure');
```
***Важно: Доступы к сервису интеграции (account и secure) необходимо [запросить по почте у СДЭК](mailto:integrator@cdek.ru).*** 

Доступы от личного кабинета не подходят.

Далее для всей работы с API используются методы объёкта `$cdek`, который мы получили выше.


### Тестирование работы сервиса

Для тестирования работы с API необходимо установить специальный режим для этого:

```php
$cdek->setTest(true);
```
В этом режиме будут применены тестовые доступы к сервису и запросы будут отправляться на тестовый сервер api.edu.cdek.ru 


## Использование

Для начала, важно знать про особенности работы:

| Особенности                                               |
|-----------------------------------------------------------|
| [Обработка ошибок](#обработка-ошибок)                     |
| [Валидация введенных данных](#валидация-введенных-данных) |
| [Исключения](#исключения)                                 |

Список реализованных методов API:

| Действие                                                                                                                | Название метода            |
|-------------------------------------------------------------------------------------------------------------------------|----------------------------|
| [Авторизация](#авторизация)                                                                                             | `authorize`                |
| [Создание заказа](#создание-заказа)                                                                                     | `orders()->add()`          |
| [Получение информации по заказу](#получение-информации-по-заказу)                                                       | `orders()->get()`          |
| [Удаление заказа](#удаление-заказа)                                                                                     | `orders()->delete()`       |
| [Подписка на вебхуки](#подписка-на-вебхуки)                                                                             | `webhooks()->add()`        |
| [Получение информации о подписке на вебхуки](#получение-информации-о-подписке-на-вебхуки)                               | `webhooks()->get()`        |
| [Получение списка всех подписок на вебхуки](#получение-списка-всех-подписок-на-вебхуки)                                 | `webhooks()->list()`       |
| [Удаление подписки на вебхуки](#удаление-подписки-на-вебхуки)                                                           | `webhooks()->delete()`     |
| [Получение информации из пришедших вебхуков](#получение-информации-из-пришедших-вебхуков)                               | `webhooks()->parse()`      |
| [Создание заявки на вызов курьера](#создание-заявки-на-вызов-курьера)                                                   | `intakes()->add()`         |
| [Получение информации о заявке на вызов курьера](#получение-информации-о-заявке-на-вызов-курьера)                       | `intakes()->get()`         |
| [Удаление заявки на вызов курьера](#Удаление-заявки-на-вызов-курьера)                                                   | `intakes()->delete()`      |
| [Получение списка ПВЗ](#получение-списка-пвз)                                                                           | `offices()->get()`         |
| [Получение списка ПВЗ с применением фильтра](#получение-списка-ПВЗ-с-применением-фильтра)                               | `offices()->getFiltered()` |
| [Создание запроса на формирование печатной формы накладной](#создание-запроса-на-формирование-печатной-формы-накладной) | `invoice()->add()`         |
| [Получение информации о состоянии печатной формы накладной](#получение-информации-о-состоянии-печатной-формы-накладной) | `invoice()->get()`         |
| [Скачивание печатной формы накладной](#скачивание-печатной-формы-накладной)                                             | `invoice()->download()`    |
| [Создание запроса на формирование печатной формы ШК-места](#создание-запроса-на-формирование-печатной-формы-шк-места)   | `barcodes()->add()`        |
| [Получение информации о состоянии печатной формы ШК-места](#получение-информации-о-состоянии-печатной-формы-шк-места)   | `barcodes()->get()`        |
| [Скачивание печатной формы ШК-места](#скачивание-печатной-формы-шк-места)                                               | `barcodes()->download()`   |
| [Получение cписка городов](#получение-cписка-городов)                                                                   | `cities()->getFiltered()`  |
| [Получение cписка регионов](#получение-cписка-регионов)                                                                 | `regions()->getFiltered()` |
| [Калькулятор. Расчет по доступным тарифам](#калькулятор-расчет-по-доступным-тарифам)                                    | `calculator()->add()`      |
| [Калькулятор. Расчет по коду тарифа](#калькулятор-расчет-по-коду-тарифа)                                                | `calculator()->add()`      |

>***И список методов, которые в разработке:***
> - Изменение заказа
> - Отображение информации о возвратах

Документация по API 2.0 сервиса интеграции доступна по [ссылке](https://api-docs.cdek.ru/29923741.html)


### Обработка ошибок

Все возвращаемые ответы содержат методы для проверки на успешность запроса и на ошибку, а также для получения сообщений об ошибках.

Следует так же оборачивать каждый запрос в блок try-catch для отслеживания ошибки запроса. Например, если API недоступен или не отвечает.

```php
try {
    $result = $cdek->orders()->add($order);
    
    if ($result->hasErrors()) {
        // Обрабатываем ошибки
        foreach ($result->getErrors() as $error) {
            $error['code'];
            $error['message'];
        }
    }
    if ($result->isOk()) {
        // Запрос успешно выполнился

        // Если не проверять $result->isOk() и в ответе будут ошибки,
        // то выбросится исключение RequestException
    }
} catch (\CdekSDK2\Exceptions\RequestException $exception) {
    $exception->getMessage(); //Сообщение об ошибке
}
```


### Валидация введенных данных

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

### Исключения
На данный момент реализовано 3 типа исключений:

#### [AuthException](../src/Exceptions/AuthException.php)
Выбрасывается при ошибке авторизации

#### [RequestException](../src/Exceptions/RequestException.php)
При ошибках в запросах (замена ClientExceptionInterface из PRS-18)

#### [ParsingException](../src/Exceptions/ParsingException.php)
При преобразовании в объекты SDK (иногда API сходит с ума и возвращает внутренние ошибки текстом без JSON-объекта)


### Авторизация

```php
$client = new Psr18Client();
$cdek = new \CdekSDK2\Client($client);
$cdek->setAccount('account');
$cdek->setSecure('secure');

// или
// $cdek = new \CdekSDK2\Client($client, 'account', 'secure');

try {
    $cdek->authorize();
    $cdek->getToken();
    $cdek->getExpire();
} catch (AuthException $exception) {
    //Авторизация не выполнена, не верные account и secure
    echo $exception->getMessage();
}
```
При ошибке авторизации выбрасывается исключение [AuthException](#authexception), которое сообщает, что данные для авторизации неверные.

***Важно:*** при выполнении любой операции (создание, удаление, получение информации) 
с любыми данными (офисы, вызовы курьера, заказы, хуки) 
если авторизация не выполнялась или истекло ее время жизни, то она будет выполнена.  

В связи с тем, что используется токенная авторизация, то после прохождения авторизации, результат выполнения - можно сохранить в кэш и в течении 6 минут использовать.

Токен и его время устаревания можно получить методами `getToken()` и `getExpire()` соответственно.

### Создание заказа

```php
use CdekSDK2\BaseTypes;

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
            'weight' => 1000,
            'length' => 12,
            'width' => 11,
            'height' => 8,
            'items' => [
                BaseTypes\Item::create([
                    'name' => 'Toys for man',
                    'ware_key' => 'Items_number_5',
                    'payment' => BaseTypes\Money::create(['value' => 0]),
                    'cost' => 0,
                    'weight' => 1000,
                    'amount' => 1,
                ]),
            ]
        ])
    ],
]);

$result = $cdek->orders()->add($order);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $response_order = $cdek->formatResponse($result, BaseTypes\Order::class);
    // получаем UUID заказа и сохраняем его
    $response_order->entity->uuid;
}

```
В случае успеха - мы преобразуем ответ системы в наш класс Order, и извлекаем его `uuid` для дальнейших операций.


### Получение информации по заказу

```php
$result = $cdek->orders()->get($uuid);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $response_order = $cdek->formatResponse($result, \CdekSDK2\Dto\OrderInfo::class);
    $response_order->entity->uuid;
}

```
В ответе возвращается структура, которая у нас описана в классе `Order` 


### Удаление заказа

```php
$result = $cdek->orders()->delete($uuid);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $response_order = $cdek->formatResponse($result, \CdekSDK2\BaseTypes\Order::class);
    $response_order->entity->uuid;
}

```
В ответ получаем объект `\CdekSDK2\BaseTypes\Order`, у которого в статусах указано, что он удален. 
Все повторные обращения к данному заказу по uuid будут возвращать ошибку.  

### Подписка на вебхуки

```php
use CdekSDK2\BaseTypes\WebHook;

$hook = WebHook::create([
    'url' => 'https://url_in_your_site/webhooks',
    'type' => \CdekSDK2\Constants::HOOK_TYPE_STATUS
]);

//или для получения хука о готовности печатной формы
$print_hook = WebHook::create([
    'url' => 'https://url_in_your_site/webhooks_for_print',
    'type' => \CdekSDK2\Constants::HOOK_PRINT_STATUS
]);

$result = $cdek->webhooks()->add($hook);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, WebHook::class);
    $response->entity->uuid;
}
```


### Получение информации о подписке на вебхуки

```php

$result = $cdek->webhooks()->get($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, BaseTypes\WebHook::class);
    $response->entity->uuid;
}
```


### Получение списка всех подписок на вебхуки

```php
$result = $cdek->webhooks()->list();
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponseList($res, BaseTypes\WebHookList::class);
    $response->items;
}
```
В результате запроса будут отображены все вебхуки, на которые оформлены подписки,
как для вебхуков по статусам, так и для вебхуков для печатных форм.


### Удаление подписки на вебхуки

```php
$result = $cdek->webhooks()->delete($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, BaseTypes\WebHook::class);
    $response->entity->uuid;
}
```


### Получение информации из пришедших вебхуков

```php
$input_hook = $cdek->webhooks()->parse($hook);

// получаем идентификатор сущности
$input_hook->uuid;
if ($input_hook->type === \CdekSDK2\Constants::HOOK_TYPE_STATUS) {
    // и можно получать информацию о статусах заказа
    $input_hook->attributes->cdek_number;
    $input_hook->attributes->status_code;
}
if ($input_hook->type === \CdekSDK2\Constants::HOOK_PRINT_STATUS) {
    // и можно получать ссылку на PDF файл и скачать его
    $input_hook->attributes->url;
    $input_hook->attributes->type;
    if ($input_hook->attributes->type === \CdekSDK2\Constants::PRINT_TYPE_INVOICE) {
        $cdek->invoice()->download($input_hook->uuid);
    } else {
        $cdek->barcodes()->download($input_hook->uuid);
    }
}
```
Добавлены новые вебхуки - о готовности печатных форм, новый тип добавлен в константы `CdekSDK2\Constants::HOOK_PRINT_STATUS`. 

Теперь обрабатывать вебхуки стало проще, один из вариантов указан выше.

Также добавлены константы для типов печатных форм `CdekSDK2\Constants::PRINT_TYPE_INVOICE` и `CdekSDK2\Constants::PRINT_TYPE_BARCODE`.

### Создание заявки на вызов курьера

```php
use CdekSDK2\BaseTypes\Intake;

$sender = \CdekSDK2\BaseTypes\Contact::create([
    'name' => 'Vasya',
    'company' => 'CDEK-IT',
    'email' => 'vasya@cdek.it',
    'phones' => [
        \CdekSDK2\BaseTypes\Phone::create(['number' => '+79991112222'])
    ]
]);

$intake = Intake::create([]);
$intake->intake_date = '2020-12-02';
$intake->intake_time_from = '09:00';
$intake->intake_time_to = '19:00';
$intake->name = 'Ждем курьера за 20 товарами';
$intake->weight = 10000;
$intake->sender = $sender;
$intake->from_location = \CdekSDK2\BaseTypes\Location::create([
    'address' => 'Кутузовский проспект 1-1',
    'code' => 137,
    'country_code' => 'RU'
]);

$result = $cdek->webhooks()->add($intake);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, Intake::class);
    $response->entity->uuid;
}
```


### Получение информации о заявке на вызов курьера

```php

$result = $cdek->intakes()->get($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, \CdekSDK2\BaseTypes\Intake::class);
    $response->entity->uuid;
}
```


### Удаление заявки на вызов курьера

```php
$result = $cdek->intakes()->delete($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, \CdekSDK2\BaseTypes\Intake::class);
    $response->entity->uuid;
}
```


### Получение списка ПВЗ

```php
$result = $cdek->offices()->get();
if ($result->isOk()) {
    //Запрос успешно выполнился
    $pvzlist = $cdek->formatResponseList($result, \CdekSDK2\Dto\PickupPointList::class);
    foreach($pvzlist->items as $pvz) {
        $pvz->code;
        $pvz->location->address;
        $pvz->location->address_full;
    }
}
```
Получить список офисов. Важно, что в этом случае будут выведены не все офисы и постаматы, а только первые 1000 штук. Лучше сразу использовать [getFiltered](#получение-списка-пвз-с-применением-фильтра), где среди прочего можно указать номер страницы (page) и лимит (limit) 



### Получение списка ПВЗ с применением фильтра

```php
$result = $cdek->offices()->getFiltered(['country_code' => 'kz']);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $pickupPointsList = $cdek->formatResponseList($result, \CdekSDK2\Dto\PickupPointList::class);
    foreach($pickupPointsList->items as $pickupPoint) {
        $pickupPoint->code;
        $pickupPoint->location->address;
    }
}
```
В результате данного запроса будут отображены пункты выдачи заказов расположенные в Казахстане.

Доступные фильтры описаны в константе `\CdekSDK2\Actions\Offices::FILTER` 


### Создание запроса на формирование печатной формы накладной

```php
use CdekSDK2\BaseTypes\Invoice;
use CdekSDK2\BaseTypes\OrdersList;

$invoice = Invoice::create([
    'orders' => [
        OrdersList::create([
            'order_uuid' => 'uuid'
        ]),
    ],
    'copy_count' => 1,
]);

$result = $cdek->invoice()->add($invoice);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, Invoice::class);
    $response->entity->uuid;
}
```
В результате данного запроса будет сформирована заявка на формирование накладной указанного заказа или заказов.


### Получение информации о состоянии печатной формы накладной

```php
$result = $cdek->invoice()->get($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, \CdekSDK2\BaseTypes\Invoice::class);
    if (isset($response->entity->statuses)) {
        foreach ($response->entity->statuses as $state) {
            $state->code;
        }
    }
}
```
Данный запрос отобразит все текущие статусы документа.


### Скачивание печатной формы накладной

```php
$result = $cdek->invoice()->download($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился - сохраняем файл
    file_put_contents('order.pdf', $result->getBody());
}
```
Данный запрос получает содержимое PDF файла в виде строк байтов и необходимо эти данные сохранить в файл.


### Создание запроса на формирование печатной формы ШК-места

```php
use CdekSDK2\BaseTypes\Barcode;
use CdekSDK2\BaseTypes\OrdersList;

$invoice = Barcode::create([
    'orders' => [
        OrdersList::create([
            'order_uuid' => 'uuid'
        ]),
        OrdersList::create([
            'cdek_number' => 1111000110
        ]),
    ],
    'copy_count' => 1,
]);

$result = $cdek->barcodes()->add($invoice);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, Barcode::class);
    $response->entity->uuid;
}
```
В результате данного запроса будет сформирована заявка на формирование этикеток ШК-мест для указанных заказов.


### Получение информации о состоянии печатной формы ШК-места

```php
$result = $cdek->barcodes()->get($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, \CdekSDK2\BaseTypes\Barcode::class);
    if (isset($response->entity->statuses)) {
        foreach ($response->entity->statuses as $state) {
            $state->code;
        }
    }
}
```
Данный запрос отобразит статусы ШК места 


### Скачивание печатной формы ШК-места

```php
$result = $cdek->barcodes()->download($uuid);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился - сохраняем файл
    file_put_contents('barcodes.pdf', $result->getBody());
}
```
Данный запрос получает содержимое PDF файла в виде строки байтов и необходимо эти данные сохранить в файл.


### Подписка на вебхуки

```php
use CdekSDK2\BaseTypes\WebHook;

$hook = WebHook::create([
    'url' => 'https://url_in_your_site/webhooks',
    'type' => CdekSDK2\Constants::HOOK_TYPE_STATUS
]);

$result = $cdek->webhooks()->add($hook);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponse($result, WebHook::class);
    $response->entity->uuid;
}
```


### Получение cписка городов

```php
$result = $cdek->cities()->getFiltered(['country_codes' => 'RU', 'city' => 'зеленогорск']);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $cities = $cdek->formatResponseList($result, \CdekSDK2\Dto\CityList::class);
    foreach($cities->items as $city) {
        $city->city;
        $city->code;
        $city->fias_guid;
    }
}
```
В результате данного запроса будут отображены все населенные пункты в России с именем "Зеленогорск".

Доступные фильтры описаны в константе `\CdekSDK2\Actions\LocationCities::FILTER` 


### Получение cписка регионов

```php
$result = $cdek->regions()->getFiltered(['country_codes' => 'RU', 'size' => 2]);
if ($result->isOk()) {
    //Запрос успешно выполнился
    $regions = $cdek->formatResponseList($result, \CdekSDK2\Dto\RegionList::class);
    foreach($regions->items as $region) {
        $region->region;
        $region->region_code;
    }
}
```
В результате данного запроса будет отображены два региона, которые находятся в России.

Доступные фильтры описаны в константе `\CdekSDK2\Actions\LocationRegions::FILTER` 

### Калькулятор. Расчет по доступным тарифам

```php
$tariff = CdekSDK2\BaseTypes\Tarifflist::create([]);
$tariff->date = (new \DateTime())->format(\DateTime::ISO8601);
$tariff->type = Tarifflist::TYPE_ECOMMERCE;
$tariff->currecy = Currencies::RUBLE;
$tariff->lang = Tarifflist::LANG_RUS;
$tariff->from_location = Location::create([
    'address' => 'Кутузовский проспект 1-1',
    'code' => 137,
    'country_code' => 'RU'
]);
$tariff->to_location = Location::create([
    'address' => 'Ленина 23-1',
    'code' => 270,
    'country_code' => 'RU'
]);
$tariff->packages = [
    Package::create([
        'weight' => 1000,
        'length' => 30,
        'width' => 20,
        'height' => 10,
    ])
];

$result = $cdek->calculator()->add($tariff);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatResponseList($result, \CdekSDK2\Dto\TariffList::class);
    //В $response будет объект \CdekSDK2\Dto\TariffList::class
}
```
В результате данного запроса будет возвращено все возможные тарифы между двумя локациями с указанными размерами посылки (или нескольких посылок)

### Калькулятор. Расчет по коду тарифа

Процесс похож на расчёт по доступным тарифам, за исключением указания номера конкретного тарифа и возвращаемого результата

```php
$tariff = CdekSDK2\BaseTypes\Tariff::create([]);
$tariff->date = (new \DateTime())->format(\DateTime::ISO8601);
$tariff->type = Tarifflist::TYPE_ECOMMERCE;
$tariff->currecy = Currencies::RUBLE;
$tariff->lang = Tarifflist::LANG_RUS;
//Номера тарифов есть в документации к API: https://api-docs.cdek.ru/63345430.html
$tariff->tariff_code = 139; //Номер тарифа: Посылка дверь-дверь
$tariff->from_location = Location::create([
    'address' => 'Кутузовский проспект 1-1',
    'code' => 137,
    'country_code' => 'RU'
]);
$tariff->to_location = Location::create([
    'address' => 'Ленина 23-1',
    'code' => 270,
    'country_code' => 'RU'
]);
$tariff->packages = [
    Package::create([
        'weight' => 1000,
        'length' => 30,
        'width' => 20,
        'height' => 10,
    ])
];

$result = $cdek->calculator()->add($tariff);
if ($result->hasErrors()) {
    // Обрабатываем ошибки
}

if ($result->isOk()) {
    //Запрос успешно выполнился
    $response = $cdek->formatBaseResponse($result, \CdekSDK2\Dto\Tariff::class);
    //В $response будет объект \CdekSDK2\Dto\Tariff::class
}
```