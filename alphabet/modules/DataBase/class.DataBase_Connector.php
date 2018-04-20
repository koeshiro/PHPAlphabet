<?
namespace DataBase;
/**
 * Connector for work get and use Data Base
 */
class Connector {
  static $PDOConnect;
  static public function GetConnection(){
    return self::$PDOConnect;
  }
  public static function SetConnection(string $ConnectionString,string $ConnectionUser='',string $ConnectionUserPassword=''){
    try {
      self::$PDOConnect=new db($ConnectionString,$ConnectionUser,$ConnectionUserPassword);
      self::$PDOConnect->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
      return true;
    } catch (PDOException $e){
      return $e;
    }
  }
}
