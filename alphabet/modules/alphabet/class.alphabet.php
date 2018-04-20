<?
namespace Alphabet;
/**
 * Alphabet - info buffer
 */
class LocalStorage {
  private static $Alphabet=array();

  public static function __callStatic($Name,array $Arguments){
    if(strpos($Name,'Set')===0){
      self::$Alphabet[str_replace_once('Set','',$Name)]=$Arguments[0];
    } else if(strpos($Name,'Get')===0) {
      return self::$Alphabet[str_replace_once('Get','',$Name)];
    } return true;
  }
}
