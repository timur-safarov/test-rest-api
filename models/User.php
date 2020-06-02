<?php

namespace models;

use Exception;
use models\Address;

class User extends Model
{

	/**
	 * Метод для вывода имени таблицы
	 * @return string
	 */
	public static function tableName()
	{
		//разделяем строку по символу "\" и берём последнее значение
		$explode = explode('\\', __CLASS__);
		return end($explode);
	}


	/**
	 * Метод сохранения нового пользователя
	 * @param array $fields
	 * @return string
	 */
	public static function save($fields)
	{

		try {

			parent::getInstance()->beginTransaction();

			$address = [
				'region' => ($fields['region']) ? $fields['region'] : false,
				'city' => ($fields['city']) ? $fields['city'] : false,
				'zip' => ($fields['zip']) ? $fields['zip'] : false,
				'address' => ($fields['address']) ? $fields['address'] : false,
				'district' => ($fields['district']) ? $fields['district'] : false
			];

			parent::pdoSave(Address::tableName(), $address);

			$addressId = parent::getInstance()->lastInsertId();

			$userData = [
				'addressId' => $addressId,
				'username' => $fields['username'],
				'email' => $fields['email'],
				'country' => $fields['country'],
				'company' => $fields['company'],
				'countryCode' => $fields['countryCode'],
				'password' => md5($fields['password'])
			];

			parent::pdoSave(self::tableName(), $userData, $userData);

			/*
			  Если хотя бы одна ошибка будет в одном из запросов 
			  то commit не будет выполнен и передёт в блок catch
		    */
		    return parent::getInstance()->commit();

	    }catch (PDOException $e){

		    parent::getInstance()->rollBack();

		    return false;
		    //echo $e->getMessage();
		}


	}


}