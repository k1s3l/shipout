
<?php
require_once 'check.php';

$userTable = 'users';
$dataTable = 'data';
$shopsTable = 'shops';
$cityTable = 'city';
$chatMessageTable = 'chatMessage';
$chatInfoTable = 'chatInfo';


$statementPDO = $pdo->prepare('CREATE TABLE data
( id int(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(32) NOT NULL,
  password VARCHAR(64) NOT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY `login` (`login`)
)');
#$statementPDO->bindParam(1, $dataTable);
$statementPDO->execute();

$statementPDOquery = $pdo->prepare('CREATE TABLE users
( id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  email VARCHAR(254) NOT NULL,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  middle_name VARCHAR(30) NOT NULL,
  city VARCHAR(40) NOT NULL,
  vk VARCHAR(32) NOT NULL,
  FOREIGN KEY(id) REFERENCES data(id),
  PRIMARY KEY(id)
)');

$statementPDOquery->execute();

$statementPDO = $pdo->prepare('CREATE TABLE shops (
  id int(11) NOT NULL AUTO_INCREMENT,
  shop VARCHAR(90) NOT NULL,
  PRIMARY KEY(id)
)');
#$statementPDO->bindParam(1, $shopTable);
$statementPDO->execute();

$arr = [
  'yoox',
  'farfetch',
  'endclothing',
  'mr-porter',
  'resolve',
  'footasylum',
  'luisaviaroma',
  'forward',
  'urban-outfitters',
  'scotts-menswear',
  'footpatrol',
  'size-co-uk',
  'jd-sports'
];
foreach($arr as $value){
  $statementPDO = $pdo->prepare('INSERT INTO shops (shop) VALUES (?)');
  $statementPDO->bindParam(1, $value);
  $statementPDO->execute();
}


function translit($value)
{
	$converter = array(
		'а' => 'a',    'б' => 'b',    'в' => 'v',    'г' => 'g',    'д' => 'd',
		'е' => 'e',    'ё' => 'e',    'ж' => 'zh',   'з' => 'z',    'и' => 'i',
		'й' => 'y',    'к' => 'k',    'л' => 'l',    'м' => 'm',    'н' => 'n',
		'о' => 'o',    'п' => 'p',    'р' => 'r',    'с' => 's',    'т' => 't',
		'у' => 'u',    'ф' => 'f',    'х' => 'h',    'ц' => 'c',    'ч' => 'ch',
		'ш' => 'sh',   'щ' => 'sch',  'ь' => '',     'ы' => 'y',    'ъ' => '',
		'э' => 'e',    'ю' => 'yu',   'я' => 'ya',
		'А' => 'A',    'Б' => 'B',    'В' => 'V',    'Г' => 'G',    'Д' => 'D',
		'Е' => 'E',    'Ё' => 'E',    'Ж' => 'Zh',   'З' => 'Z',    'И' => 'I',
		'Й' => 'Y',    'К' => 'K',    'Л' => 'L',    'М' => 'M',    'Н' => 'N',
		'О' => 'O',    'П' => 'P',    'Р' => 'R',    'С' => 'S',    'Т' => 'T',
		'У' => 'U',    'Ф' => 'F',    'Х' => 'H',    'Ц' => 'C',    'Ч' => 'Ch',
		'Ш' => 'Sh',   'Щ' => 'Sch',  'Ь' => '',     'Ы' => 'Y',    'Ъ' => '',
		'Э' => 'E',    'Ю' => 'Yu',   'Я' => 'Ya',
	);
	$value = strtr($value, $converter);
	return $value;
}

$statementPDO = $pdo->prepare('CREATE TABLE city (
  id int(11) NOT NULL AUTO_INCREMENT,
  city_translit VARCHAR(90) NOT NULL,
  city_rus VARCHAR(90) NOT NULL,
  PRIMARY KEY (id)
)');
#$statementPDO->bindParam(1, $cityTable);
$statementPDO->execute();


$statementPDO = $pdo->prepare('SELECT region_id, name FROM geo_city');
$statementPDO->execute();
foreach($statementPDO as $value){
  $city_rus = $value['name'];
  $city_translit = translit($city_rus);
  $statementPDO = $pdo->prepare('INSERT INTO city (city_translit, city_rus) VALUES(?, ?)');
#  $statementPDO->bindParam(1, $cityTable);
  $statementPDO->bindParam(1, $city_translit);
  $statementPDO->bindParam(2, $city_rus);
  $statementPDO->execute();
}


$statementPDO = $pdo->prepare('CREATE TABLE chatMessage (
  userMessageId int(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(64) NOT NULL,
  message blob NOT NULL,
  posted_at datetime NOT NULL,
  chat_id VARCHAR(5) NOT NULL,
  PRIMARY KEY(userMessageId)
)');
#$statementPDO->bindParam(1, $chatMessageTable);


$statementPDO->execute();

$statementPDO = $pdo->prepare('CREATE TABLE chatInfo (
  chat_id int(5) NOT NULL AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  shopOrders VARCHAR(11) NOT NULL,
  city VARCHAR(1) NOT NULL,
  PRIMARY KEY (chat_id)
)');
$statementPDO->bindParam(1, $chatInfoTable);
$statementPDO->execute();




?>
