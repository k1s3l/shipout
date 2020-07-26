<?php

class Chat
{
	public function sendHeaders($headersText, $newSocket, $ipAddr, $port) {
		$headers = array();
		$tmpline = preg_split("/\r\n/", $headersText);

		foreach ($tmpline as $line) {
			$line = rtrim($line);
			if(preg_match('/\A(\S+): (.*)\z/', $line, $mathes)) {
				$headers[$mathes[1]] = $mathes[2];
			}
		}

		$key = $headers['Sec-WebSocket-Key'];
		$sKey = base64_encode(pack('H*', sha1($key.'258EAFA5-E914-47DA-95CA-C5AB0DC85B11')));
		$strHeadr =
	"HTTP/1.1 101 Switching Protocols \r\n" .
	"Upgrade: websocket\r\n" .
	"Connection: Upgrade\r\n" .
	"Sec-WebSocket-Accept: $sKey\r\n\r\n"
		;

		socket_write($newSocket, $strHeadr, strlen($strHeadr));
	}


	public function seal($socketData) {
			$b1 = 0x81;
			$length = strlen($socketData);
			$header = "";

			if($length <= 125) {
					$header = pack('CC', $b1, $length);
			}
			else if($length > 125 && $length < 65536) {
					$header = pack('CCn', $b1, 126, $length);
			}
			else if($length > 65536) {
					$header = pack('CCNN', $b1, 127, $length);
			}

			return $header.$socketData;

	}

	public function createChatMessage($fname, $val, $time, $roomID) {
			$messageArray = [
					'name' => $fname,
					'message' => $val,
					'time' => $time,
					'roomID' => $roomID
			];

			return $this->seal(json_encode($messageArray));
	}

	public function send($val,$clientSocketArray) {
			$messageLength = strlen($val);

			foreach($clientSocketArray as $clientSocket) {
					@socket_write($clientSocket, $val, $messageLength);
			}

			return true;
	}

	public function unseal($socketData) {

			$length = ord($socketData[1]) & 127;


			if($length == 126) {
					$mask = substr($socketData,4,4);
					$data = substr($socketData,8);
			}
			else if($length == 127) {
					$mask = substr($socketData,10, 4);
					$data = substr($socketData,14);
			}
			else {
					$mask = substr($socketData,2, 4);
					$data = substr($socketData,6);
			}

			$socketStr = "";

			for($i = 0; $i < strlen($data); ++$i) {
					$socketStr .= $data[$i] ^ $mask[$i%4];
			}

			return $socketStr;

	}


}



?>
