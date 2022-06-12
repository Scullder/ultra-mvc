<?php
namespace App\Class\Files;

class File
{
  /** @var string file directory relatively domain */
  private $directory;
  /** @var string file name with .ext */
  private $name;
  /** @var string file directory without file name */
  private $folder;

  private $size;
  private $type = null;
  private $extension;

  private function __construct($directory, $name = null, $size = null, $type = null)
  {
    $domain_path = substr(strchr($directory, $_SERVER['HTTP_HOST']), strlen($_SERVER['HTTP_HOST']));
    $this->directory = ($domain_path == '') ? $directory : $domain_path;

    $this->name = ($name == null) ? $this->NameFromDirectory($this->directory) : $name;
    //$this->size = ($size == null) ? filesize($directory) : $size;
    $this->type = $type;
    $this->extension = strtolower(substr(strchr($this->name, '.'), 1));
    $this->folder = $this->FolderFromDirectory($directory);

  }

  private function NameFromDirectory($dir)
  {
    if(strrchr($dir, '/') != '')
      $name = substr(strrchr($dir, '/'), 1);
    else
      $name = substr(strrchr($dir, '\\'), 1);

    return $name;
  }

  private function FolderFromDirectory($dir)
  {
    if(strrchr($dir, '/') != '')
      $folder = str_replace(substr(strrchr($dir, '/'), 1), '', $dir);
    else
      $folder = str_replace(substr(strrchr($dir, '\\'), 1), '', $dir);

    return $folder;
  }

  static public function CreateFromArray(array $file_options)
  {
    return new File($file_options['tmp_name'], $file_options['name'], $file_options['size'], $file_options['type']);
  }

  static public function CreateFromParams($directory, $name = null, $size = null, $type = null)
  {
    return new File($directory, $name, $size, $type);
  }

  public function move($new_directory)
  {
    $res = rename($this->directory, $new_directory);
    if(!$res)
      throw new \Exception('Exception: can\'t move file to new directory.');
    else
      return new File($new_directory);
  }

  public function GenerateNewName()
  {
    return time() . rand(0, 1000) . "." . $this->extension;
  }

  public function GetExt()
  {
    return $this->extension;
  }

  public function GetName()
  {
    return $this->name;
  }

  public function GetFolder()
  {
    return $this->folder;
  }

  public function GetDirectory()
  {
    return $this->directory;
  }

  public function GetExtension()
  {
    return $this->extension;
  }

  public function dump()
  {
    echo "<pre>";
    var_dump(get_object_vars($this));
  }

}
