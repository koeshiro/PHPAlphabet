<?
namespace URL;
/**
 * URLEngine
 * Helper for work with url data and etc...
 */
class Engine {
  /**
  * Test check rout to the according url
  * $Rout string - link mask
  * $URL string - url
  */
  public function testURL(string $Rout,string $URL){
    $ClearRout=preg_replace("/\(\:[a-zA-Z0-9_]+\)/",'',$Rout);
    return preg_match("/$ClearRout/",$URL);
  }
  /**
  * Get Parametrs
  * $Rout string - link mask
  * $URL string - url
  */
  public function getURLParams(string $Rout,string $URL){
    if(preg_match("/\(\:[a-zA-Z0-9_]+\)/",$Rout)){
      $URLPathArray=explode('/',$URL); $RoutPathArray=explode('/',$Rout); $Result=array();
      foreach($RoutPathArray as $index=>$value){
        if(preg_match("/\(\:[a-zA-Z0-9_]+\)/",$value)){
          preg_match_all("/\(\:[a-zA-Z0-9_]+\)/",$value,$RoutValueName,PREG_SET_ORDER);
          $RoutValue=preg_replace("/\(\:[a-zA-Z0-9_]+\)/",'',$URLPathArray[$index]);
          $Result[str_replace( '(:','',str_replace(')','',$RoutValueName[0][0]) )]=$RoutValue;
        }
      } return $Result;
    } else return array();
  }

  public function Redirect(string $URL){
    header("Location: $URL");
  }
}
