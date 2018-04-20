<?
namespace URL;
require_once 'class.URL_Loader.php';
$URLEngine=new Engine();
\Alphabet\LocalStorage::SetURL($URLEngine);
Loader::SetURL($URLEngine);
