<?
 class test {
   public function get($Params){
     $ibProperty=\InfoBlock\IBProperty::GetProperys();
     $ibElement=\InfoBlock\IBElement::GetElementByID(((int)$Params['parameter']));
     $View=new \MVC\View(array('ibProperty'=>$ibProperty,'ibElement'=>$ibElement),array());
     echo $View->includeView(__DIR__);
   }
 }
