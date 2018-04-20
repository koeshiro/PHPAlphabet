<?
namespace Users;
/**
 * User Model
 */
class UserModel extends \DataBase\Table {
  public $TableName="users";
  public $TestStructure=true;
  public $Columns=array(
    'index'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No',
      'Extra'=>'AUTO_INCREMENT',
      'Key'=>'PRIMARY'
    ),
    'user_id'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No'
    ),
    'user_login'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'Yes'
    ),
    'user_name'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'Yes'
    ),
    'user_avatar'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'Yes'
    ),
    'user_status'=>array(
      'Type'=>'INT',
      'Length'=>2,
      'Default' => 1,
      'Null'=>'No'
    ),
    'user_reg_time'=>array(
      'Type'=>'DATETIME',
      'Null'=>'Yes'
    ),
    'user_last_enter'=>array(
      'Type'=>'DATETIME',
      'Null'=>'No',
      'DEFAULT'=>'NOW()'
    ),
    'user_access_token'=>array(
      'Type'=>'VARCHAR',
      'Length'=>200,
      'Null'=>'No'
    ),
    'user_email'=>array(
      'Type'=>'VARCHAR',
      'Length'=>150,
      'Null'=>'No'
    ),
    'user_password'=>array(
      'Type'=>'VARCHAR',
      'Length'=>300,
      'Null'=>'No'
    ),
    'user_login_type'=>array(
      'Type'=>'VARCHAR',
      'Length'=>10,
      'Null'=>'No'
    ),
  );
  public function GetByID(int $ID){
    return $this->Connection->query(
            \DataBase\SQLBuilder::Select(
              array(),
              array($this->TableName),
              array('`index`'=>$ID)
            )
          );
  }
  public function Update(int $ID,array $Data,bool $TestData=true){
    if($TestData==true){
      $mixedTestData=\Entity\Test::TestByModel($Data,$this);
      if(is_array($mixedTestData)) return $TestData;
    }
    $arClearData=$this->clearData($Data);
    return $this->Connection->query(
            SQLBuilder::Update(
              array($this->TableName),
              $arClearData,
              array('index'=>$ID)
            )
          );
  }
  public function Delete(int $ID){
    return $this->Connection->query(
            SQLBuilder::Delete(
              array($this->TableName),
              array('index'=>$ID)
            )
          );
  }
}
