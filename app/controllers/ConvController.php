<?php
namespace App\Controllers;

use Core\Model;
use Core\Request;

class ConvController
{
  public function add_conversation()
  {
    $request = new Request;
    $model = new Model;

    $member_id = $request->id;

    $folder_name = time() . rand(1, 1000);
    $folder = "/resources/img/users_img/" . "$folder_name/";

    if (mkdir($folder, 0777, true))
    {
      /** @var string название беседы для этого пользователя */
      $this_conv_name = $model->query("SELECT login FROM users WHERE id = ?", $member_id);

      /** @var string название беседы для добовляемого участника */
      $member_conv_name = \session('user');

      $created = \date('d.m.y G:i:s');

      $model->query("INSERT INTO conversations(created, folder)
                     VALUES(?, ?)", $created, $folder);

      $con_id = $model->last_inserted;
      $user_id = \session('user_id');
      $model->query("INSERT INTO members(con_id, member_id, con_name) VALUES(?, ?, ?), (?, ?, ?)",
                     $con_id, $user_id, $this_conv_name,
                     $con_id, $member_id, $member_conv_name);
    }
    else
      throw new \Exception('Не удалось создать дерикторию для картинок!');

    \redirect('\main');
  }

}
