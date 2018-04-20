<?
namespace Users;
/**
 * User class
 */
class User {
  private $UserData;
  private $ID=0;
  function __construct(int $ID=0) {
    $this->UserData=new UserModel();
    if($ID>0) $this->ID=$ID;
    else if(strlen($_COOKIE["hash"])>0) {
      $LoginModel=new Login();
      $obLoginModel=$LoginModel->GetList(array('user_hash'=>$_COOKIE["hash"]));
      if($obLoginModel->rowCount){
        $arLoginModel=$obLoginModel->fetch(PDO::FETCH_ASSOC);
        $this->ID=$arLoginModel['user_id'];
      }
    } else {
      $this->ID=0;
    }
  }
  public function GetUser(int $ID=0){
    if($ID>0) return $this->UserData->GetByID($ID)->Fetch(\PDO::FETCH_ASSOC);
    else return $this->UserData->GetByID($this->ID)->Fetch(\PDO::FETCH_ASSOC);
  }
  public function GetGroups(int $ID=0){
    $obUserModel=new GroupModel();
    if($ID>0) return $obUserModel->GetUserGroups($ID);
    else return $obUserModel->GetUserGroups($this->ID);
  }
  public function Add(array $Data){
    $userData=$Data; $Lang=new \Lang\Includer(__FILE__);
    $userData['user_reg_time']=date("Y-m-d H:i:s");
    if($Data['user_password']==$Data['user_password_confirm']){
      $userData['user_password']=$this->TransformPassword($Data['user_password']);
    } else return \Entity\Error::CreateErrorArray('user_password',$Lang->GetMessage('UserRegistrationPasswordError'));
    return $this->UserData->Add($Data);
  }
  public function Update(int $ID,array $Data){
    $userData=$Data; $Lang=new \Lang\Includer(__FILE__);
    if($Data['user_password']==$Data['user_password_confirm']){
      $userData['user_password']=$this->TransformPassword($Data['user_password']);
    } else return \Entity\Error::CreateErrorArray('user_password',$Lang->GetMessage('UserRegistrationPasswordError'));
    $arUserInfo=$this->UserData->GetByID($this->ID)->Fetch(\PDO::FETCH_ASSOC);
    return $this->UserData->Update($arUserInfo['index'],$Data);
  }
  public function Delete(int $ID){
    $arUserInfo=$this->UserData->GetByID($this->ID)->Fetch(\PDO::FETCH_ASSOC);
    return $this->UserData->Delete($arUserInfo['index']);
  }
  public function Block(int $ID){
    $arUserInfo=$this->UserData->GetByID($this->ID)->Fetch(\PDO::FETCH_ASSOC);
    return $this->UserData->Update($arUserInfo['index'],array('user_status'=>0),false);
  }
  public function ChangeGroups(array $IDs){
    if($this->ID>0){
      $UserGroupConnect=new UserGroupsConnector();
      $UserGroupConnect->DeleteUserGroups($this->ID);
      return $UserGroupConnect->AddUserGroups($this->ID,$IDs);
    } else return false;
  }
  public function Login(string $Login,string $Password){
    $strHash=$this->TransformPassword($Password);
    $obUserModel=$this->UserData->GetList(array('user_login'=>$Login,'user_password'=>$strHash));
    if($obUserModel->rowCount){
      $arUserModel=$obUserModel->fetch(PDO::FETCH_ASSOC);
      $obLoginModel=new Login();
      $obLoginModel->Add(
        array(
          'user_id'=>$arUserModel['user_id'],
          'user_hash'=>$strHash
        )
      );
      setcookie("hash",$strHash,time()+25920000);
      $this->ID=$arUserModel['user_id'];
      return true;
    } else return false;
  }
  public function Logout(){
    $strHash=$_COOKIE["hash"];
    if(strlen($strHash)>0){
      $LoginModel=new Login();
      $obLoginModel=$LoginModel->GetList(
        array(
          'user_hash'=>$strHash
        )
      );
      $arLoginModel=$obLoginModel->Fetch();
      $LoginModel->Delete($arLoginModel['ID']);
      setcookie("hash",'',time()-10);
      $this->ID=0;
      return true;
    } return false;
  }
  public function IsLogin(){
    return $this->ID==0;
  }
  private function TransformPassword(string $Password){
    return sha1($Password);
  }
}
