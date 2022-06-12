<?php
namespace Core\Interfaces;

interface IRouteCustomizer
{
  public function name($route);
  public function view($view);
  public function redirect($where);
}
