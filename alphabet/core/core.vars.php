<?
namespace Alphabet;
  define('RAW_URI'       , $_SERVER["REQUEST_URI"],false);
  define('DOCUMENT_ROOT' , str_replace('/','\\',$_SERVER['DOCUMENT_ROOT']),false);
  define('CURENT_DIR'    , str_replace_once($_SERVER['DOCUMENT_ROOT'],'',dirname($_SERVER['SCRIPT_FILENAME'])),false);
  define('CURENT_URI'    , str_replace_once(CURENT_DIR,'',RAW_URI),false);
  define('ALPHABET_DIR'  , $_SERVER['DOCUMENT_ROOT'].'/alphabet',false);
  define('MODULES_DIR'   , ALPHABET_DIR.'/modules',false);
