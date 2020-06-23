<?php

/**
 * Хост и имя базы данных
 */
const DSN_DB = "";

/**
 * Имя пользователя базы данных
 */
const USERNAME_DB = "";

/**
 * Пароль пользователя базы данных
 */
const PASSWORD_DB = "";

/**
 * Путь до проекта
 */
const PROJECT_PATH = "";

/**
 * Массив id администраторов
 */
const ADMIN_ID = [];

/**
 * Адрес сайта
 */
const ADDRESS = '';

/**
 * Тип шаблона, который проходит рендеринг
 */
const VIEW_TYPE = '';

/**
 * Email с которого высылаются сообщения об успешной регистрации
 */
const EMAIL = '';

/**
 * Пароль от email, с которого высылаются сообщения об успешной регистрации
 */
const EMAIL_PASS = '';

/**
 * Подключение к базе данных (Eloquent)
 */

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

const CONNECTION_DEFAULT = "default";

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'users_bd',
    'username'  => USERNAME_DB,
    'password'  => PASSWORD_DB,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
], CONNECTION_DEFAULT);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();

// Setup the Database ORM... (optional; unless you've used setEventDispatcher())
$capsule->bootEloquent();

$capsule->getConnection(CONNECTION_DEFAULT)->enableQueryLog();