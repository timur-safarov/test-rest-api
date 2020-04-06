<?php
namespace controllers;

use libraries\Template;
use models\User;
use Exception;

class MainController
{

	private $config;

	public function __construct()
	{

		$this->config = $GLOBALS['config'];
		return __METHOD__;
	}

	/**
	 *  Вывод главной страницы с формой
	 *  @return string
	 */
	public function Index()
	{

		//Тут делаем запрос в rest Api чтобы получить данные по стране
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $this->config['root_url'].'/user-api/location_get?token='.$this->config['rest']['token'],
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'GET',
		  CURLOPT_POSTFIELDS => [],
		  CURLOPT_HTTPHEADER => array(
		    'accept: application/json',
		    'cache-control: no-cache',
		    'X-HTTP-METHOD: GET' //Указываем наш метод GET|POST|PUT|DELETE
		  ),
		));

		$err = curl_error($curl);

		if ($err) {
		  $user_fields = false;
		} else {
		  $user_fields = curl_exec($curl);
		}

		curl_close($curl);

		return Template::show('main/index', [
			'user_fields' => json_decode($user_fields),
			'title' => 'Форма регистрации'
		], 'main');
	}


	/**
	 *  Добавление нового пользователя
	 *  @return string
	 */
	public function AddNewUser()
	{

		//Тут делаем запрос в rest Api чтобы получить данные по стране
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $this->config['root_url'].'/user-api/add-new-user_post?token='.$this->config['rest']['token'],
		  CURLOPT_HEADER => false,
		  CURLOPT_FRESH_CONNECT => FALSE,
		  CURLOPT_NOBODY => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POST => true,
		  CURLOPT_POSTFIELDS => $_POST,
		  //если CURLOPT_RETURNTRANSFER = true тогда echo curl_exec($curl)
		  CURLOPT_RETURNTRANSFER => false,

		  CURLOPT_HTTPHEADER => array(
		    'Accept: application/json',
		    //'Content-Type: application/json',
		    //Если другой заголовок то POST будет пустой
		    'Content-Type: multipart/form-data',
		    //Authorization не передатся по умолчанию
		   	//Если php настроен как модуль Apache 
		   	//тогда нужно смотреть вот эти перепенные $_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW']
		   	//Или проще указать в htaccess вот это RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
		   	//Тогда $_SERVER['HTTP_AUTHORIZATION'] будет видна
		    'Authorization: '.$this->config['rest']['username'].':'.$this->config['rest']['pass'],
		    'cache-control: no-cache',
		    'X-HTTP-METHOD: POST' //Указываем наш метод GET|POST|PUT|DELETE
		  )
		));

		$err = curl_error($curl);

		if ($err) {
		  $responce = false;
		} else {
		  $responce = curl_exec($curl);
		}

		curl_close($curl);

		return $responce;

		
	}


}