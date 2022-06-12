<?php
namespace App\Class\HtmlGenerator;

use App\Interfaces\IGenerator;
use App\Class\HtmlGenerator\MesssageGenerator;

class TextMessage extends MessageGenerator
                      implements IGenerator
{
  public function generate($data = null)
  {
    $text = $data['text'];
    $html_doc =
    "<div class='text'>
      <div class='message-text'>$text</div>
    </div>";

    $html_message = $this->message($data['time'],
                                   $data['message_id'],
                                   $data['sender_class'],
                                   $data['time_class'],
                                   $html_doc);

    return $html_message;
  }
}
