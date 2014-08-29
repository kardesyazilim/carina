<?php 

if($q[0] == ''){
$w = $_SESSION['website'];
$contentUrl = "select * from core_url where core_url_key='$w'";
}
else{
$contentUrl = "select * from core_url where core_url_key='$q[0]'";
}

$content = $db->get_row($contentUrl);

$contentBody = "select * from contents where core_url_id='$content->id'";
$contentBody  = $db->get_row($contentBody);
if($contentBody){
echo $contentBody->content_body;

}
else{
	echo 'içerik girilmemiş';
}

?>