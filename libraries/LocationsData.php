<?php

namespace libraries;

use Exception;

/**
 * Класс для получения патернов полей для формы регистрации
 */
class LocationsData
{

	private static $_instance = null;

	private function __construct()
	{

		try {

			$curl = curl_init();

			//$user_ip = '208.82.160.0';
			//$user_ip = '217.160.81.109';
			$user_ip = '85.113.55.87';


			//Тут лучше поменять на локаль чтобы без сторонних сервисов работало
			// Задаем ссылку
			curl_setopt($curl, CURLOPT_URL, 'http://ip-api.com/json/'.$user_ip);

			// Скачанные данные не выводить поток
			curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);

			// Скачиваем
			$response = json_decode(curl_exec($curl));

			// Закрываем соединение
			curl_close($curl);

			if ($response->status == 'fail') {
				throw new Exception($response->message);
			}

			//Проверим есть ли уже такая страна в нашем классе
			if (!method_exists(__CLASS__, $response->countryCode)) {
				throw new Exception('Страна '.$response->country.' не добавлена в наш сервис');
			}

			return self::{$response->countryCode}();

		} catch (Exception $e) {

		    return "Message: {$e->getMessage()}";
		}


	}


	public static function getInstance() 
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }

        return self::$_instance->__construct();
    }


	/**
	 *  Russia
	 *  @return array
	 */
	private function RU()
	{
		return [
		    'country' => [
		    	'name' => 'country',
		    	'pattern' => '^Россия$',
		    	'example' => 'Россия',
		    	'mes' => 'Формат страны не правильный',
		    	'flags' => ''
		    ],
		    'countryCode' => [
		    	'name' => 'countryCode',
		    	'pattern' => '^RU$',
		    	'example' => 'RU',
		    	'mes' => 'Формат кода страны не правильный',
		    	'flags' => ''
		    ],
			'region' => [
				'name' => 'region',
		    	'pattern' => '^[а-яёА-ЯЁ0-9-\s]{3,120}$',
		    	'example' => 'Самарская Область',
		    	'mes' => 'Формат региона не правильный',
		    	'flags' => ''
			],
			'city' => [
				'name' => 'city',
		    	'pattern' => '^[а-яёА-ЯЁ0-9-\s]{2,120}$',
		    	'example' => 'Самара',
		    	'mes' => 'Формат города не правильный',
		    	'flags' => ''
			],
			'zip' => [
				'name' => 'zip',
		    	'pattern' => '^[0-9]{6,6}$',
		    	'example' => '325679',
		    	'mes' => 'Формат индекса должен быть в виде 6 цифр',
		    	'flags' => ''
			],
			'company' => [
				'name' => 'company',
		    	'pattern' => '^[а-яёА-ЯЁ0-9-\s.]{2,150}$',
		    	'example' => 'Макдональдс',
		    	'mes' => 'Формат компании не верный',
		    	'flags' => ''
			],
			'address' => [
				'name' => 'address',
		    	'pattern' => '^[а-яёА-ЯЁ0-9-\s.]{2,120}$',
		    	'example' => 'Ул. Печёрская д. 3 кв. 1',
		    	'mes' => 'Формат адреса не верный',
		    	'flags' => ''
			],
			'district' => [
				'name' => 'district',
		    	'pattern' => '^[а-яёА-ЯЁ0-9-\s]{2,120}$',
		    	'example' => 'Кировский',
		    	'mes' => 'Формат района не верный',
		    	'flags' => ''
			]
		];
	}


	/**
	 *  Germany
	 *  @return array
	 */
	private function DE()
	{

		return [
		    'country' => [
		    	'name' => 'country',
		    	'pattern' => '^Deutschland$',
		    	'example' => 'Deutschland',
		    	'mes' => 'Формат страны не правильный',
		    	'flags' => ''
		    ],
		    'countryCode' => [
		    	'name' => 'countryCode',
		    	'pattern' => '^DE$',
		    	'example' => 'DE',
		    	'mes' => 'Формат кода страны не правильный',
		    	'flags' => ''
		    ],
			'city' => [
				'name' => 'city',
		    	'pattern' => '^[a-zA-ZäöüßÄÖÜẞ0-9-\s]{2,120}$',
		    	'example' => 'Frankfurt am Main',
		    	'mes' => 'Формат города не правильный',
		    	'flags' => ''
			],
			'zip' => [
				'name' => 'zip',
		    	'pattern' => '^[0-9]{5,5}$',
		    	'example' => '12345',
		    	'mes' => 'Формат индекса должен быть в виде 5 цифр',
		    	'flags' => ''
			],
			'company' => [
				'name' => 'company',
		    	'pattern' => '^[a-zA-ZäöüßÄÖÜẞ0-9-_\s]{2,120}$',
		    	'example' => 'Macdonalds',
		    	'mes' => 'Формат компании не верный',
		    	'flags' => ''
			],
			'address' => [
				'name' => 'address',
		    	'pattern' => '^[a-zA-ZäöüßÄÖÜẞ0-9-\s.]{10,120}$',
		    	'example' => 'Musterstrü. 123 12345',
		    	'mes' => 'Формат адреса не верный',
		    	'flags' => ''
			]
		];

	}


	/**
	 *  United States
	 *  @return array
	 */
	private function US()
	{

		return [
		    'country' => [
		    	'name' => 'country',
		    	'pattern' => '^United States$',
		    	'example' => 'United States',
		    	'mes' => 'Формат страны не правильный',
		    	'flags' => ''
		    ],
		    'countryCode' => [
		    	'name' => 'countryCode',
		    	'pattern' => '^US$',
		    	'example' => 'US',
		    	'mes' => 'Формат кода страны не правильный',
		    	'flags' => ''
		    ],
		    'region' => [
				'name' => 'region',
		    	'pattern' => '^[a-zA-Z0-9-\s]{3,120}$',
		    	'example' => 'California Springs, CA 92926',
		    	'mes' => 'Формат региона не правильный',
		    	'flags' => ''
			],
			'company' => [
				'name' => 'company',
		    	'pattern' => '^[a-zA-Z0-9-_\s]{2,120}$',
		    	'example' => 'Macdonalds',
		    	'mes' => 'Формат компании не верный',
		    	'flags' => ''
			],
			'address' => [
				'name' => 'address',
		    	'pattern' => '^[a-zA-Z0-9-\s.]{10,120}$',
		    	'example' => '455 Larkspur Dr.',
		    	'mes' => 'Формат адреса не верный',
		    	'flags' => ''
			]
		];








	}


}