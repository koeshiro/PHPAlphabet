<?
namespace Event;
/**
 * Loader of EventEmiter
 */
class Loader
{
  static $EventEmiter;
  static function SetEventEmiter(\Event\Emiter $Emiter){
    self::$EventEmiter=$Emiter;
  }
  static function GetEventEmiter(){
    return self::$EventEmiter;
  }
}
