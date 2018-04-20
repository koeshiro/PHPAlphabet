<?
namespace Permission;
/**
 * Permission Model
 */
class RoleModel extends \DataBase\Table {
  public $TableName="permissipn_role";
  public $TestStructure=true;
  public $Columns=array(
    'id'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No',
      'Extra'=>'AUTO_INCREMENT',
      'Key'=>'PRIMARY'
    ),
    'role_name'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'No'
    ),
    'role_code'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'No'
    ),
    'role_perrmission'=>array(
      'Type'=>'INT',
      'Length'=>10,
      'Null'=>'No'
    )
  );

}
