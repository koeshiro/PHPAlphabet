<?
namespace Permission;
/**
 * Permission Model
 */
class UserGroupConnectorModel extends \DataBase\Table {
  public $TableName="user_group_connector";
  public $TestStructure=true;
  public $Columns=array(
    'id'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No',
      'Extra'=>'AUTO_INCREMENT',
      'Key'=>'PRIMARY'
    ),
    'user_index'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No'
    ),
    'group_id'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No'
    ),
  );
  public function DeleteUserGroups(int $ID){
    return $this->Connection->exec(
            SQLBuilder::Delete(
              array($this->TableName),
              array('user_index'=>$ID)
            )
          );
  }
  public function AddUserGroups(int $UserID,array $IDs){
    foreach ($IDs as $ID) {
      $this->Add(
        array(
          'user_id'=>$UserID,
          'group_id'=>$ID
        )
      );
    }
    return true;
  }
}
