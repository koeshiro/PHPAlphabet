<?
namespace User;
/**
 * Login table
 */
class Login extends \DataBase\Table {
  public $TableName="user_login";
  public $TestStructure=true;
  public $Columns=array(
    'ID'=>array(
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
    'user_hash'=>array(
      'Type'=>'VARCHAR',
      'Length'=>300,
      'Null'=>'No'
    ),
  );
}
