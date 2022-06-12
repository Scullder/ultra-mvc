<?php
namespace Core\QueryBuilder;

use Core\QueryBuilder\Builder;

class SelectBuilder extends Builder
{
  public function __construct($pdo, $fields)
  {
    $this->pdo = $pdo;
    $this->select($fields);
  }

  public function select($fields)
  {
    $str = (is_array($fields)) ? implode(',', $fields) : $fields;
    $this->query = "SELECT $str ";
  }

  public function from($tables)
  {
    $str = (is_array($tables)) ? implode(',', $tables) : $tables;
    $this->query .= "FROM $str ";
    return $this;
  }

  public function where_in($field, $arr)
  {
    $str = trim(str_repeat('?, ', count($arr)), ', ');
    $this->query .= "WHERE $field IN($str) ";
    $this->params = array_merge($this->params, $arr);

    return $this;
  }

  public function where($field, $cond, $value)
  {
    array_push($this->params, $value);
    $this->query .= "WHERE $field $cond ? ";
    return $this;
  }

  public function and($field, $cond, $value)
  {
    array_push($this->params, $value);
    $this->query .= "AND $field $cond ? ";
    return $this;
  }

  public function execute($pdo_const = \PDO::FETCH_BOTH)
  {
    $prepare_query = $this->bind_params();
    $prepare_query->execute();
    $this->params = [];
    return $prepare_query->fetchAll($pdo_const);
  }




}
