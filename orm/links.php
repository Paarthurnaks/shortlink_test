<?php

/**
 * Какое-то подобие ORM для таблицы Links
 */

namespace App\DataTable;

require_once ($_SERVER['DOCUMENT_ROOT'] . '/interfaces/datamanager.php');

use App\Interfaces\DataManagerInterface;

class LinksTable implements  DataManagerInterface
{
    /**
     * Возвращает имя таблицы
     * @return string
     */
    public static function getTableName ()
    {
        return 'Links';
    }

    /**
     * Возвращает поля таблицы
     * @return string[]
     */
    public static function getMap()
    {
        return array(
            'ID', 'ORIGINAL_LINK', 'SHORT_LINK', 'CODE', 'DATE_CREATE'
        );
    }

    /**
     * Добавляет запись в таблицу
     * @param $arFields
     */
    public static function add($arFields)
    {
        if (isset($arFields['fields']))
        {
            if (!isset($arFields['fields']['ORIGINAL_LINK']) || !filter_var($arFields['fields']['ORIGINAL_LINK'], FILTER_VALIDATE_URL))
            {
                echo "Отсутствует или неверно указана оригинальная ссылка";
                die;
            }

            if (!isset($arFields['fields']['SHORT_LINK']))
            {
                echo "Отсутствует сокращенная ссылка";
                die;
            }

            if (!isset($arFields['fields']['CODE']))
            {
                echo "Отсутствует код";
                die;
            }

            $sql = "INSERT INTO " . static::getTableName() . " 
                    (ORIGINAL_LINK, SHORT_LINK, DATE_CREATE, CODE) 
                    VALUES ('".$arFields['fields']['ORIGINAL_LINK']."','".$arFields['fields']['SHORT_LINK']."','".date('Y-m-d H:i:s')."','".$arFields['fields']['CODE']."')";

            \App\Classes\DB::getConnection()->query($sql);
        }
    }

    /**
     * Обновляет запись в таблице
     * @param $arFields
     * @return bool|\mysqli_result|string
     */
    public static function update($arFields)
    {
        if (!isset($arFields['id']))
        {
            return "Отсутствует поле id";
        }

        if (!isset($arFields['fields']['ORIGINAL_LINK']) || !filter_var($arFields['fields']['ORIGINAL_LINK'], FILTER_VALIDATE_URL))
        {
            return "Отсутствует или неверно указана оригинальная ссылка";
        }

        if (!isset($arFields['fields']['SHORT_LINK']))
        {
            return "Отсутствует сокращенная ссылка";
        }

        if (!isset($arFields['fields']['CODE']))
        {
            return "Отсутствует код";
        }

        $sql = 'UPDATE ' . static::getTableName() . ' SET ORIGINAL_LINK = "'.$arFields['fields']['ORIGINAL_LINK'].'", SHORT_LINK = "'.$arFields['fields']['SHORT_LINK'].'", CODE = "'.$arFields['fields']['CODE'].'" WHERE ID = "'.$arFields['id'].'"';

        $db_result = \App\Classes\DB::getConnection()->query($sql);

        return $db_result;
    }

    /**
     * Удаляет запись из таблицы
     * @param $id
     * @return array
     */
    public static function delete($id)
    {
        $sql = 'DELETE FROM ' . static::getTableName() . ' WHERE ID = "' .$id .'"';

        $db_result = \App\Classes\DB::getConnection()->query($sql);
        $result = \App\Classes\DB::getConnection()->fetch($db_result);

        return $result;
    }

    /**
     * Возвращает список записей с таблицы (простой вариант без условие > < != и так далее)
     * @param array $order
     * @param array $select
     * @param array $filter
     * @param null $limit
     * @return array
     */
    public static function getList($order = array(), $select = array(), $filter = array(), $limit = null)
    {
        $isOrder = 0;

        if (!function_exists('\array_key_first')) {
            function array_key_first(array $arr) {
                foreach($arr as $key => $unused) {
                    return $key;
                }
                return NULL;
            }
        }

        foreach (static::getMap() as $key => $value)
        {
            if (array_key_first($order) == $value)
            {
                if ($order[$value] == 'ASC' || $order[$value] == 'DESC')
                    $isOrder = 1;
            }
        }

        if ($isOrder == 0)
        {
            $order = array(
                'ID' => 'DESC'
            );
        }

        if (count($select) == 0)
        {
            $select = array(
                '*'
            );
        }

        if (count($filter) == 0)
            $isFilter = 0;
        else
            $isFilter = 1;

        $sql = 'SELECT ';

        foreach ($select as $key => $value)
        {
            if ($key + 1 == count($select))
                $sql .= $value;
            else
                $sql .= $value . ', ';
        }

        $sql .= ' FROM ' . static::getTableName() . ' ';

        if ($isFilter == 1)
        {
            $sql .= ' WHERE ';

            $i = 0;

            foreach ($filter as $key => $value)
            {
                $i++;

                if (\in_array($key, static::getMap()))
                {
                    if ($i == count($filter))
                        $sql .= $key . ' = "' . $value . '" ';
                    else
                        $sql .= $key . ' = "' . $value . '" and ';
                }
            }
        }

        $sql .=  ' ORDER BY ' . array_key_first($order) . ' '. $order[array_key_first($order)] . ' ';

        if ($limit != null)
        {
            $sql .= ' LIMIT ' . $limit;
        }

        $db_result = \App\Classes\DB::getConnection()->query($sql);
        $result = \App\Classes\DB::getConnection()->fetch($db_result);

        return $result;


    }

    /**
     * Возвращает запись по ID
     * @param $id
     * @return array
     */
    public static function getById($id)
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE ID = "' .$id .'"';

        $db_result = \App\Classes\DB::getConnection()->query($sql);
        $result = \App\Classes\DB::getConnection()->fetch($db_result);

        return $result;
    }

    /**
     * Возвращает запись по коду
     * @param $code
     * @return array
     */
    public static function getByCode($code)
    {
        $sql = 'SELECT * FROM ' . static::getTableName() . ' WHERE CODE = "' .$code .'"';

        $db_result = \App\Classes\DB::getConnection()->query($sql);
        $result = \App\Classes\DB::getConnection()->fetch($db_result);

        return $result;
    }
}
