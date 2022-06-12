<?php
namespace Core;

use Core\Interfaces\IRouteCustomizer;
use Core\Route;

class RouteCustomizer implements IRouteCustomizer
{
  private $added_route;

  public function __construct($route)
  {
    $this->added_route = $route;
  }

  public function view($view)
  {
    if($view == null)
      throw new \Exception("Значение настройка маршрута равно NULL");
    Route::add_custom($this->added_route, 'view', $view);
    return $this;
    /*
    $route = $this->added_route;
    if($route != null)
    {
      Route::add_view($route, $view);
    }
    return $this;
    */
  }

  public function name($name)
  {
    Route::$route_names[$name] = $this->added_route;
    //Route::add_custom($this->added_route, 'name', $name);
    return $this;
  }

  public function redirect($where)
  {
    Route::add_custom($this->added_route, 'redirect', $where);

    /*$route = $this->added_route;
    if($route != null)
    {
      Route::add_redirect($route, $where);
    }*/
    //return $this;
  }

  public function title($title)
  {
    Route::add_custom($this->added_route, 'title', $title);
    return $this;
  }
}
