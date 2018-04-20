<?
namespace DataBase;
/**
 * DataBase Table Object Presentation
 */
class Table extends Model {
  public function GetByID(int $ID){
    return $this->Connection->query(
            SQLBuilder::Select(
              array(),
              array($this->TableName),
              array('ID'=>$ID)
            )
          );
  }
  public function GetList(array $Filter=array()){
    return $this->Connection->query(
            SQLBuilder::Select(
              array(),
              array($this->TableName),
              $Filter
            )
          );
  }
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
  public function Delete(int $ID){
    return $this->Connection->exec(
            SQLBuilder::Delete(
              array($this->TableName),
              array('ID'=>$ID)
            )
          );
  }
  public function clearData(array $Data){
    foreach($Data as $Key => $Value){
      $Data[$Key]=$this->Connection->quote($Value);
    }
    return $Data;
  }
}
