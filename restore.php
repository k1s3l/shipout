
<?php
require_once 'check.php';
const dataTable = 'data';
const userTable = 'users';
const shopsTable = 'shops';
const cityTable = 'city';
const chatMessageTable = 'chatMessage';
const chatInfoTable = 'chatInfo';


$statementPDO = $pdo->exec('CREATE TABLE ' . dataTable .
'( id int(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(32) NOT NULL,
  password VARCHAR(64) NOT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY `login` (`login`)
)');

$statementPDO = $pdo->exec('CREATE TABLE ' . userTable .
'( id int(11) NOT NULL AUTO_INCREMENT,
  email VARCHAR(254) NOT NULL,
  first_name VARCHAR(30) NOT NULL,
  last_name VARCHAR(30) NOT NULL,
  middle_name VARCHAR(30) NOT NULL,
  city VARCHAR(40) NOT NULL,
  vk VARCHAR(32) NOT NULL,
  FOREIGN KEY(id) REFERENCES ' . dataTable . '(id),
  PRIMARY KEY(id)
)');

$statementPDO = $pdo->exec('CREATE TABLE ' . shopsTable .
'( id int(11) NOT NULL AUTO_INCREMENT,
  shop VARCHAR(32) NOT NULL,
  PRIMARY KEY(id)
)');

$statementPDO = $pdo->exec('CREATE TABLE ' . cityTable .
'( id int(11) NOT NULL AUTO_INCREMENT,
  city_translit VARCHAR(90) NOT NULL,
  city_rus VARCHAR(90) NOT NULL,
  PRIMARY KEY (id)
)');


$statementPDO = $pdo->exec('CREATE TABLE ' . chatInfoTable .
'( id INT(11) NOT NULL AUTO_INCREMENT,
  shop_id INT(11) NOT NULL,
  name VARCHAR(64) NOT NULL,
  chat_id INT(5) NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY(shop_id) REFERENCES ' . shopsTable . '(id)
)');

$statementPDO = $pdo->exec('CREATE TABLE ' . chatMessageTable .
'( userMessageId int(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  message BLOB NOT NULL,
  posted_at DATETIME NOT NULL,
  chat_id VARCHAR(5) NOT NULL,
  PRIMARY KEY(userMessageId),
  FOREIGN KEY(user_id) REFERENCES ' . dataTable . '(id)
)');

?>
