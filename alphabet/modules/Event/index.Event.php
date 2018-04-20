<?
namespace Event;
require_once MODULES_DIR.'/Event/class.Event_Loader.php';
$EventEmiter=new Emiter();
\Alphabet\LocalStorage::SetEventEmiter($EventEmiter);
Loader::SetEventEmiter($EventEmiter);
