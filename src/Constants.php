<?php

/**
 * Copyright (c) 2019. CDEK-IT. All rights reserved.
 * See LICENSE.md for license details.
 *
 * @author Chizhekov Viktor
 */

namespace CdekSDK2;

/**
 * Class Constants
 * @package CdekSDK2
 */
class Constants
{
    /**
     * Хук: статусы.
     * @var string
     */
    const HOOK_TYPE_STATUS = 'ORDER_STATUS';

    /**
     * Хук: задел на будущее
     * @var string
     */
    const HOOK_TYPE_OTHER = 'ANYTHING_OTHER';

    /**
     * Ошибка авторизации
     * @var string
     */
    const AUTH_FAIL = 'Authentication is failed, please check your account and secure';

    /**
     * Страхование
     * @var string
     */
    const SERVICE_INSURANCE = 'INSURANCE';

    /**
     * Доставка в выходной день
     * @var string
     */
    const SERVICE_WEEKEND_DELIVERY = 'DELIV_WEEKEND';

    /**
     * Опасный груз.
     * @var string
     */
    const SERVICE_DANGEROUS_GOODS = 'DANGER_CARGO';

    /**
     * Забор в городе отправителе.
     * @var string
     */
    const SERVICE_PICKUP = 'TAKE_SENDER';

    /**
     * Доставка в городе получателе.
     * @var string
     */
    const SERVICE_DELIVERY_TO_DOOR = 'DELIV_RECEIVER';

    /**
     * Упаковка 1 310*215*280мм
     * @var string
     */
    const SERVICE_PACKAGE_1 = 'PACKAGE_1';

    /**
     * Примерка на дому.
     * @var string
     */
    const SERVICE_TRY_AT_HOME = 'TRYING_ON';

    /**
     * Частичная доставка.
     * @var string
     */
    const SERVICE_PARTIAL_DELIVERY = 'PART_DELIV';

    /**
     * Осмотр вложения.
     * @var string
     */
    const SERVICE_CARGO_CHECK = 'INSPECTION_CARGO';

    /**
     * Реверс.
     * @var string
     */
    const SERVICE_REVERSE = 'REVERSE';

    /**
     * Статус: Принят
     * @var string
     */
    const STATUS_ACCEPTED = 'ACCEPTED';

    /**
     * Статус: Создан
     * @var string
     */
    const STATUS_CREATED = 'CREATED';

    /**
     * Статус: Удален
     * @var string
     */
    const STATUS_DELETED = 'REMOVED';

    /**
     * Статус: Принят на склад отправителя
     * @var string
     */
    const STATUS_TAKEIN = 'RECEIVED_AT_SENDER_WAREHOUSE';

    /**
     * Статус: Выдан на отправку в городе отправителе
     * @var string
     */
    const STATUS_READY_FOR_SHIPMENT_IN_SENDER_CITY = 'READY_FOR_SHIPMENT_IN_SENDER_CITY';

    /**
     * Статус: Возвращен на склад отправителя
     * @var string
     */
    const STATUS_RETURNED_TO_SENDER_CITY_WAREHOUSE = 'RETURNED_TO_SENDER_CITY_WAREHOUSE';

    /**
     * Статус: Сдан перевозчику в городе отправителе
     * @var string
     */
    const STATUS_TAKEN_BY_TRANSPORTER_FROM_SENDER_CITY = 'TAKEN_BY_TRANSPORTER_FROM_SENDER_CITY';

    /**
     * Статус: Отправлен в г. транзит
     * @var string
     */
    const STATUS_SENT_TO_TRANSIT_CITY = 'SENT_TO_TRANSIT_CITY';

    /**
     * Статус: Встречен в г. транзите
     * @var string
     */
    const STATUS_ACCEPTED_IN_TRANSIT_CITY = 'ACCEPTED_IN_TRANSIT_CITY';

    /**
     * Статус: Принят на склад транзита
     * @var string
     */
    const STATUS_ACCEPTED_AT_TRANSIT_WAREHOUSE = 'ACCEPTED_AT_TRANSIT_WAREHOUSE';

    /**
     * Статус: Возвращен на склад транзита
     * @var string
     */
    const STATUS_RETURNED_TO_TRANSIT_WAREHOUSE = 'RETURNED_TO_TRANSIT_WAREHOUSE';

    /**
     * Статус: Выдан на отправку в г. транзите
     * @var string
     */
    const STATUS_READY_FOR_SHIPMENT_IN_TRANSIT_CITY = 'READY_FOR_SHIPMENT_IN_TRANSIT_CITY';

    /**
     * Статус: Сдан перевозчику в г. транзите
     * @var string
     */
    const STATUS_TAKEN_BY_TRANSPORTER_FROM_TRANSIT_CITY = 'TAKEN_BY_TRANSPORTER_FROM_TRANSIT_CITY';

    /**
     * Статус: Отправлен в г. получатель
     * @var string
     */
    const STATUS_SENT_TO_RECIPIENT_CITY = 'SENT_TO_RECIPIENT_CITY';

    /**
     * Статус: Встречен в г. получателе
     * @var string
     */
    const STATUS_ARRIVED_AT_RECIPIENT_CITY = 'ARRIVED_AT_RECIPIENT_CITY';

    /**
     * Статус: Принят на склад доставки
     * @var string
     */
    const STATUS_ACCEPTED_AT_RECIPIENT_CITY_WAREHOUSE = 'ACCEPTED_AT_RECIPIENT_CITY_WAREHOUSE';

    /**
     * Статус: Принят на склад до востребования
     * @var string
     */
    const STATUS_ACCEPTED_AT_PICK_UP_POINT = 'ACCEPTED_AT_PICK_UP_POINT';

    /**
     * Статус: Выдан на доставку
     * @var string
     */
    const STATUS_TAKEN_BY_COURIER = 'TAKEN_BY_COURIER';

    /**
     * Статус: Возвращен на склад доставки
     * @var string
     */
    const STATUS_RETURNED_TO_RECIPIENT_CITY_WAREHOUSE = 'RETURNED_TO_RECIPIENT_CITY_WAREHOUSE';

    /**
     * Статус: Вручен
     * @var string
     */
    const STATUS_DELIVERED = 'DELIVERED';

    /**
     * Статус: Не вручен
     * @var string
     */
    const STATUS_NOT_DELIVERED = 'NOT_DELIVERED';

    /**
     * Параметр типа аутентификации
     * @var string
     */
    const AUTH_PARAM_CREDENTIAL = 'client_credentials';

    /**
     * Ключ авторизации: тип аутентификации, доступное значение: client_credentials
     * @var string
     */
    const AUTH_KEY_TYPE = 'grant_type';

    /**
     * Ключ авторизации: идентификатор клиента, равен Account
     * @var string
     */
    const AUTH_KEY_CLIENT_ID = 'client_id';

    /**
     * Ключ авторизации: секретный ключ клиента, равен Secure password
     * @var string
     */
    const AUTH_KEY_SECRET = 'client_secret';

    /**
     * Настройки таймаута для запросов
     * @var integer
     */
    const CONNECTION_TIMEOUT = 10;

    /**
     * Адрес сервиса интеграции
     * @var string
     */
    const API_URL = 'https://api.cdek.ru/v2';

    /**
     * Адрес сервиса интеграции для тестов
     * @var string
     */
    const API_URL_TEST = 'https://api.edu.cdek.ru/v2';

    /**
     * Аккаунт для тестовой среды
     * @var string
     */
    const TEST_ACCOUNT = 'z9GRRu7FxmO53CQ9cFfI6qiy32wpfTkd';

    /**
     * Секретный ключ для тестовой среды
     * @var string
     */
    const TEST_SECURE = 'w24JTCv4MnAcuRTx0oHjHLDtyt3I6IBq';

    /**
     * Список корректных параметров, которые разроешено передавать для поиска офисов
     * @var array
     */
    const OFFICE_FILTER = [
        'citypostcode' => '',
        'cityid' => '',
        'type' => '',
        'countryid' => '',
        'countryiso' => '',
        'regionid' => '',
        'havecashless' => '',
        'allowedcod' => '',
        'isdressingroom' => '',
        'weightmax' => '',
        'lang' => '',
        'takeonly' => '',
    ];
}
