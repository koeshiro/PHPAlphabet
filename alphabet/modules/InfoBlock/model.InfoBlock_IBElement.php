<?
namespace InfoBlock;
use \PDO;
use \integer;
/**
 * IBElement class for work with Elements
 */
class IBElement extends \DataBase\Table {
  public $TableName="elements";
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
      'Length'=>1000,
      'Null'=>'YES'
    ),
    'TEXT'=>array(
      'Type'=>'mediumtext',
      'Null'=>'YES'
    ),
    'CODE'=>array(
      'Type'=>'VARCHAR',
      'Length'=>250,
      'Null'=>'No'
    ),
    'SORT'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No'
    ),
    'ACTIVE'=>array(
      'Type'=>'VARCHAR',
      'Length'=>1,
      'Null'=>'No'
    ),
    'FILE_ID'=>array(
      'Type'=>'INT',
      'Length'=>11,
      'Null'=>'No'
    ),
    'CREATE_TIME'=>array(
      'Type'=>'timestamp',
      'Null'=>'No',
      'Default'=>'CURRENT_TIMESTAMP'
    )
  );
  /**
  * Function for get elements by info block id, or section id
  * @param mixed $IBLOCK_ID - numeric or false. Info block id or false if we use sections
  * @param mixed $SECTION_ID - numeric or false. Section id or false if we use info block
  * @return mixed - boolean or array
  */
  public function GetElementsList($IBLOCK_ID=false,$SECTION_ID=false){
    if($SECTION_ID!==false && is_numeric($SECTION_ID))
      return self::GetElementsListBySectionID($SECTION_ID);
    else if($IBLOCK_ID!==false && is_numeric($IBLOCK_ID))
      return self::GetElementsListByInfoBlockID($IBLOCK_ID);
    else return false;
  }
  /**
  * Function for get elements by info block id, or section id
  * @param mixed $IBLOCK_ID - numeric or false. Info block id or false if we use sections
  * @return mixed - boolean or array
  */
  public function GetElementsListByInfoBlockID($IBLOCK_ID=false){
    if($IBLOCK_ID!==false && is_numeric($IBLOCK_ID)){
      $Connection=\DataBase\Connector::GetConnection();
      $Query=$Connection->query(
              \DataBase\SQLBuilder::Select(
                  array('el.*','ib_ec.section_id'),
                  array(
                    array('elements'=>'el'),
                    array('info_blocks_elements_communication'=>'ib_ec')
                  ),
                  array(
                    array('ib_ec.INFO_BLOCK_ID'=>$Connection->quote($IBLOCK_ID)),
                    \DataBase\SQLBuilder::$WHERE_AND=>array('el.id'=>'ib_e.element_id')
                  )
                )
            );
      if(is_object($Query)) return $Query->fetchAll(PDO::FETCH_ASSOC);
      else return $Query;
    } else return false;
  }
  /**
  * Function for get elements by info block id, or section id
  * @param mixed $SECTION_ID - numeric or false. Section id or false if we use info block
  * @return mixed - boolean or array
  */
  public function GetElementsListBySectionID($SECTION_ID=false){
    if($SECTION_ID!==false && is_numeric($SECTION_ID)){
      $Connection=\DataBase\Connector::GetConnection();
      $Query=$Connection->query(
              \DataBase\SQLBuilder::Select(
                  array('el.*','s_e.section_id'),
                  array(
                    array('elements'=>'el'),
                    array('sections_elements'=>'s_e')
                  ),
                  array(
                    array('s_e.section_id'=>$Connection->quote($SECTION_ID)),
                    \DataBase\SQLBuilder::$WHERE_AND=>array(
                      'el.id'=>'s_e.element_id'
                    )
                  )
                )
             );
      if(is_object($Query)) return $Query->fetchAll(PDO::FETCH_ASSOC);
      else return $Query;
    } else return false;
  }
  /**
  * Function for get Element By is ID
  * @param int $ID - ID of element
  * @return mixed - boolean or array
  */
  public function GetElementByID(int $ID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->query(
            \DataBase\SQLBuilder::Select(
                array(),
                array('elements'),
                array(
                  'id'=>$Connection->quote($ID)
                )
              )
            );
    if(is_object($Query)) return $Query->fetch(PDO::FETCH_ASSOC);
    else return $Query;
  }
  /**
  * Function to retrieve sections connected to item
  * @param int $ID - element ID
  * @return mixed - boolean or array
  */
  public function GetSectionsByElementId(int $ID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->query(
            \DataBase\SQLBuilder::Select(
                array('s.*'),
                array(
                  array('sections_elements'=>'s_e'),
                  array('sections'=>'s')
                ),
                array(
                  's_e.element_id'=>$Connection->quote($ID),
                  \DataBase\SQLBuilder::$WHERE_AND=>array('s.id'=>'section_id')
                )
              )
            );
    if(is_object($Query)) return $Query->fetch(PDO::FETCH_ASSOC);
    else return $Query;
  }
  /**
  * Function to retrieve info block connected to item
  * @param int $ID - element ID
  * @return mixed - boolean or array
  */
  public function GetInfoBlockByElementId(int $ID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->query(
            \DataBase\SQLBuilder::Select(
                array('ib.*'),
                array(
                  array('info_blocks_elements_communication'=>'ib_e'),
                  array('info_blocks'=>'s')
                ),
                array(
                  'ib_e.ELEMENT_ID'=>$Connection->quote($ID),
                  \DataBase\SQLBuilder::$WHERE_AND=>array('ib.ID'=>'ib_e.INFO_BLOCK_ID')
                )
              )
            );
    if(is_object($Query)) return $Query->fetch(PDO::FETCH_ASSOC);
    else return $Query;
  }
  /**
  * Function for insert  Element
  * @param array $DATA - Element Data
  *                      (string)Name - Name of element
  *                      (string)CODE - CODE of element
  *                      (int)SORT - SORT of element
  *                      (int)FILE_ID - FILE_ID of element
  *                      (char)ACTIVE - ACTIVE (Y/N) of element
  * @return int
  */
  public function InsertElement(array $DATA){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->query(
            \DataBase\SQLBuilder::Insert(
                array('elements'),
                array(
                  'NAME'=>$Connection->quote($DATA['NAME']),
                  'CODE'=>$Connection->quote($DATA['CODE']),
                  'SORT'=>$Connection->quote($DATA['SORT']),
                  'FILE_ID'=>$Connection->quote($DATA['FILE_ID']),
                  'ACTIVE'=>$Connection->quote($DATA['ACTIVE'])
                )
              )
            );
    return $Query;
  }
  /**
  * Function for update  Element
  * @param array $DATA - Element Data
  *                      (int)ID - ID of element
  *                      (string)Name - Name of element
  *                      (string)CODE - CODE of element
  *                      (int)SORT - SORT of element
  *                      (int)FILE_ID - FILE_ID of element
  *                      (char)ACTIVE - ACTIVE (Y/N) of element
  * @return int
  */
  public function UpdateElement(array $DATA){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->exec(
            \DataBase\SQLBuilder::Update(
                array('elements'),
                array(
                  'NAME'=>$Connection->quote($DATA['NAME']),
                  'CODE'=>$Connection->quote($DATA['CODE']),
                  'SORT'=>$Connection->quote($DATA['SORT']),
                  'FILE_ID'=>$Connection->quote($DATA['FILE_ID']),
                  'ACTIVE'=>$Connection->quote($DATA['ACTIVE'])
                ),
                array(
                  'ID'=>$Connection->quote($DATA['ID'])
                )
              )
            );
    return $Query;
  }
  /**
  * Function for add parent section for element
  * @param int $ElementID - Element ID
  * @param int $SectionID - Section ID
  * @return int
  */
  public function addParentSection(int $ElementID,int $SectionID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->exec(
            \DataBase\SQLBuilder::Inser(
                array('sections_elements'),
                array(
                  'section_id'=>$Connection->quote($SectionID),
                  'element_id'=>$Connection->quote($ElementID)
                )
              )
            );
    return $Query;
  }
  /**
  * Function for add parent info block for element
  * @param int $ElementID - Element ID
  * @param int $InfoBlockID - Info Block ID
  * @return int
  */
  public function addParentInfoBlock(int $ElementID, int $InfoBlockID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->exec(
            \DataBase\SQLBuilder::Inser(
                array('info_blocks_elements_communication'),
                array(
                  'INFO_BLOCK_ID'=>$Connection->quote($SectionID),
                  'ELEMENT_ID'=>$Connection->quote($ElementID)
                )
              )
            );
    return $Query;
  }
  /**
  * Function for delete all parent info blocks
  * @param int $ElementID - Element ID
  * @return int
  */
  public function deleteParentInfoBlocks(int $ElementID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->exec(
            \DataBase\SQLBuilder::Delete(
                array('info_blocks_elements_communication'),
                array(
                  'ELEMENT_ID'=>$Connection->quote($ElementID)
                )
              )
            );
    return $Query;
  }
  /**
  * Function for delete all parent sections
  * @param int $ElementID - Element ID
  * @return int
  */
  public function deleteParentSections(int $ElementID){
    $Connection=\DataBase\Connector::GetConnection();
    $Query=$Connection->exec(
            \DataBase\SQLBuilder::Delete(
                array('sections_elements'),
                array(
                  'ELEMENT_ID'=>$Connection->quote($ElementID)
                )
              )
            );
    return $Query;
  }
}
