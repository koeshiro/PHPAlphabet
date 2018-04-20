<?
namespace Event;
/**
 * EventEmiter
 */
class Emiter {
  private $Events=array();
  public function on(string $event,$function){
    if(is_array($Events[$event])){
      $this->Events[$event][]=$function;
    } else {
      $this->Events[$event]=array($function);
    }
  }
  public function emit(string $event,array $data=array()){
    if(is_array($this->Events[$event])&&count($this->Events[$event])>0){
      foreach($this->Events[$event] as $event){
        if($data!==false)$event();
        else $event($data);
      }
    }
  }
}
