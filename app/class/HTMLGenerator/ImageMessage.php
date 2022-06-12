<?php
namespace App\Class\HtmlGenerator;

use App\Interfaces\IGenerator;
use App\Class\HtmlGenerator\MesssageGenerator;
use App\Class\Files\File;

class ImageMessage extends MessageGenerator
                      implements IGenerator
{
  public function generate($data = null)
  {
    $File = File::CreateFromParams($data['text']);
    $download_class = (isset($data['download_class'])) ? $data['download_class'] : null;
    $href = $data['text'];
    $src = $File->GetFolder() . "small/small" . $File->GetName();

    $html_doc =
    "<div class='image'>
      <a href='$href' target='_blank'>
        <img src='$src'>
      </a>
      <form class='download-form' method='post' action='ajax/download_file.php'>
        <input type='submit' class='download $download_class' value=''>
        <input type='text' class='path' name='path' value='$href' hidden>
      </form>
    </div>";

    $html_message = $this->message($data['time'],
                                   $data['message_id'],
                                   $data['sender_class'],
                                   $data['time_class'],
                                   $html_doc);

    return $html_message;
  }
}
