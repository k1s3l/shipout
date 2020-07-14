<?php
if(!isset($_SESSION['login']) || !empty($_SESSION['login'])){
session_start();
header('Content-type: application/json');
echo json_encode($_SESSION);

#$w_id = $_POST['w_id'];
#$c_id = $_POST['c_id']; 893327 id webmasters
#$info = file_get_contents('https://api.admitad.com/deeplink/' . w_id . '/advcampaign/' . c_id . '/');
#echo json_encode($info);
}
?>
