<?php
namespace Core;

use Core\RouteCustomizer;
use Core\Request;
use Core\Interfaces\IRoute;

class Route implements IRoute
{
  private static $group_controller = null;
  private static $routes = array();
  private static $current_route_data;
  public static $route_names = array();

  public static function add($route, $action = null)
  {
    // признак того что add выполняется внутри метода group
    $group_controller = self::$group_controller;
    if($group_controller == null)
    {
      // добавление вне группы
      self::$routes[$route] = ['action' => $action];
    }
    else
    {
      // если есть group_controller то add выполняется в group
      self::$routes[$route] = ['action' => [$group_controller, $action]];
    }
    return new RouteCustomizer($route);
  }

  public static function pr($route)
  {
    var_dump(self::$routes[$route]);
  }

  public static function group($controller, $function)
  {
    // групировка по контроллеру
    self::$group_controller = $controller;
    $function();
    self::$group_controller = null;
  }

  public static function add_custom($route, $custom_name, $custom_value)
  {
    self::$routes[$route] = array_merge(self::$routes[$route], [$custom_name => $custom_value]);
  }

  public static function get_custom($route, $custom_name)
  {
    if(array_key_exists($route, self::$routes) && array_key_exists($custom_name, self::$routes[$route]))
      return self::$routes[$route][$custom_name];
  }

  public static function call_action()
  {
    //$request = new Request;
    $current_route = Request::get_uri();
    $action = self::$routes[$current_route]['action'];

    // выполнение действия полученого по текущему маршруту,
    // и получение данных от этого действие или NULL
    $data = null;
    if($action !== null)
      $data = \execute($action);
    self::$current_route_data = $data;

    $redirect = self::get_custom($current_route, 'redirect');
    if($redirect != null)
    {
      \redirect($redirect);
    }
    return $data;
  }

  public static function view_for_current_route()
  {
    $current_route = Request::get_uri();

    $view = self::get_custom($current_route, 'view');
    if($view != null)
    {
      \view($view, self::$current_route_data);
    }
  }


  public static function get_title()
  {
    $request = new Request;
    return self::get_custom($request->get_uri(), 'title');
  }

  public static function print()
  {
    print_r(self::$actions);
    echo "<br>";
    print_r(self::$views);
  }

}
