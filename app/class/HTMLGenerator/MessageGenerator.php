<?php
namespace App\Class\HtmlGenerator;

use App\Class\HtmlGenerator\DocumentMessage;
use App\Class\HtmlGenerator\VideosMessage;
use App\Class\HtmlGenerator\AudiosMessage;
use App\Class\HtmlGenerator\ImageMessage;
use App\Class\HtmlGenerator\TextMessage;

class MessageGenerator
{
  public function generate_message($category, $data)
  {
    if($category == 'document'){
      $generator = new DocumentMessage;
      return $generator->generate($data);
    }
    else if($category == 'image'){
      $generator = new ImageMessage;
      return $generator->generate($data);
    }
    else if($category == 'video'){
      $generator = new DocumentMessage;
      return $generator->generate($data);
    }
    else if($category == 'audio'){
      $generator = new DocumentMessage;
      return $generator->generate($data);
    }
    else if($category == 'text'){
      $generator = new TextMessage;
      return $generator->generate($data);
    }

  }

  protected function message($time, $message_id, $sender_class, $time_class, $inner_html = null)
  {
    $html =
    "<div class='message $sender_class'>
      " . $inner_html . "
      <div class='message-time $time_class'>
        $time
      </div>
      <input class='message-id' type='text' name='message-id' value='$message_id' hidden>
    </div>";

    return $html;
  }

}
