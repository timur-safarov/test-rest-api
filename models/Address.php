<?php

namespace models;

use Exception;


class Address extends Model
{

	/**
	 * Методом для вывода имени таблицы
	 * @return string
	 */
	public static function tableName()
	{
		//разделяем строку по символу "\" и берём последнее значение
		$explode = explode('\\', __CLASS__);
		return end($explode);
	}



}