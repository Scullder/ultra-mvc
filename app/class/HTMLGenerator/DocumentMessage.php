<?php
namespace App\Class\HtmlGenerator;

use App\Interfaces\IGenerator;
use App\Class\HtmlGenerator\MesssageGenerator;

class DocumentMessage extends MessageGenerator
                      implements IGenerator
{
  public function generate($data = null)
  {
    $text = $data['text'];
    $html_doc =
    "<div class='document'>
      <div class='doc_name'><a href='$text'>Document!</a></div>

      <form class='download-form' method='post' action='ajax/download_file.php'>
        <input type='submit' class='download doc' value=''>
        <input type='text' class='path' name='path' value='$text' hidden>
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
