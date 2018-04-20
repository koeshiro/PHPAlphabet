<?
namespace MVC;
/**
* MVCEngine
*/
class Engine extends \URL\Engine {
  private $Routs=array();
  private $RAW_URL='';
  /**
  * Function __constructor register URL request
  * @param string $URL
  * @return \MVC\Engine $this
  */
  function __construct(string $URL){
    $this->RAW_URL=$URL;
    return $this;
  }
  /**
  * Add new rout
  * @param string $Rout - rout link. RegExp with variables \/rest\/(:class)[a-z]+\/(:method)[a-z]+(\/(:parameter)[a-zA-Z0-9]+){0,1}\/$
  *                       if (:method) exists using method of object by $Function param.
  *                       if (:class) and (:method) exists using method of class by this variables
  *                       if (:namespase) and (:class) and (:method) exists using method of class of namespase by this variables
  * @param mixed $Function - callable object. String or function for call function.
  * @param bool  $cleaningRout - if is using cleaning Rout. Replace '/' to '\/'
  */
  public function addRout(string $Rout,$Function=false,$cleaningRout=false){
    if($cleaningRout==true) $ClearRout=str_replace('/','\/',$Rout);
    else $ClearRout=$Rout;
    if($Function!=false)$this->Routs[]=array('Rout'=>$Rout,'Function'=>$Function);
    else $this->Routs[]=array('Rout'=>$Rout,'Function'=>'');
    return $this;
  }
  /**
  * End addeding Routs. If not match is fount emit event "MVCEngine-end_work_havent_result"
  * @event MVCEngine-end_work_havent_result
  * @return \MVC\Engine - $this
  */
  public function endRouts(){
    $EventEmiter = \Alphabet\LocalStorage::GetEventEmiter();
    if($this->useRouts()){
      $EventEmiter->emit('MVCEngine-end_work_havent_result');
    } return $this;
  }
  /**
  * Call Rout
  * @param array $Rout
  * @param array $Params
  * @return boolean
  */
  private function callRout(array $Rout,array $Params){
    //for functions
    if(is_callable($Rout['Function'])){
      $Rout['Function']($Params);
      return false;
    //call method of class
    } else if(
      array_key_exists("method",$Params)&&
      gettype($Rout['Function'])=='object'
    ) {
      call_user_func(array($Rout['Function'],$Params['method']),$Params);
      return false;
    //call loaded Controller
    } else if(
      array_key_exists("class",$Params)&&
      array_key_exists("method",$Params)&&
      $this->loadController($Params['class'])
    ) {
      //create and call loaded class
      if(
        class_exists($Params['class'])&&
        method_exists($Params['class'],$Params['method'])
      ){
        //create class object
        $class=new $Params['class']($Params);
        call_user_func(array($class,$Params['method']),$Params);
        return false;
      }
    } else return true;
  }
  /**
  * Function for iterates though ogf arrayListRouts
  * @return boolean if true routs not founded
  */
  private function useRouts(){
    foreach ($this->Routs as $Rout) {
      //test url for math(regexp)
      if($this->testURL($Rout['Rout'],$this->RAW_URL)){
        //get params from url
        return $this->callRout($Rout,$this->getURLParams($Rout['Rout'],$this->RAW_URL));
      }
    } return true;
  }
  /**
  * Functions for load MVC Controller
  * @param string $Name
  * @return boolean
  */
  public function loadController(string $Name){
    $IncludingFiles=array('include','model','class'); $isIncluded=false;
    if(is_dir(MVC_DIR.'/'.$Name)){
      foreach ($IncludingFiles as $FileName) {
        if(is_file(MVC_DIR.'/'.$Name.'/'.$FileName.'.'.$Name.'.php')) {
          require_once MVC_DIR.'/'.$Name.'/'.$FileName.'.'.$Name.'.php';
          $isIncluded = true;
        }
      }
      return $isIncluded;
    } return false;
  }
}
