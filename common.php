<?php
define('APPLICATION_TITLE','Plume');
define('MD_ROOT','./pages/');
define('MD_EXTENSION','.md');
define('MD_ACCUEIL','Accueil');
define('MD_MENU','Menu');
define('MD_MENU_DEFAUT_CONTENT','* [Accueil](?page=Accueil)');
define('MAX_UPLOAD_SIZE',100000);
define('FORBIDEN_UPLOAD_FORMAT','exe');
define('UPLOAD_FOLDER','file/');
define('CACHE_RSS','feeds.rss');
define('REFRESH_RSS_TIME',30);
define('EVENT_FILE','events.json');
define('ADMIN_PASSWORD','admin');

//Démarrage session
session_start();
require_once('function.php');
//Auto inclusion des classes appelées
function __autoload($class){
	if(file_exists($class.".class.php"))require_once($class.".class.php");
}
//Pronlongement de la durée des session à 1h
ini_set('session.gc_maxlifetime', '3600');
//Calage de la date
date_default_timezone_set('Europe/Paris');
//Récuperation des entrées utilisateur
$_ = array_merge($_POST,$_GET);
foreach($_ as $key=>$value){
	$_[$key] = htmlentities($value, ENT_QUOTES, "UTF-8");
}

$myUser = isset($_SESSION['user'])?unserialize($_SESSION['user']):false;

//Récuperation de la page courante
$page = isset($_['page'])?$_['page']:MD_ACCUEIL;
$pagePath = MD_ROOT.$page.MD_EXTENSION;
$menuPath = MD_ROOT.MD_MENU.MD_EXTENSION;
//Récuperation de l'action effectuée
$action = isset($_['action'])?$_['action']:'';
?>