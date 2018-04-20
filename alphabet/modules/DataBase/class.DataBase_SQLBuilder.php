<?
namespace DataBase;
use \PDO;
use \Exception;
/**
 * DataBase SQLBuilder
 */
class SQLBuilder {
  static $WHERE_GROUP = 'WHERE_GROUP';
  static $WHERE_AND   = 'WHERE_AND';
  static $WHERE_OR    = 'WHERE_OR';
  /**
  * Function for create select query string
  * @param array $Columns - Columns names list
  *                         Example: array('column',array('column2'=>'c2'))
  * @param array $Tables  - Table names list
  *                         Example: array('table',array('table2'=>'t2'))
  * @param array $Where   - Parameters for query
  *                         Example:
  *                         array(\DataBase\SQLBuilder::$WHERE_GROUP=>array(array('column1'=>'value'),\DataBase\SQLBuilder::$WHERE_AND=>array('t1.column2'=>'value')),\DataBase\SQLBuilder::$WHERE_OR=>array('t1.column3'=>'value'))
  * @return string
  */
  public static function Select(array $Columns,array $Tables, array $Where,array $Limit=array()){
    //array to selected columns
    $SQLSelectedColumns = self::arrayToSQLColumns($Columns);
    //array to selected tables
    $SQLSelectedTables  = self::arrayToSQLTables($Tables);
    //array to `where` parameters
    $SQLWhereParameters = self::arrayToSQLWhereParameters($Where);
    if(strlen($SQLWhereParameters)>0)$SQLWhereParameters=' WHERE '.$SQLWhereParameters;
    $SQLLimit=self::arrayToSQLLimit($Limit);
    return "SELECT $SQLSelectedColumns FROM $SQLSelectedTables $SQLWhereParameters $SQLLimit;";
  }
  /**
  * Function for create delete query string
  * @param array $Tables - Table names list
  *                        Example: array('table',array('table2'=>'t2'))
  * @param array $Where  - Parameters for query
  *                        Example:
  *                        array(\DataBase\SQLBuilder::$WHERE_GROUP=>array(array('column1'=>'value'),\DataBase\SQLBuilder::$WHERE_AND=>array('t1.column2'=>'value')),\DataBase\SQLBuilder::$WHERE_OR=>array('t1.column3'=>'value'))
  * @return string
  */
  public static function Delete(array $Tables, array $Where,array $Limit=array()){
    //array to selected tables
    $SQLSelectedTables  = self::arrayToSQLTables($Tables);
    //array to `where` parameters
    $SQLWhereParameters = self::arrayToSQLWhereParameters($Where);
    if(strlen($SQLWhereParameters)>0)$SQLWhereParameters=' WHERE '.$SQLWhereParameters;
    $SQLLimit=self::arrayToSQLLimit($Limit);
    return "DELETE FROM $SQLSelectedTables $SQLWhereParameters $SQLLimit;";
  }
  /**
  * Function for insert query string
  * @param array $Tables - Table names list
  *                        Example: array('table',array('table2'=>'t2'))
  * @param array $Data   - Data for insert in table
  *                        Example: array('column'=>'value')
  * @return string
  */
  public static function Insert(array $Tables, array $Data,array $Limit=array()){
    $SQL='INSERT INTO';
    //array to selected tables
    $SQLSelectedTables  = self::arrayToSQLTables($Tables);
    //array to inserting data
    $SQLInsertingData   = self::arrayToSQLData($Data);
    $SQLLimit=self::arrayToSQLLimit($Limit);
    return "$SQL $SQLSelectedTables SET $SQLInsertingData $SQLLimit;";
  }
  /**
  * Function for update query string
  * @param array $Tables - Table names list
  *                        Example: array('table',array('table2'=>'t2'))
  * @param array $Data   - Data for insert in table
  *                        Example: array('column'=>'value')
  * @param array $Where  - Parameters for query
  *                        Example:
  *                        array(\DataBase\SQLBuilder::$WHERE_GROUP=>array(array('column1'=>'value'),\DataBase\SQLBuilder::$WHERE_AND=>array('t1.column2'=>'value')),\DataBase\SQLBuilder::$WHERE_OR=>array('t1.column3'=>'value'))
  * @return string
  */
  public static function Update(array $Tables, array $Data, array $Where=array(),array $Limit=array()){
    $SQL='UPDATE';
    //array to selected tables
    $SQLSelectedTables  = self::arrayToSQLTables($Tables);
    //array to inserting data
    $SQLInsertingData   = self::arrayToSQLData($Data);
    //array to `where` parameters
    $SQLWhereParameters = self::arrayToSQLWhereParameters($Where);
    if(strlen($SQLWhereParameters)>0)$SQLWhereParameters=' WHERE '.$SQLWhereParameters;
    $SQLLimit=self::arrayToSQLLimit($Limit);
    return "$SQL $SQLSelectedTables SET $SQLInsertingData $SQLWhereParameters $SQLLimit;";
  }
  private static function arrayToSQLLimit(array $Limit=array()){
    if(count($Limit)>0){
      $SQLLimit='LIMIT '.$Limit[0];
      if($Limit[1]>0)$SQLLimit.=', '.$Limit[1];
    } else $SQLLimit='';
    return $SQLLimit;
  }
  //help functions
  /**
  * Function for build sql parameters for insert or update rows
  * @param array $Data   - Data for insert in table
  *                        Example: array('column'=>'value')
  * @return string
  */
  private static function arrayToSQLData(array $Data){
    $SQLData='';
    if(count($Data)>0){
      foreach ($Data as $key => $value) {
        $SQLData=' '.$key.'='.\DataBase\Connector::GetConnection()->quote($value).', ';
      }
    } else {
      throw new \Exception("Have not data for insert/update", 1);
    }
    return substr($SQLData,0,strlen($SQLData)-1);
  }

  /**
  * Function to build `where` parameters string from array
  * @param array $WhereParameters - Parameters for query
  *                                 Example:
  *                                 array(\DataBase\SQLBuilder::$WHERE_GROUP=>array(array('column1'=>'value'),\DataBase\SQLBuilder::$WHERE_AND=>array('t1.column2'=>'value')),\DataBase\SQLBuilder::$WHERE_OR=>array('t1.column3'=>'value'))
  * @return string
  */
  private static function arrayToSQLWhereParameters(array $WhereParameters){
    $SQLWhereParameters='';
    if(count($WhereParameters)>0){
      foreach($WhereParameters as $Mod => $Parameter){
        if($Mod===self::$WHERE_GROUP){                                                   //Group operators into array
          $SQLWhereParameters.=' ( '.self::arrayToSQLWhereParameters($Parameter).' ) ';
        } else if($Mod===self::$WHERE_OR){                                               //OR Operator
          $SQLWhereParameters.=' OR '.self::arrayToSQLWhereParameters($Parameter);
        } else if($Mod===self::$WHERE_AND){                                              //AND Operator
          $SQLWhereParameters.=' AND '.self::arrayToSQLWhereParameters($Parameter);
        } else {                                                                         //Parameters
          if(is_array($Parameter)) $SQLWhereParameters.=self::arrayToSQLWhereParameter($Parameter);
          else $SQLWhereParameters.=self::arrayToSQLWhereParameter($WhereParameters);
        }
      }
    }
    return $SQLWhereParameters;
  }
  /**
  * Function to build `where` parameter string from array
  * @param array $Parameter - Parameters for query
  *                                 Example:
  *                                         array('%=column'=>'value')
  *                                         array('<=column'=>'value')
  *                                         array('>=column'=>'value')
  *                                         array('=column'=>'value')
  *                                         array('column'=>'value')
  * @return string
  */
  private static function arrayToSQLWhereParameter(array $Parameter){
    foreach ($Parameter as $key => $value) {
      if(strpos($key,'%=')===0){                                                  //LIKE operator
        return ' '.$key.' LIKE '.$value.' ';
      } else if(strpos($key,'<=') === 0) {                                        //Less or equal
        return ' '.$key.' <= '.$value.' ';
      } else if(strpos($key,'>=') === 0) {                                        //Greater or equal
        return ' '.$key.' >= '.$value.' ';
      } else if(strpos($key,'=')  === 0) {                                        //Equal
        return ' '.$key.' = '.$value.' ';
      } else {                                                                    //Equal
        return ' '.$key.' = '.$value.' ';
      }
    }
  }
  /**
  * Function to build tables string from array
  * @param array $Tables - Table names list
  *                        Example: array('table',array('table2'=>'t2'))
  * @return string
  */
  private static function arrayToSQLTables(array $Tables){
    $SQLSelectedTables='';
    if(count($Tables)>0){
      foreach($Tables as $Table){
        if(is_array($Table)){
          foreach($Table as $TableName => $TableKey){
            $SQLSelectedTables.="$TableName as $TableKey, ";
          }
        } else {
          $SQLSelectedTables.="$Table, ";
        }
      }
    } else {
      throw new \Exception("Have not selected any tables", 1);
    }
    return substr($SQLSelectedTables,0,strlen($SQLSelectedTables)-2);
  }
  /**
  * Function to build Columns string from array
  * @param array $Columns - Table names list
  *                        Example: array('column',array('column2'=>'column2'))
  * @return string
  */
  private static function arrayToSQLColumns(array $Columns){
    $SQLSelectedColumns='';
    if(count($Columns)>0){
      foreach($Columns as $Column){
        if(is_array($Column)){
          foreach($Column as $ColumnName => $ColumnKey){
            $SQLSelectedColumns.="$ColumnName as $ColumnKey, ";
          }
        } else {
          $SQLSelectedColumns.="$Column, ";
        }
      }
    } else {
      $SQLSelectedColumns='*, ';
    }
    return substr($SQLSelectedColumns,0,strlen($SQLSelectedColumns)-2);
  }
}
