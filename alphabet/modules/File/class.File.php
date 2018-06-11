<?
namespace File;
/**
 * Module for use index files in directorys.
 */
class Engine {
  function __construct() {
    $RealDirPath=$this->getRealDirPath(RAW_URI);
    if(is_dir($RealDirPath) && $RealDirPath!=$_SERVER['DOCUMENT_ROOT'].'/'){
      //if url is path to real directory try require index.php or if we havent index return 404
      if(is_file($RealDirPath.'index.php')){
        require_once $RealDirPath.'index.php';
      } else {
        require_once $_SERVER['DOCUMENT_ROOT'].'/404.php';
      }
    } else if($RealDirPath==$_SERVER['DOCUMENT_ROOT'].'/' && CURENT_URI=='/') {
      require_once $RealDirPath.'index.php';
    } else {
      if(is_file($RealDirPath.'/404.php')){
        require_once $RealDirPath.'/404.php';
      } else {
        require_once $_SERVER['DOCUMENT_ROOT'].'/404.php';
      }
    }
  }
  /**
  * Function for get real directory from url
  */
  public function getRealDirPath($URL){
    $PathArray=explode('/',$URL); $RealDirPath=$_SERVER['DOCUMENT_ROOT'];
    foreach($PathArray as $index=>$value){
      if(is_dir($RealDirPath.'/'.$PathArray[$index])) $RealDirPath.='/'.$PathArray[$index];
      else break;
    }
    return str_replace('//','/',$RealDirPath);
  }
}
