<?
namespace DataBase;
/**
 * DataBase Table Object Presentation
 */
class Table extends Model {
  /**
  * Function for Get Row by ID
  * @param int $ID
  * @return \PDOStatement
  */
  public function GetByID(int $ID){
    return $this->Connection->query(
            SQLBuilder::Select(
              array(),
              array($this->TableName),
              array('ID'=>$ID)
            )
          );
  }
  /**
  * Function for Get List rows
  * @param array $Filter - Parameters for query
  *                                 Example:
  *                                         array('%=column'=>'value')
  *                                         array('<=column'=>'value')
  *                                         array('>=column'=>'value')
  *                                         array('=column'=>'value')
  *                                         array('column'=>'value')
  *                                         array('IN column'=>array)
  *                                         array('notIN column'=>array)
  * @param array $Columns - Table names list
  *                        Example: array('column',array('column2'=>'column2'))
  * @return \PDOStatement
  */
  public function GetList(array $Filter=array(),array $Columns=array()){
    return $this->Connection->query(
            SQLBuilder::Select(
              $Columns,
              array($this->TableName),
              $Filter
            )
          );
  }
  /**
  * Function for add row by ID
  * @param array $Data - Data for insert in table
  *                      Example: array('column'=>'value')
  * @return \PDOStatement
  */
  public function Add(array $Data){
    $mixedTestData=\Entity\Test::TestByModel($Data,$this);
    if(is_array($mixedTestData)) return $TestData;
    else {
      $arClearData=$this->clearData($Data);
      return $this->Connection->exec(
                SQLBuilder::Insert(
                  array($this->TableName),
                  $arClearData
                )
              );
    }
  }
  /**
  * Function for update row by ID
  * @param int $ID
  * @param array $Data - Data for insert in table
  *                      Example: array('column'=>'value')
  * @param bool $TestData - if true test data from $Data field test by \Entity\Test::TestByModel
  * @return \PDOStatement
  */
  public function Update(int $ID,array $Data,bool $TestData=true){
    if($TestData==true){
      $mixedTestData=\Entity\Test::TestByModel($Data,$this);
      if(is_array($mixedTestData)) return $TestData;
    }
    $arClearData=$this->clearData($Data);
    return $this->Connection->exec(
            SQLBuilder::Update(
              array($this->TableName),
              $arClearData,
              array('ID'=>$ID)
            )
          );
  }
  /**
  * Function for update row by array Filter
  * @param array $Where  - Parameters for query
  *                        Example:
  *                        array(
  *                               \DataBase\SQLBuilder::$WHERE_GROUP=>
  *                                                                    array(
  *                                                                          array('column1'=>'value'),
  *                                                                          \DataBase\SQLBuilder::$WHERE_AND=>array('t1.column2'=>'value')
  *                                                                    ),
  *                                \DataBase\SQLBuilder::$WHERE_OR=>array('t1.column3'=>'value')
  *                        )
  * @param array $Data - Data for insert in table
  *                      Example: array('column'=>'value')
  * @param bool $TestData - if true test data from $Data field test by \Entity\Test::TestByModel
  * @return \PDOStatement
  */
  public function Update(array $Filter=array(),array $Data,bool $TestData=true){
    if($TestData==true){
      $mixedTestData=\Entity\Test::TestByModel($Data,$this);
      if(is_array($mixedTestData)) return $TestData;
    }
    $arClearData=$this->clearData($Data);
    return $this->Connection->exec(
            SQLBuilder::Update(
              array($this->TableName),
              $arClearData,
              $Filter
            )
          );
  }
  /**
  * Function for delete row by ID
  * @param int $ID
  * @return \PDOStatement
  */
  public function Delete(int $ID){
    return $this->Connection->exec(
            SQLBuilder::Delete(
              array($this->TableName),
              array('ID'=>$ID)
            )
          );
  }
  /**
  * Function clear (quote) data array
  * @param array $Data - Data for insert in table
  *                      Example: array('column'=>'value')
  * @return array
  */
  public function clearData(array $Data){
    $arData=array();
    foreach($Data as $Key => $Value){
      $arData[$Key]=$this->Connection->quote($Value);
    }
    return $arData;
  }
}
