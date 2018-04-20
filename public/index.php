<?
require_once $_SERVER['DOCUMENT_ROOT'].'/system.php';
  //$Rewrite=new rewrite();
  echo RAW_URI,'][',$RealDirPath,'][',CURENT_URI.'<br/>';
  echo '<pre>';
  //echo print_r($GLOBALS['Rewrite']->getURLParams('/public/(:method)[a-zA-Z0-9]',\Alphabet\RAW_URI));
  echo '</pre>';
?>
