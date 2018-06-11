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
  public function DeleteUserFromGroups(int $ID){
    return $this->Connection->exec(
            SQLBuilder::Delete(
              array($this->TableName),
              array('user_index'=>$ID)
            )
          );
  }
  public function AddUserToGroups(int $UserID,array $IDs){
    foreach ($IDs as $ID) {
      $this->Add(
        array(
          'user_id'=>$UserIDa,
          'group_id'=>$ID
        )
      );
    }
    return true;
  }
}
