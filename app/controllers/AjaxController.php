<?php
namespace App\Controllers;

use Core\Model;
use Core\Request;

class AjaxController
{
  public function test()
  {
    return json_encode(["key1" => 1, "key2" => 2, "key3" => 3]);
  }
}
