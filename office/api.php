<?php
header('Content-Type:text/html;charset=utf-8');
date_default_timezone_set('PRC');

require_once('config.php');
require_once('db.php');
require_once('model.php');

//http://www.ads.com/office/api.php?token=30ebc25ed2dkkk256e2222ea76809724b&username=waha&password=jingjian&ac=get_permission
//http://vip.livelyservice.com/api.php?token=30ebc25ed2d7b256e2222ea76809724b&
$api = new Model();
$action = $api->getParams('ac');
$featur = $api->getParams('fe');
$data = array();
if($action){
	switch (strtolower($action)){

		case 'get_permission':
			$data = $api->get_permission();
			break;
		case 'monitor_dele':
			require_once 'monitor_dele.php';
			$monitorDele=new MonitorDele();
			$data=$monitorDele->{$featur}();
			break;
		case 'monitor_reply':
			require_once 'monitor_reply.php';
			$monitorReply=new MonitorReply();
			$data = $monitorReply->{$featur}();
			break;	
			
	}
}

echo json_encode($data);
exit;