<?
  require_once $_SERVER['DOCUMENT_ROOT'].'/alphabet/core/core.index.php';
  $MVCEngine = \MVC\Loader::GetMVC();
  $MVCEngine->
  addRout("\/rest\/(:class)[a-z]+\/(:method)[a-z]+(\/(:parameter)[a-zA-Z0-9]+\/){0,1}$",false,false)->
  endRouts();
