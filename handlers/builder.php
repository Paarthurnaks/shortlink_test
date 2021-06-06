<?php

namespace App;

if (!class_exists('\App\Classes\DB'))
{
    // подключение базы данных
    require_once ($_SERVER['DOCUMENT_ROOT'] ."/classes/db.php");
}

require_once ($_SERVER['DOCUMENT_ROOT'] . '/classes/builder.php');

use \App\Classes\Builder;

// если была отправлена ссылка
if (isset($_REQUEST['original_link']))
{
    $Builder = new Builder;

    $link = $Builder->create($_REQUEST['original_link']);
    echo $link;
}






