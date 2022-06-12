<?php
use Core\Route;
use Core\View;
use Core\Request;

function route(string $name)
{
  //Route::get_custom('name', $name);
  return Route::$route_names[$name];
}

function view(string $template, $data = null)
{
  View::inc($template, $data);
}

function redirect(string $where)
{
  header("Location: $where");
  exit;
}

function getRequestParams($param_name)
{
  $req = new Request;
  return $req->$param_name;
}

function execute($action, ...$parameters)
{
  try{
    if(is_array($action))
    {
      $controller_name = 'App\Controllers\\' . $action[0];
      $controller = new $controller_name;
      $method = $action[1];
      return $controller->$method($parameters);
    }
    else
    {
      return $action($parameters);
    }
    return null;
  }
  catch(\Exception $e){
    echo "<br>" . "Exception: " . $e->getMessage() . "<br>";
  }
}

function session($session_name, $session_value = null)
{
  if($session_value === null)
  {
    if(isset($_SESSION[$session_name]))
      return $_SESSION[$session_name];
    else
      return null;
  }
  else if($session_value === '')
    unset($_SESSION[$session_name]);
  else
    $_SESSION[$session_name] = $session_value;
}

function cookie($cookie_name, $cookie_value = null)
{
  if($cookie_value === null)
  {
    if(isset($_COOKIE[$cookie_name]))
      return $_COOKIE[$cookie_name];
    else
      return null;
  }
  else if($cookie_value == '')
    unset($_COOKIE[$cookie_name]);
  else
    setcookie($cookie_name, $cookie_value, time() + 60 * 60 * 24 * 365);
}
