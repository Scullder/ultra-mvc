<?php
namespace Core;

use Core\QueryBuilder\SelectBuilder;
use Core\QueryBuilder\InsertBuilder;

class Model
{
  // Connection
  private $db_host = '127.0.0.1';
  private $db_user = 'root';
  private $db_pass = '';
  private $db_name = 'social-net-test';
  private $pdo;
  public $last_inserted;

  public function __construct()
  {
    try{
      $this->pdo = new \PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_user, $this->db_pass);
    }
    catch(\PDOException $e){
      echo "Error!: " . $e->getMessage() . "<br>";
    }
  }

  public function insert($table)
  {
    return new InsertBuilder($this->pdo, $table);
  }

  public function select($fields)
  {
    return new SelectBuilder($this->pdo, $fields);
  }

  private function get_type($param)
  {
    if(is_int($param))
        $type = \PDO::PARAM_INT;
    elseif(is_bool($param))
        $type = \PDO::PARAM_BOOL;
    elseif(is_null($param))
        $type = \PDO::PARAM_NULL;
    elseif(is_string($param))
        $type = \PDO::PARAM_STR;
    return $type;
  }

  public function query($query, ...$values)
  {
    if($values == null)
    {
      $pdo_prepare = $this->pdo->prepare($query);
      $pdo_prepare->execute();
    }
    else
    {
      $pdo_prepare = $this->pdo->prepare($query);
      $val_num = 1;
      foreach($values as $value)
      {
        $type = $this->get_type($value);
        $pdo_prepare->bindValue($val_num++, $value, $type);
      }
      $pdo_prepare->execute();
    }
    $this->last_inserted = $this->pdo->lastInsertId();

    if($pdo_prepare->rowCount() == 1 && $pdo_prepare->columnCount() == 1)
    {
      return $pdo_prepare->fetch()[0];
    }

    return $pdo_prepare->fetchAll(\PDO::FETCH_ASSOC);
  }

  private function fetch_assoc($pdo_const)
  {
    return $pdo_prepare->fetchAll(\PDO::FETCH_BOTH);
  }



}
