<?php

/**
 * Начальная установка базы данных (создание необходимых таблиц)
 */

namespace App;

// подключение базы данных
require_once "classes/db.php";

use App\Classes\DB;

$connection = DB::getConnection();

$sql = "SHOW TABLES LIKE 'links'";

$res = $connection->query($sql);

if ($res != false)
{
    $tables = $connection->fetch($res);

    if (count($tables[0]) > 0)
    {
        echo 'Необходимые таблицы уже установлены';
        return;
    }
}

$sql = "CREATE TABLE links (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    ORIGINAL_LINK TEXT NOT NULL,
    SHORT_LINK VARCHAR(255) NOT NULL,
    DATE_CREATE DATETIME NOT NULL,
    CODE VARCHAR(10) NOT NULL UNIQUE
)";

$res = $connection->query($sql);

if ($res === true)
{
    echo 'Готово!';
}
else
{
    echo 'Произошла ошибка!';
}


