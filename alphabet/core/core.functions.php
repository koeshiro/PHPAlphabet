<?
function str_replace_once($search, $replace, $text){
   if(!empty($search))$pos = strpos($text, $search);
   else $pos=false;
   return $pos!==false ? substr_replace($text, $replace, $pos, strlen($search)) : $text;
}
