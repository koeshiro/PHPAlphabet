<?
namespace MVC;
//use \Alphabet\RAW_URI as RAW_URI;
require_once 'class.MVC_View.php';
require_once 'class.MVC_Loader.php';
$MVCEngine=new Engine(RAW_URI);
\Alphabet\LocalStorage::SetMVC($MVCEngine);
Loader::SetMVC($MVCEngine);
