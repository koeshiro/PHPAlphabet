<?
namespace Event;
/**
 * EventEmiter
 */
class Emiter {
  private $Events=array();
  /**
  * Function for set listner
  * @param string $event - event name
  * @param mixed $function - function listner
  */
  public function on(string $event,$function){
    if(is_array($Events[$event])){
      $this->Events[$event][]=$function;
    } else {
      $this->Events[$event]=array($function);
    }
  }
  /**
  * Function for set listner
  * @param string $event - event name
  * @param array &$data - link to Data 
  */
  public function emit(string $event,array &$data=array()){
    if(is_array($this->Events[$event])&&count($this->Events[$event])>0){
      foreach($this->Events[$event] as $event){
        if($data!==false)$event();
        else $event($data);
      }
    }
  }
}
