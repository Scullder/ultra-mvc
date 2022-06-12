<?php
namespace Core\QueryBuilder;

use Core\QueryBuilder\SelectBuilder;

class UpdateBuilder extends SelectBuilder
{
  public function __construct($pdo, $fields)
  {
    $this->pdo = $pdo;
    $this->select($fields);
  }
}
