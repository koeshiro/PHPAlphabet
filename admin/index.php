<?
 require_once $_SERVER['DOCUMENT_ROOT'].'/system.php';
 use \Users\User as User;
 use \Permission\Permission as Permission;
 use \Lang\Includer as Lang;
 use \Component\Engine as Component;
 $Langs=new Lang(__FILE__);
 new Component(
   "admin:template:header",
   'default',
   array(
     'TITLE'=>$Langs->GetMessage('ADMIN_TITLE')
   ),
   array()
 );
 $obUser=new User(1);
 $obPermission=new Permission(1);

 echo '<pre>';
 if($obPermission->isAllowAccessForRole(array('admin','moderator'))) echo print_r($obUser->GetUser());
 else echo 'permission denay';
 echo '</pre>';

 new Component(
   "admin:template:footer",
   'default',
   array(),
   array()
 );
