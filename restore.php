
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

$statementPDO = $pdo->exec('CREATE TABLE ' . shopsTable .
'( id int(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(32) NOT NULL,
  password VARCHAR(64) NOT NULL,
  PRIMARY KEY(id),
  UNIQUE KEY `login` (`login`)
)');

$statementPDO = $pdo->exec('CREATE TABLE ' . cityTable .
'( id int(11) NOT NULL AUTO_INCREMENT,
  shop VARCHAR(90) NOT NULL,
  PRIMARY KEY(id)
)');

$statementPDO = $pdo->exec('CREATE TABLE ' . chatMessageTable .
'( id int(11) NOT NULL AUTO_INCREMENT,
  city_translit VARCHAR(90) NOT NULL,
  city_rus VARCHAR(90) NOT NULL,
  PRIMARY KEY (id)
)');

$statementPDO = $pdo->exec('CREATE TABLE ' . chatInfoTable .
'( userMessageId int(11) NOT NULL AUTO_INCREMENT,
  login VARCHAR(64) NOT NULL,
  message blob NOT NULL,
  posted_at datetime NOT NULL,
  chat_id VARCHAR(5) NOT NULL,
  PRIMARY KEY(userMessageId)
)');

?>
