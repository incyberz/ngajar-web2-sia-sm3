<?php
// ambil uri dari browser
$uri = $_SERVER['REQUEST_URI'];
if (strpos($uri, '?')) {
  $tmp = explode('?', $uri);
  $param = $tmp[1];
  if ($param) {

    $page_target = "$param.php";
    if (file_exists($page_target)) {
      include $page_target;
    } else {
      include 'na.php';
    }
  } else {
    include 'home.php';
  }
} else {
  include 'home.php';
}
