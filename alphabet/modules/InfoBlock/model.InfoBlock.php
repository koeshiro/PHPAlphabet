<?
namespace InfoBlock;
use \PDO;
/**
 * Class for work with database.
 */
class InfoBlock extends \DataBase\Table {
  public $TableName="info_blocks";
  public $TestStructure=true;
  public $Columns=array(
    'ID'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No',
      'Extra'=>'AUTO_INCREMENT',
      'Key'=>'PRIMARY'
    ),
    'NAME'=>array(
      'Type'=>'VARCHAR',
      'Length'=>500,
      'Null'=>'No',
    ),
    'CODE'=>array(
      'Type'=>'VARCHAR',
      'Length'=>100,
      'Null'=>'No'
    ),
  );
}
