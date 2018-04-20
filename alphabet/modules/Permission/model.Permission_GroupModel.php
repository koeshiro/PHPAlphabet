<?
namespace Permission;
/**
 * Permission Model
 */
class GroupModel extends \DataBase\Table {
  public $TableName="permissipn_group";
  public $TestStructure=true;
  public $Columns=array(
    'id'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No',
      'Extra'=>'AUTO_INCREMENT',
      'Key'=>'PRIMARY'
    ),
    'group_name'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'No'
    ),
    'group_code'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'No'
    ),
    'role_id'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No'
    )
  );
  public function GetUserGroups(int $ID) {
    $UserGroupConnector=new UserGroupConnectorModel();
    $UserGroups=$UserGroupConnector->GetList(array('user_index'=>$ID))->FetchAll(\PDO::FETCH_ASSOC);
    $arGruops=array();
    foreach ($UserGroups as $GroupConnect) {
      $arGruops[]=$this->GetByID($GroupConnect['group_id'])->Fetch(\PDO::FETCH_ASSOC);
    }
    return $arGruops;
  }
}
