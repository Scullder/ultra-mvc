<?php
namespace App\Class;

use Core\Model;

class UserBasic
{
  public function __construct(private string $login, private string $password, private bool $admin = false)
  {
    $this->password = hash('md5', $password);
    //$this->login = mysqli_real_escape_string($login);
  }

  public function registrate($admin = false)
  {
    $model = new Model;
    if($admin == false)
      $model->query("INSERT INTO users(login, password) VALUES(?, ?)", $this->login, $this->password);
    else
      $model->query("INSERT INTO users(login, password, admin) VALUES(?, ?, 1)", $this->login, $this->password);
  }

  public function login($cookie = false)
  {
    $check_pass = $this->check_password();
    if($check_pass == true)
    {
      \session('user', $this->login);
      if($cookie !== false)
        \cookie('user', $this->login);
    }
  }

  public static function logout()
  {
    \session('user', '');
    \cookie('user', '');
  }

  public function isset()
  {
    $model = new Model;
    $count = $model->query("SELECT COUNT(*) FROM users WHERE login = ?", $this->login);
    if($count == 1)
      return true;
    else
      return false;
  }

  public function check_password()
  {
    $model = new Model;
    $check_pass = $model->query("SELECT COUNT(*) FROM users WHERE password = ? AND login = ?", $this->password, $this->login);
    if($check_pass == 1)
      return true;
    else
      return false;
  }

  public function check_admin()
  {
    $model = new Model;
    $admin = $model->query("SELECT admin FROM users WHERE login = ?", $this->login);
    return true;
  }
}
