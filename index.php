<?php

/**
 * Тестовое задание "Сократитель ссылок"
 * Ссылка на тестовое задание https://docs.google.com/document/d/1wk3e5_Ggpe8blV5IZBFOmIIw-n5rWEe0oD1FMD-4vUI/edit
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




