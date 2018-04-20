<?
namespace Alphabet;
  //Includ Core
  require_once $_SERVER['DOCUMENT_ROOT'].'/alphabet/core/core.functions.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/alphabet/core/core.vars.php';
  require_once $_SERVER['DOCUMENT_ROOT'].'/alphabet/core/core.class.php';
  //Initialize Code
  $Core=new Core();
  //register autoload
  spl_autoload_register(array($Core,'includByNameSpace'));
  //Initialize engines
  $EventEmiter  = \Event\Loader::GetEventEmiter();
  $URLEngine    = \URL\Loader::GetURL();
  $MVCEngine    = \MVC\Loader::GetMVC();//is using $EventEmiter
  $EventEmiter->on('MVCEngine-end_work_havent_result',function(){
    $FileEngine = \File\Loader::GetFile();
  });
