<?php
namespace Core;

class View
{
  private static $template_data_connects = array();

  public static function inc($template, $data = null)
  {
    // В $data не должно быть ключа 'template' из-за экстракта данных
    // В дочерний для этого шаблона данные передавать явно
    if(is_array($data)){
      extract($data, EXTR_OVERWRITE);
      unset($data);
    }
    include $_SERVER['DOCUMENT_ROOT'] . "/resources/views/" . $template . ".php";
  }

}
