<?
namespace URL;
/**
 * Load URL Engine
 */
class Loader
{
  static $URLEngine;
  static function SetURL(\URL\Engine $URL){
    self::$URLEngine=$URL;
  }
  static function GetURL(){
    return self::$URLEngine;
  }
}
