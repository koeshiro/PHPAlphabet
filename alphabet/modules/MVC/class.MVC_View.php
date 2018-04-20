<?
namespace MVC;
/**
 * View
 */
class View {
  private $Data;
  private $Parameters;
  function __construct(array $Data=array(),array $Parameters=array()) {
    $this->Data=$Data; $this->Parameters=$Parameters;
  }
  public function includeView(string $Path){
    $arData=$this->Data; $arParam=$this->Parameters;
    return include_once str_replace('\\','/',$Path).'/template.php';
  }
}
