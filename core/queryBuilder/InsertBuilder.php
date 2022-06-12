<?php
namespace Core\QueryBuilder;

use Core\QueryBuilder\Builder;

class InsertBuilder extends Builder
{
  public function __construct($pdo, $table)
  {
    $this->pdo = $pdo;
    $this->insert($table);
  }

  public function insert($table)
  {
    $this->query = "INSERT INTO $table";
    return $this;
  }

  public function fields($fields)
  {
    $fields_string = $this->string_from_array($fields);
    $this->query .= "($fields_string) ";
    return $this;
  }

  public function values($values)
  {
    $this->params = array_merge($this->params, $values);
    $values_prepare = trim(str_repeat('?, ', count($values)), ', ');
    $this->query .= "VALUES($values_prepare)";
    return $this;
  }

  public function execute()
  {
    $this->query;
    $prepare_query = $this->bind_params();
    $prepare_query->execute();
  }

  private function string_from_array($array)
  {
    $string = (is_array($array)) ? implode(',', $array) : $array;
    return $string;
  }



}
