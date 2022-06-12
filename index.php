<?php
  session_start();
  require_once __DIR__ . '/vendor/autoload.php';
  Core\Route::call_action();
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title><?php echo Core\Route::get_title(); ?></title>
  </head>
  <body>
    <?php Core\Route::view_for_current_route() ?>
  </body>
</html>
