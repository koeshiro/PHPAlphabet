<?
namespace Entity;
/**
 * Test Data Classs
 */
class Test extends Entity {
  public static function TestByModel(array $Data, \DataBase\Table $Model) {
    $arSettings=$Model->Columns; /*$Warning=null;*/ $Lang=new \Lang\Includer(__FILE__);
    foreach ($arSettings as $strKey => $arColumn) {
      //not set required key
      if(
        strtoupper($arColumn['Null']) == 'NO' &&
        (
          empty($Data[$strKey]) ||
          $Data[$strKey] == ''
        )
      ) {//on error
        return \Entity\Error::CreateErrorArray(
                  $strKey,
                  $Lang->ExecuteMessageTemp(
                    $Lang->GetMessage('CriticalError_NotNull'),
                    array('Key'=>$strKey)
                  )
                );
      }
      //length limit
      if(strlen($Data[$strKey])<=$arColumn['Length']) {//on error
        return \Entity\Error::CreateErrorArray(
                  $strKey,
                  $Lang->ExecuteMessageTemp(
                    $Lang->GetMessage('CriticalError_LengthLimit'),
                    array('Key'=>$strKey)
                  )
                );
      }

    }
    return true;
  }
}
