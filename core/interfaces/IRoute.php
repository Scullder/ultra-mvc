<?php
namespace Core\Interfaces;

interface IRoute
{
  public static function add($route, $action);
  public static function group($controller, $function);
  /*
  public static function add_view($route, $view);
  public static function add_name($route, $name);
  public static function add_redirect($route, $where);
  public static function get_name($name);
  */
  public static function add_custom($route, $custom_name, $custom_value);
  public static function get_custom($route, $custom_name);
  public static function call_action();
  public static function print();
}
