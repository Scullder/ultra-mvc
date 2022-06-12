<?php
namespace Core;

class Request
{
  private $request = array();

  public function __construct()
  {

    if(isset($_GET)){
      $this->request = array_merge($this->request, $_GET);
    }
    if(isset($_POST)){
      $this->request = array_merge($this->request, $_POST);
    }
  }

  public function __get($request_key)
  {
    if(array_key_exists($request_key, $this->request)){
      return $this->request[$request_key];
    }
  }

  public function print(){ print_r($this->request);}

  public static function get_uri()
  {
    $uri = $_SERVER['REQUEST_URI'];
    if(strpos($uri, '?') !== false)
      return strstr($uri, '?', true);
    return $uri;
  }

  public static function get_url()
  {
    $uri = $_SERVER['REQUEST_URI'];
    return $uri;
  }

  public function isset_request()
  {
    if(!empty($this->request)){
      return true;
    }
    return false;
  }

}
