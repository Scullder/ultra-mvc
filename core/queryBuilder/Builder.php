<?php
namespace Core\QueryBuilder;

abstract class Builder
{
  protected $pdo;
  protected $query;
  protected $params = [];

  abstract public function execute();

  protected function get_type($param)
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

  protected function bind_params()
  {
    $this->query = trim($this->query, ' ');
    $prepare_query = $this->pdo->prepare($this->query);
    $val_num = 1;
    foreach($this->params as $param)
    {
      $type = $this->get_type($param);
      $prepare_query->bindValue($val_num++, $param, $type);
    }
    return $prepare_query;
  }

}
