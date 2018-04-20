<?
namespace InfoBlock;
use \PDO;
/**
 * InfoBlock class for work with propertys
 */
class IBProperty extends \DataBase\Table {
  public $TableName="properties";
  public $TestStructure=true;
  public $Columns=array(
    'id'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No',
      'Extra'=>'AUTO_INCREMENT',
      'Key'=>'PRIMARY'
    ),
    'section_id'=>array(
      'Type'=>'VARCHAR',
      'Length'=>11,
      'Null'=>'No',
    ),
    'name'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'No'
    ),
  );
  public function GetElementsByProperty(string $Name, string $Value){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->query(
            \DataBase\SQLBuilder::Select(
                array('el.*'),
                array(
                  array('elements'=>'el'),
                  array('propertie_values'=>'p_val'),
                  array('properties'=>'p')
                ),
                array(
                  array('p_val.element_id'=>'el.id'),
                  \DataBase\SQLBuilder::$WHERE_AND=>array('p.name'=>$Connection->quote($Name)),
                  \DataBase\SQLBuilder::$WHERE_AND=>array('p_val.value'=>$Connection->quote($Value))
                )
              )
          );
    if(is_object($Query)) return $Query->fetchAll(PDO::FETCH_ASSOC);
    else return $Query;
  }
  public function GetProperyByElementId(int $ID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->query(
            \DataBase\SQLBuilder::Select(
                array(
                  array('val.value'=>'value'),
                  array('name.name'=>'name')
                ),
                array(
                  array('propertie_values'=>'val'),
                  array('properties'=>'name')
                ),
                array(
                  array('val.element_id'=>$Connection->quote($ID)),
                  \DataBase\SQLBuilder::$WHERE_AND=>array('val.propertie_id'=>'name.id')
                )
              )
          );
    if(is_object($Query)) return $Query->fetchAll(PDO::FETCH_ASSOC);
    else return $Query;
  }
  public function GetProperys(){
    $Connection=\DataBase\Connector::GetConnection();
    return $Connection->query(
            \DataBase\SQLBuilder::Select(
              array(),
              array('properties'),
              array()
            )
           )->fetchAll(PDO::FETCH_ASSOC);
  }
  public function InsertPropertyByCode(int $ID,string $Name,string $Value){
    $Connection=\DataBase\Connector::GetConnection();
    return $Connection->exec('
      INSERT INTO  `propertie_values` (  `element_id` ,  `value` ,  `property_id` )
      SELECT  '.$Connection->quote($ID).',  '.$Connection->quote($Value).', id
      FROM  `properties`
      WHERE name =  '.$Connection->quote($Name).'
      AND section_id = (
        SELECT section_id
        FROM  `sections_elements`
        WHERE element_id =  '.$Connection->quote($ID).'
      );
    ');
  }
  public function InsertPropertyByID(int $ElementID,int $PropertyID,string $Value){
    $Connection=\DataBase\Connector::GetConnection();
    return $Connection->exec(
            \DataBase\SQLBuilder::Insert(
              array('propertie_values'),
              array(
                'element_id'  =>$Connection->quote($ElementID),
                'property_id' =>$Connection->quote($PropertyID),
                'value'       =>$Connection->quote($Value)
              )
            )
          );
  }
  public function UpdatePropertyByID(int $ElementID,int $PropertyID,string $Value){
    $Connection=\DataBase\Connector::GetConnection();
    return $Connection->exec(
            \DataBase\SQLBuilder::Update(
              array('propertie_values'),
              array(
                'property_id' =>$Connection->quote($PropertyID),
                'value'       =>$Connection->quote($Value)
              ),
             array(
                'element_id'  =>$Connection->quote($ElementID),
             )
            )
          );
  }
  public function UpdatePropertyByCode(int $ID,string $Name,string $Value){
    $Connection=\DataBase\Connector::GetConnection();
    return $Connection->exec(
            \DataBase\SQLBuilder::Update(
              array('propertie_values'),
              array(
                'value' =>$Connection->quote($Value)
              ),
             array(
                'element_id' =>
                  '('.\DataBase\SQLBuilder::Select(
                    array('id'),
                    array('properties'),
                    array(
                      array('name'=>$Connection->quote($Name)),
                      \DataBase\SQLBuilder::$WHERE_AND=>array('section_id'=>
                        '('.\DataBase\SQLBuilder::Select(
                          array('section_id'),
                          array('sections_elements'),
                          array('element_id'=>$Connection->quote($ID))
                        ).')'
                      )
                    )
                  ).')',
             )
            )
          );
  }
}
