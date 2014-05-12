<?php

function event($title,$content,$page){

	if(!file_exists(EVENT_FILE)) touch(EVENT_FILE);
	$events = json_decode(file_get_contents(EVENT_FILE));
	$events = $events ==null?array():$events;
	$event = (object) array();
	$event->title = $title;
	$event->date = date('d/m/Y H:i:s');
	$event->link = (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "").$page;
	$event->content =$content;
	array_unshift($events,$event);
	file_put_contents(EVENT_FILE, json_encode($events));
}

function getDb($dbFile){
	if(!file_exists($dbFile)) touch($dbFile);
	$db = file_get_contents($dbFile);
	$db = $db == '' ? array() : json_decode(str_replace(array('<?php /* ',' */ ?>'),'',gzinflate($db)),true);
	return $db;
}
function saveDb($dbFile,$dbdata){
	if(!file_exists($dbFile)) touch($dbFile);
	file_put_contents($dbFile,gzdeflate('<?php /* '.json_encode($dbdata).' */ ?>'));
}


?>