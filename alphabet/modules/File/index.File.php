<?
namespace File;
require_once 'class.File_Loader.php';
$FileEngine=new Engine();
\Alphabet\LocalStorage::SetFile($FileEngine);
Loader::SetFile($FileEngine);
