<?php

/**
 * Класс для генерации шортлинков
 */

namespace App\Classes;

class Builder
{
    // символы используемые в кодироке
    public $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    /**
     * Создание шортлинка
     * @param $link
     * @return string
     */
    public function create ($link)
    {
        if (!filter_var($link, FILTER_VALIDATE_URL))
        {
            echo "Неккоректная ссылка";
            die;
        }

        $code = substr(str_shuffle($this->permitted_chars), 0, 5);

        if (!class_exists('LinksTable'))
        {
            require_once ($_SERVER['DOCUMENT_ROOT'] . '/orm/links.php');
        }

        \App\DataTable\LinksTable::add(array(
            'fields' => array(
                'ORIGINAL_LINK' => $link,
                'SHORT_LINK' => $this->getShortLink($code),
                'CODE' => $code
            )
        ));

        return $this->getShortLink($code);
    }

    /**
     * Получение ссылки для ответа пользователю
     * @param $code
     * @return string
     */
    public function getShortLink($code)
    {
        return ($_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/' . $code);
    }
}