<?
namespace File;
/**
 *
 */
class Loader
{
  static $FileEngine;
  static function SetFile(\File\Engine $File){
    self::$FileEngine=$File;
  }
  static function GetFile(){
    return self::$FileEngine;
  }
}
