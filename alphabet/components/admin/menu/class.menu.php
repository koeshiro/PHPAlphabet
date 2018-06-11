<?
namespace Components;
/**
 * Class of Menu Component for get Menu Data
 */
class Menu {
  /**
  * constructor
  * @param string $Name default 'default' - Name of Menu. Not required
  * @param string $Dir default '' - Alternative Directory of menu. Not required
  * @return array - array of $Menu data
  */
  function __construct(string $Name='default',string $Dir='') {
    $Directory=($Dir==''?CURENT_DIR:$Dir);
    $Path=$this->GetPath($Name,($Dir==''? CURENT_DIR:$Dir));
    $Menu=$this->IncludeMenu($this->GetPath($Name,($Dir==''?CURENT_DIR:$Dir)));
    //Requer Menu Processing by EventEmiter
    $this->MenuProcessingRequest($Name,$Menu);
    return $Menu;
  }
  /**
  * Function for get path to menu file
  * @param string $Name - Name of Menu
  * @param string $Dir - Directory of menu
  * @return string - path to menu file or clear string
  */
  private function GetPath(string $Name,string $Dir){
    $Path=$_SERVER['DOCUMENT_ROOT'].$Dir.'/menu.'.$Name.'.php';
    //if is file return path
    if(is_file($Path)) {
      return $Path;
    } else {
      //get alternative path by upper dir
      $SplitedDir=explode('/',str_replace('\\','/',$Dir));
      if(count($SplitedDir)>1){
        unset($SplitedDir[count($SplitedDir)-1]);
        $NewDirPath=implode('/',$SplitedDir);
        return $this->GetPath($NewDirPath,$Name);
      } else {
        //if is last dir return clear string
        return '';
      }

    }
  }
  /**
  * Function for request of processing of menu
  * @param string $Name - Name of Menu
  * @param array link $Menu - link to menu array data
  * @return void
  */
  function MenuProcessingRequest(string $Name, array &$Menu){
    $EventEmiter  = \Event\Loader::GetEventEmiter();
    $EventEmiter->emit("$Name-menu",$Menu);
  }
  /**
  * Function for require Menu Data from file
  * @param string $Path - Path to menu file
  * @return array - array of menu data
  */
  function IncludeMenu(string $Path){
    if($Path!='') return require_once $Path;
    else return array();
  }

}
