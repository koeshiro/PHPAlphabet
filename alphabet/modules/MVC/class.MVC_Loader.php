<?
namespace MVC;
/**
 *
 */
class Loader
{
  static $MVCEngine;
  static function SetMVC(\MVC\Engine $MVC){
    self::$MVCEngine=$MVC;
  }
  static function GetMVC(){
    return self::$MVCEngine;
  }
}
