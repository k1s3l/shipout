const socket = new WebSocket("ws://shop1.local:9002/server.php/server.php");
$(document).ready(function(){ function ajax(options) {
  return new Promise(function (resolve, reject) {
    $.ajax(options).done(resolve);
  });
}
	ajax({
  url: 'getSession.php',
  type: 'post',
  contentType: 'application/json; charset=utf-8',
  }).then(
  function fulfillHandler(data) {
    let login = data['login'];
		let fname = data['fname'];
		document.getElementById("button").addEventListener('click', function() {
			let room = window.location.pathname;
			let roomID = room.slice(6);
				let val = document.getElementById("text").value;
				if(val.trim() !== ''){
					let chat = document.getElementById("chat");
					let textMessage = document.getElementsByClassName("textMessage");
					let userText = document.getElementsByClassName("userText");
					now = new Date();
					nowBD = new Date().toISOString().slice(0, 19).replace('T', ' ');
					nowHours = now.getHours();
					nowMinutes = now.getMinutes();
					let time = nowHours + ':' + nowMinutes;
					let shopArray = [
						'adidas',
						'aizel',
						'sneakerhead',
						'superstep'
					];
					let partner = '';
					let matchUrl = val.match(/(https?:\/\/)?([\w-]{1,32}\.[\w-]{1,32})[^\s@]*/gm);
					if(matchUrl !== null){
					for(let increment = 0, _increment = shopArray.length; increment < _increment; increment++){
					let shopRegExp = new RegExp('((https:\/\/)|(https:\/\/www\.)|(www\.))?' + shopArray[increment] + '\.[^ ]*', 'gi'); 
					let shopUrl = val.match(shopRegExp);
					for(let inc = 0, _inc = matchUrl.length; inc < _inc; inc++){
						if(shopUrl !== null){
						for(let i = 0, _i = shopUrl.length; i < _i; i++){
							if(matchUrl[inc] == shopUrl[i]){
								matchUrl[inc] = matchUrl[inc].replace(/(\?.[^ ]+)|($)/, partner);
								 }
								}
							}
						}
					}
					for(let inc = 0, _inc = matchUrl.length; inc < _inc; inc++){
						let shopUrl = matchUrl[inc].replace(/\?[^ ]+/, '');
							 matchUrl[inc] = '<a href="https://' + matchUrl[inc] + '">' + shopUrl + '</a>';
					}
					for(let inc = 0, _inc = matchUrl.length; inc < _inc; inc++){
						let url = val.match(/(https?:\/\/)?([\w-]{1,32}\.[\w-]{1,32})[^\s@]*/gm);
						url = Array.from(url);
						httpsUrl = url[inc].match(/^https:\/\//gm);
						if(httpsUrl == null){
						val = val.replace(url[inc], matchUrl[inc]);
						}else{
						matchUrl[inc] = matchUrl[inc].replace(/\"https:\/\//, '');
						matchUrl[inc] = matchUrl[inc].replace(/\">/, '>');
						val = val.replace(url[inc], matchUrl[inc]);
						}
					}
}
					socket.send(JSON.stringify({
								'login' : login,
								'fname' : fname,
								'val' : val,
								'time' : time,
								'roomID' : roomID
							}));
				}
			});
  }
 );
});




socket.onmessage = function(event) {
	let messageParse = JSON.parse(event.data);
	let room = window.location.pathname;
	let roomID = room.slice(6);
	if(messageParse.roomID == roomID){
		let div = document.createElement("div");
		div.className = "message";
		div.innerHTML = "<div class\=\"textMessage\"><div class\=\"username\">" + decodeURI(messageParse.name) + "</div><div class=\"userText\">"+ messageParse.message +"</div></div><div class=\"time\">" + messageParse.time + "</div>";
		chat.append(div);
	}
}

socket.onerror = function() {
	let problems = document.createElement("div");
	let buttons = document.getElementById('right-buttons');
	problems.className = "problems";
	problems.innerHTML = "<div>Соединение разорвано</div><img src='/img/gif/giphy.gif'>";
	buttons.append(problems);
	}

socket.onopen = function() {
	console.log("connection succesfull");
}

	socket.onclose = function() {
		socket.close();
	}
