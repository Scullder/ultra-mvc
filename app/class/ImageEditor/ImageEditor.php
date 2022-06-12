<?php
namespace App\Class\ImageEditor;

use App\Class\Files\File;

class ImageEditor
{
  /**
  * Сжатие изображение
  *
  * @param File $file объект представляющий файл(изображение)
  * @param string $saving_dir куда сохранять
  * @param float $compression_coeff коефициент сжатия
  */
  
  public function compression(File $Image, $small_dir = null, $coeff = 0.6)
  {
    $ext = $Image->GetExtension();
    $Image_dir = $_SERVER['DOCUMENT_ROOT'] . $Image->GetDirectory();
    if($small_dir == null) $small_dir = $Image_dir;

    if($ext == 'jpeg' || $ext == 'jpg')
    {
      $create = 'imagecreatefromjpeg';
      $save = 'imagejpeg';
    }
    else if($ext == 'png')
    {
      $create = 'imagecreatefrompng';
      $save = 'imagejpeg';
    }
    else if($ext == 'gif') // !!!! не работатт !!!!
    {
      $create = 'imagecreatefromgif';
      $save = 'imagegif';
    }

    $original_image = $create($Image_dir);
    list($width, $height) = getimagesize($Image_dir);
    $new_width = $width * $coeff;
    $new_height = $height * $coeff;
    $small_image = imagecreatetruecolor($new_width, $new_height);
    imagecopyresized($small_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    if($save($small_image, $small_dir) === false)
    {
      throw new \Exception('Не удалось сохранить файл!');
    }
    else
    {
      imagedestroy($original_image);
      imagedestroy($small_image);

      return true;
    }
  }
}
