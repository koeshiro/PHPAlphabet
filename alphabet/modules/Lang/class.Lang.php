<?
namespace Lang;
/**
 * Includer
 */
class Includer {
  private $RAWPath;
  private $Path;
  private $Langs;
  function __construct(string $URL,string $Lang=DEFAULT_LANGUGE){
    $this->RAWPath=$URL;
    if(
      $Lang!=DEFAULT_LANGUGE&&
      is_file($this->GetPath($Lang))
    ){
      $this->lang=$Lang;
    } else {
      $this->UserLangs=$this->GetUserLangs();
      $this->Lang=$this->GetLang($this->UserLangs);
    }
    $this->Path=$this->GetPath($this->Lang);
    if(is_file($this->Path))$this->Langs=include_once($this->Path);
    else throw new \Exception("Error in include lang file. File ($this->Path) of lang $this->Lang not exitsts", 1);
  }
  private function GetPath($Lang=DEFAULT_LANGUGE){
    return dirname($this->RAWPath).'/lang/'.$Lang.'/'.str_replace(\DOCUMENT_ROOT,'',$this->RAWPath);
  }
  private function GetUserLangs(){
    preg_match_all('/([a-z]{1,8}(?:-[a-z]{1,8})?)(?:;q=([0-9.]+))?/', strtolower($_SERVER["HTTP_ACCEPT_LANGUAGE"]), $matches);
    $LANGUAGE=array();
    foreach ($matches[1] as $Key=>$Value) {
      if($matches[2][$Key]=='')$LANGUAGE[$Value]=1;
      else $LANGUAGE[$Value]=$matches[2][$Key];
    }
    return $LANGUAGE;
  }
  public function GetLang(array $UserLangs){
    foreach ($UserLangs as $key => $value) {
      if(is_string($key)){
        if(is_file($this->GetPath($key))){
          return $key;
        }
      }
    } return DEFAULT_LANGUGE;
  }
  public function GetMessage($Name){
    return $this->Langs[$Name];
  }
  public function ExecuteMessageTemp(string $Message, array $Data){
    $strResult=$Message;
    foreach ($Data as $key => $value) {
      $strResult=str_replace("#$key#",$value,$strResult);
    }
    return $strResult;
  }
}
