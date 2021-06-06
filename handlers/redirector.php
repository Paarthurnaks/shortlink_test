<?php

namespace App\Handlers;

if (!class_exists('LinksTable'))
{
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/orm/links.php');
}

$shortlink = \App\DataTable\LinksTable::getByCode($_REQUEST['url']);

if (isset($shortlink[0]['ORIGINAL_LINK']))
{
    header('Location: '.$shortlink[0]['ORIGINAL_LINK']);
    die;
}
