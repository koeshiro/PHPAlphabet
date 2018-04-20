<?
namespace DataBase;
require_once MODULES_DIR.'/DataBase/class.DataBase_Connector.php';
require_once MODULES_DIR.'/DataBase/class.DataBase_SQLBuilder.php';
require_once MODULES_DIR.'/DataBase/class.DataBase_Model.php';
require_once MODULES_DIR.'/DataBase/class.DataBase_Table.php';
try {
  Connector::SetConnection('mysql:host='.DB_HOST.';dbname='.DB_BASE,DB_USER,DB_PASSWORD);
} catch(PDOException $e) {
  echo error;
}
