<?php
namespace api;

use libraries\LocationsData;
use api\Api;
use models\User;
use Exception;

class UserApi extends Api
{

	/**
	 * Получаем данные по пользователю в виде Json
	 */
	public function Location_get()
	{

		//$this->method определяется в конструкторе parent класса
		if ($this->method == 'GET') {
        	
            $this->run();
            print $this->response(LocationsData::getInstance(), 200);

        } else {
            print $this->response(['error' => 'Method '.$this->method.' is invalid']);
        }

	}


	/**
	 * Отправляем данные по новому пользователю в модель 
	 */
	public function AddNewUser_post()
	{

		if ($this->method == 'POST') {

			$this->run();
            print $this->response(User::save($_POST), 200);

		} else {
			print $this->response(['error' => 'Method '.$this->method.' is invalid']);
		}
		
	}


} 