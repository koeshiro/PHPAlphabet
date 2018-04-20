<?
namespace Entity;
/**
 * Entity Error Class
 */
class Error extends Entity {
  static function CreateErrorArray($ColName,$ErrorText){
    return array(
      'error'=>true,
      'key'=>$ColName,
      'message'=>$ErrorText
    );
  }
}
