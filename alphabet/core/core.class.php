<?
namespace Alphabet;
  /**
   * System Core / Start class
   */
  class Core {
    private $IncludedModules=array();
    /**
    * Function __construct starting work
    * @param bool $IncludeAll - if true auto inslude all modules
    */
    function __construct(bool $IncludeAll=false){
      if($IncludeAll){
        $Modules=$this->getModules();
        foreach ($Modules as $Module) {
          $this->includeModule($Module);
        }
      }
      return $this;
    }
    /**
     * Getting modules from modules directory
     * @return array $Modules
     *                      Path - string absolute path to module dir
     *                      Name - module name
     */
    private function getModules(){
      $ModulesRAW=scandir(MODULES_DIR);$Modules=array();
      foreach ($ModulesRAW as $Name) {
        if(($Name!='.'&&$Name!='..')&&is_dir(MODULES_DIR.'/'.$Name))$Modules[]=array('Path'=>MODULES_DIR.'/'.$Name,'Name'=>$Name);
      } return $Modules;
    }
    /**
    * Includ by Name Space
    * @param string $NameSpace
    */
    public function includByNameSpace(string $NameSpace){
        $NameSpaceInfo=explode("\\",$NameSpace);
        if(is_dir(MODULES_DIR.'/'.$NameSpaceInfo[0])) $Module=array('Path'=>MODULES_DIR.'/'.$NameSpaceInfo[0],'Name'=>$NameSpaceInfo[0]);
        else if(is_dir(ALPHABET_DIR.'/'.$NameSpaceInfo[0].'/'.$NameSpaceInfo[1])) $Module=array('Path'=>ALPHABET_DIR.'/'.$NameSpaceInfo[0].'/'.$NameSpaceInfo[1],'Name'=>$NameSpaceInfo[1]);
        else throw new \Exception("Module ($NameSpace) not found", 1);
        $this->includeModule($Module);
    }
    /**
     * Including modules
     * @param array $Module
     *                      Path - string absolute path to module dir
     *                      Name - module name
     * @return boolean
     */
    public function includeModule(array $Module){
      // including files
      $IncludingFiles=array('functions','vars','class','index');
      $isIncluded=false;
      // check path to module and not included is before
      if(is_dir($Module['Path']) && !in_array($Module['Name'],$this->IncludedModules)){
         //including settings
        if(is_file($Module['Path'].'/settings.'.$Module['Name'].'.php')) $moduleSettings=require_once($Module['Path'].'/settings.'.$Module['Name'].'.php');
        else $moduleSettings=array();
        //including module files
        foreach ($IncludingFiles as $FileName) {
          if(is_file($Module['Path'].'/'.$FileName.'.'.$Module['Name'].'.php')) {
            require_once $Module['Path'].'/'.$FileName.'.'.$Module['Name'].'.php';
            $isIncluded=true;
          }
        }
      }
      //register included module
      if($isIncluded) $this->IncludedModules[]=$Module['Name'];
      return $isIncluded;
    }
  }
