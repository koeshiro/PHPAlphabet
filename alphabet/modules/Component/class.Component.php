<?
namespace Component;
/**
 * Class for includ and use Components
 */
class Engine {
  private $ComponentName;
  private $ComponentPath;
  private $ComponentTemp;
  private $ComponentData;
  private $ComponentParameters;
  private $IncludingFiles=array('functions','vars','class','index');
  public function __construct(string $Name, string $Temp,array $Parameters,array $Data=array()){
    $this->ComponentName=$this->getComponentName($Name); $this->ComponentTemp=$Temp; $this->ComponentPath=$this->getComponentPath($Name);
    $this->ComponentParameters=$Parameters; $this->ComponentData=$Data;
    $this->includeFiles();
    return $this;
  }
  private function getComponentPath(string $Name){
    $Array=explode(":",$Name);
    unset($Array[count($Array)-1]);
    return implode("/",$Array);
  }
  private function getComponentName(string $Name){
    $Array=explode(":",$Name);
    return $Array[count($Array)-1];
  }
  private function includeFiles(){
    $ComponentDirName=COMPONENTS_DIR.'/'.$this->ComponentPath.'/'.$this->ComponentName;
    if(is_dir($ComponentDirName)){
      foreach ($this->IncludingFiles as $FileName) {
        if(is_file($ComponentDirName.'/'.$FileName.'.'.$this->ComponentName.'.php')) include_once $ComponentDirName.'/'.$FileName.'.'.$this->ComponentName.'.php';
      }
    }
  }
  public function includeTemplate(string $Name='default',array $Data=array(),bool $extractData=false){
    $EventEmiter=\Event\Loader::GetEventEmiter();
    if($Name!='default') $ComponentTemp=$this->$ComponentTemp;
    else $ComponentTemp=$Name;

    $ComponentDirName=COMPONENTS_DIR.'/'.$this->ComponentPath.'/'.$this->ComponentName;
    if(count($Data)>0) $arData=$Data;
    else if(count($this->ComponentData)>0) $arData=$this->ComponentData;
    if(count($this->ComponentParameters)>0) $arParam=$this->ComponentParameters;
    if(is_dir($ComponentDirName.'/templates/'.$ComponentTemp)){
      if($extractData) extract($Data);
      ob_start();
      include_once $ComponentDirName.'/templates/'.$ComponentTemp.'/template.php';
      $Result = ob_get_contents();
      ob_end_clean();
      $EventEmiter->emit($this->ComponentName.'_component_template_result',array('RESULT'=>$Result));
      return $Result;
    }
    return false;
  }
}
