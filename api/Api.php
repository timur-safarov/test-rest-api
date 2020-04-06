<?php
namespace api;

use Exception;
use RuntimeException;

abstract class Api
{

    /**
     * GET|POST|PUT|DELETE
     */
    protected $method = '';

    public $requestUri = [];
    public $requestParams = [];

    /**
     * Название метод для выполнения
     */
    protected $action = '';


    public function __construct() {
        header('Access-Control-Allow-Orgin: *');
        header('Access-Control-Allow-Methods: *');
        header('Content-Type: application/json');

        //Массив GET параметров разделенных слешем
        $this->requestUri = $GLOBALS['config']['request_uri'];
        $this->requestParams = $_REQUEST;

        try{

            //Определение метода запроса
            if (array_key_exists('HTTP_X_HTTP_METHOD', $_SERVER)) {

                if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'POST') {
                    $this->method = 'POST';
                } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'GET') {
                    $this->method = 'GET';
                } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'DELETE') {
                    $this->method = 'DELETE';
                } else if ($_SERVER['HTTP_X_HTTP_METHOD'] == 'PUT') {
                    $this->method = 'PUT';
                } else {
                    throw new Exception("Unexpected Header");
                }

            } else {
                $this->method = $_SERVER['REQUEST_METHOD'];
            }

        } catch(Exception $e) {

            die($this->response(['error' => $e->getMessage()]));
        }
    }

    /**
     * Проверяем можно ли подключиться к API
     */
    public function run() {

        //Если обнвление или добавление или удаление
        if (in_array($this->method, ['POST', 'DELETE', 'PUT'])) {

            $user = explode(':', $_SERVER['HTTP_AUTHORIZATION'])[0];
            $pass = explode(':', $_SERVER['HTTP_AUTHORIZATION'])[1];

            if ($user != $GLOBALS['config']['rest']['username']
                || $pass != $GLOBALS['config']['rest']['pass']) {
                throw new RuntimeException('User Not Found', 404);
            }
        }

        //Если просто Get
        if(@$_GET['token'] != $GLOBALS['config']['rest']['token']) {
            throw new RuntimeException('API token is invalid', 404);
        }
    }

    protected function response($data, $status = 500) {
        header("HTTP/1.1 " . $status . " " . $this->requestStatus($status));
        return json_encode($data);
    }

    private function requestStatus($code) {
        $status = array(
            200 => 'OK',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        );
        return ($status[$code])?$status[$code]:$status[500];
    }

    abstract protected function Location_get();
    abstract protected function AddNewUser_post();
    //abstract protected function view();
    //abstract protected function create();
    //abstract protected function update();
    //abstract protected function delete();
}
