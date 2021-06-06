<?php

/**
 * Тестовое задание "Сократитель ссылок"
 */

namespace App;

// подключение базы данных
require_once ($_SERVER['DOCUMENT_ROOT'] ."/classes/db.php");

use App\Classes\DB;

$connection = DB::getConnection();

// редирект на оригинальную ссылку
if (isset($_REQUEST['url']))
{
    require_once ($_SERVER['DOCUMENT_ROOT'] ."/handlers/redirector.php");
}

// подключения шаблона
require_once($_SERVER['DOCUMENT_ROOT'] . "/templates/default/template.php");




