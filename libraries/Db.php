<?php

namespace libraries;

use PDO;

/**
 * Класс для методов DataBase
 */
Class Db {


	private static $instance = null;
    
    private function __construct(){}

    /**
     * Предотвращает клонирование экземпляра класса
     *
     */
    final private function __clone(){}

    /**
	 * Метод для подключения к Базе
	 * @param array $config
	 * @return resource
	 */
    public static function getInstance(){
        
        if (self::$instance === null) {

        	$db = $GLOBALS['config']['db'];

            self::$instance = new PDO("mysql:host=$db[host];dbname=$db[dbname];charset=$db[charset]", $db['login'], $db['pass'], array(
				PDO::ATTR_PERSISTENT => true
			));
            self::$instance->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }
        
        return self::$instance;
    }


	/**
	 * Метод для добавления записей в Базу
	 * @param string $table
	 * @param array $values
	 * @param array $source
	 * @return bool|int
	 */
	public static function pdoSave(string $tableName, array &$values, array $source = []) {

		$set = "INSERT INTO {$tableName} (";
		$concat = [];

		$allowed = $values;
		$values = [];
		if (!$source) $source = &$_POST;

		foreach ($allowed as $k => $val) {
			if (isset($source[$k])) {
				$concat[] = "`$k`";
				$values[$k] = "'$source[$k]'";
			}
		}

		return self::getInstance()->exec($set.implode(',', $concat).") VALUES(". implode(',', $values).")");

	}


	/**
     * Метод для множественного добавления записей в Базу
     * @param string $table
     * @param array $values
     * @param array $source
     * @return bool|int
     */
    public static function pdoSaveBunch(string $tableName, array &$values, array $source = []) {

        $set = "INSERT INTO {$tableName} (";
        $concat = [];

        $allowed = $values;
        $values = [];
        if (!$source) $source = &$_POST;

        foreach ($allowed as $k => $val) {

            //Проверяем есть ли массив для добавления сразу множества записей
            if (is_array($val)) {

                foreach ($val as $k2 => $val2) {

                    if (isset($source[$k])) {
                        $concat[$k2] = "`$k2`";
                        $values[$k][$k2] = "'$val2'";
                    }

                }

                $values[$k] = "(" . implode(",", $values[$k]) . ")";
            }

        }

        return self::getInstance()->exec($set.implode(',', $concat).") VALUES". join(",", $values));

    }


	/**
	 * Метод для обновления записей в Базе
	 */
	public static function pdoUpdate(string $tableName, array &$values, $id, array $source = []) {

	}

	/**
	 * Метод для удаления записей в Базе
	 */
	public static function pdoDelete(string $tableName, &$id, array $source = []) {

	}



}