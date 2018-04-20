<?
namespace DataBase;
use \PDO;
/**
 * DataBase Table Object Presentation
 */
 class Model {
   public $TableName;
   public $Columns=array();
   var $Connection;
   public $TestStructure;
   function __construct(){
     $this->Connection=Connector::GetConnection();
     if($this->TestStructure){
       $this->TestTableStructure();
     }
   }
   private function TestTableStructure(){
     $Tables=$this->Connection->query('SHOW TABLES')->fetchAll(PDO::FETCH_ASSOC);
     $TableIsSet=false;

     foreach ($Tables as $Table) {
       if($Table['Tables_in_'.DB_BASE]==$this->TableName) $TableIsSet=true;
     }

     if(!$TableIsSet) $this->CreateTable();
     else {
       $Columns=$this->Connection->query('SHOW COLUMNS FROM '.$this->TableName)->fetchAll(PDO::FETCH_ASSOC);
       $sqlColumns=array();
       foreach ($Columns as $Column) {
         if(!array_key_exists($Column['Field'],$this->Columns)) $this->DeleteColumn($Column['Field']);
         else $sqlColumns[$Column['Field']]=$Column;
       }
       foreach ($this->Columns as $ColumnName => $ColumnSettings) {
         if(array_key_exists($ColumnName,$sqlColumns)){
           if(strlen($ColumnSettings['Length'])>0)$Type=strtoupper($ColumnSettings['Type'].'('.$ColumnSettings['Length'].')');
           else $Type=strtoupper($ColumnSettings['Type']);
           if(
               strtoupper($sqlColumns[$ColumnName]['Type']) != $Type ||
               strtoupper($sqlColumns[$ColumnName]['Null']) != strtoupper($ColumnSettings['Null']) ||
               (
                 strtoupper($sqlColumns[$ColumnName]['Key'])=='PRI' && strtoupper($ColumnSettings['Key'])!='PRIMARY'
               ) ||
               (
                 strtoupper($sqlColumns[$ColumnName]['Key'])=='UNI' && strtoupper($ColumnSettings['Key'])!='UNIQUE'
               ) ||
               $sqlColumns[$ColumnName]['Default'] != $ColumnSettings['Default'] ||
               strtoupper($sqlColumns[$ColumnName]['Extra']) != strtoupper($ColumnSettings['Extra'])
             ) {
               echo $ColumnName."\n";
               echo print_r($sqlColumns[$ColumnName]);
               echo print_r($this->Columns[$ColumnName]);
               $this->EditColumn($ColumnName,$this->Columns[$ColumnName]);
             }
         } else {
           $this->CreateColumn($ColumnName,$this->Columns[$ColumnName]);
         }
       }
     }
   }

   private function DeleteColumn(string $Column){
     return $this->Connection->exec('ALTER TABLE '.$this->TableName.' DROP COLUMN '.$Column.';');
   }
   private function EditColumn($ColumnName,$ColumnSettings){
     $TableName=$this->TableName;
     $Type=$ColumnSettings['Type'];
     if(strlen($ColumnSettings['Length'])>0) $Type=$Type.'('.$ColumnSettings['Length'].')';
     if(strtoupper($ColumnSettings['Null'])=='NO') $Null='NOT NULL';
     else $Null='NULL';
     if(array_key_exists('Default',$ColumnSettings)) $Default='DEFAULT '.$this->Connection->quote($ColumnSettings['Default']);
     else $Default='';
     return $this->Connection->exec("ALTER TABLE $TableName MODIFY COLUMN $ColumnName $Type $Null $Default;");
   }
   private function CreateColumn($ColumnName,$ColumnSettings){
     $TableName=$this->TableName;
     $Type=$ColumnSettings['Type'];
     if(strlen($ColumnSettings['Length'])>0) $Type=$Type.'('.$ColumnSettings['Length'].')';
     if(strtoupper($ColumnSettings['Null'])=='NO') $Null='NOT NULL';
     else $Null='NULL';
     if(array_key_exists('Default',$ColumnSettings)) $Default='DEFAULT '.$this->Connection->quote($ColumnSettings['Default']);
     else $Default='';
     return $this->Connection->exec("ALTER TABLE $TableName ADD COLUMN $ColumnName $Type $Null $Default;");
   }
   private function CreateTable(){
     $TableName=$this->TableName; $Keys='';
     $SQL='CREATE TABLE IF NOT EXISTS '.$TableName.' (';

     foreach ($this->Columns as $ColumnName => $ColumnSettings) {
       $Type=$ColumnSettings['Type'];

       if(strlen($ColumnSettings['Length'])>0) $Type=$Type.'('.$ColumnSettings['Length'].')';

       if(strtoupper($ColumnSettings['Null'])=='NO') $Null='NOT NULL';
       else $Null='NULL';

       if(array_key_exists('Default',$ColumnSettings)) $Default='DEFAULT '.$ColumnSettings['Default'];
       else $Default='';

       if(
           array_key_exists('Extra',$ColumnSettings)&&
           strtoupper($ColumnSettings['Extra'])!='PRIMARY'
         ) {
            $Extra=''.$ColumnSettings['Extra'];
       } else $Extra='';
       if(
                array_key_exists('Key',$ColumnSettings)
              ) {
                $Keys.="$ColumnSettings[Key] KEY (`$Primary`),"
            $Primary=$ColumnName;
       }

       $SQL.="`$ColumnName` $Type $Null $Default $Extra,";
     }

     //if(strlen($Keys)>0)$SQL.=$Keys;
     //else $SQL=substr($SQL,0,strlen($SQL)-2);
     $SQL.=$Keys;
     $SQL=substr($SQL,0,strlen($SQL)-2);
     $SQL.=")";

     return $this->Connection->exec($SQL);
   }
 }
