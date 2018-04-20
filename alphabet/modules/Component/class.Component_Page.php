<?
namespace Component;
/**
 *
 */
class Page {
  function __construct(array $Components) {
    ob_start();
    foreach ($Components as $Key => $arSettings) {
      new \Component\Engine($Key,$arSettings['Parameters'],$arSettings['Data']);
    }
    $strResult=ob_get_clean();
    ob_end_clean();
    return $strResult;
  }
}
