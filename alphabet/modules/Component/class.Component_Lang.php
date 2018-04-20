<?
namespace Component;
/**
 *
 */
class LangIncluder extends \Lang\Includer {
  private function GetPath(string $Lang=\Lang\DEFAULT_LANGUGE){
    return $this->RAWPath.'/lang/'.$this->lang.'/'.str_replace($_SERVER['DOCUMENT_ROOT'],'',$this->RAWPath);
  }
}
