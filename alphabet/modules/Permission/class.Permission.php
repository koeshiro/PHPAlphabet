<?
namespace Permission;
/**
 * User permissions
 */
class Permission {
  private $Groups=array();
  private $Roles=array();
  function __construct(int $UserID) {
    $obGroupModel=new GroupModel(); $obRoleModel=new RoleModel();
    $this->Groups=$obGroupModel->GetUserGroups($UserID);
    foreach ($this->Groups as $Group) {
      $this->Roles[]=$obRoleModel->GetByID($Group['role_id']);
    }
  }
  public function isDenyAccessForRole(array $Roles){
    foreach ($this->Roles as $Role) {
      if(in_array($Role['id'],$Roles)||in_array($Role['role_code'],$Roles)){
        return true;
      }
    } return false;
  }
  public function isDenyAccessForGroup(array $Groups){
    foreach ($this->GetGroups as $Group) {
      if(in_array($Group['id'],$Groups)||in_array($Group['group_code'],$Groups)){
        return true;
      }
    } return false;
  }
  public function isAllowAccessForRole(array $Roles){
    foreach ($this->Roles as $Role) {
      if(in_array($Role['id'],$Roles)||in_array($Role['role_code'],$Roles)){
        return true;
      }
    } return false;
  }
  public function isAllowAccessForGroup(array $Group){
    foreach ($this->GetGroups as $Group) {
      if(in_array($Group['id'],$Groups)||in_array($Group['group_code'],$Groups)){
        return true;
      }
    } return false;
  }

}
