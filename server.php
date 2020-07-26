<?php
#ini_set('display_errors', on);

$ipAddr = 'shop1.local';
$port = 9002;


require_once 'chat.php';
$chat = new Chat();
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
socket_set_option($socket, SOL_SOCKET, SO_REUSEADDR, 1);
socket_bind($socket, 0, $port);
socket_listen($socket);
$clientSocketArray = array($socket);

while (true) {

	$newSocketArray = $clientSocketArray;
	$write = $except = null;
	socket_select($newSocketArray, $write, $except,0,10);

	if(in_array($socket, $newSocketArray)) {
		$newSocket = socket_accept($socket);
		$header = socket_read($newSocket, 2048);
		$clientSocketArray[] = $newSocket;
		$chat->sendHeaders($header, $newSocket, $ipAddr, $port);
    $newSocketArrayIndex = array_search($socket, $newSocketArray);
		unset($newSocketArray[$newSocketArrayIndex]);

}

foreach($newSocketArray as $newSocketArrayResource) {
		$bytesocketLength = @socket_recv($newSocketArrayResource, $socketData, 1024, 0);
		while($bytesocketLength >=  1) {
				include 'check.php';
				$socketMessage = $chat->unseal($socketData);
				$messageObj = json_decode($socketMessage);
				if($messageObj->fname !== null || $messageObj->val !== null || $messageObj->time !== null || $messageObj->roomID !== null || $messageObj->login !== null){
			  $chatMessage = $chat->createChatMessage($messageObj->fname, $messageObj->val, $messageObj->time, $messageObj->roomID);
				$chat->send($chatMessage,$clientSocketArray);
				$stmtPDOquery = $pdo->prepare('INSERT INTO chatMessage (login, message, posted_at, chat_id) VALUES (?, ?, NOW(), ?)');
				$stmtPDOquery->bindParam(1, $messageObj->login);
				$stmtPDOquery->bindParam(2, $messageObj->val);
				$stmtPDOquery->bindParam(3, $messageObj->roomID);
				$stmtPDOquery->execute();
			}
			break 2;
			}
		}
}

socket_close($socket);

?>
