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
     * @var int
     */
    const SERVICE_DANGEROUS_GOODS = 7;

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
     * @var int
     */
    const SERVICE_PACKAGE_1 = 24;

    /**
     * Примерка на дому.
     * @var string
     */
    const SERVICE_TRY_AT_HOME = 'TRYING_ON';

    /**
     * Доставка лично в руки.
     * @var int
     */
    const SERVICE_PERSONAL_DELIVERY = 31;

    /**
     * Скан документов.
     * @var int
     */
    const SERVICE_DOCUMENTS_COPY = 32;

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
     * Статус: Создан
     * @var int
     */
    const STATUS_CREATED = 1;

    /**
     * Статус: Удален
     * @var int
     */
    const STATUS_DELETED = 2;

    /**
     * Статус: Принят на склад отправителя
     * @var int
     */
    const STATUS_TAKEIN = 3;

    /**
     * Статус: Вручен
     * @var int
     */
    const STATUS_DELIVERED = 4;

    /**
     * Статус: Не вручен
     * @var int
     */
    const STATUS_NOT_DELIVERED = 5;

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
