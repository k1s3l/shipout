<?php
require_once 'check.php';
$source = 'shops.sql';
$file = fopen($source, 'r');
$file_read = fread($file, filesize($source));
$ArraySQL = explode(';', $file_read);

foreach($ArraySQL as $line)
{

  if(substr($line, 0, 2) == '--' || $line == ''){
    continue;
  }

  try {
    $import = $pdo->prepare($line);
    $import->execute();

  } catch (\Exception $e) {
    continue;
  }

}

class Dump {
  public $source;
  private $file = fopen($source, 'r');
  private $file_read = fread($file, filesize($source));
  private $ArraySQL = explode(';', $file_read);

}

?>
