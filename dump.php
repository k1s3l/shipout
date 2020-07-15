<?php
# true or false разворот или создание дампа

class Dump {
  public function dumpDataBase($signal){
    if($signal == true){
    $statementPDO = $pdo->prepare(SELECT * FROM chatInfo);
    $statementPDO->execute();
    $data = $statementPDO->fetchAll();
    file_put_contents("output.json", json_encode($data));

    $statementPDO = $pdo->prepare(SELECT * FROM chatMessage);
    $statementPDO->execute();
    $data = $statementPDO->fetchAll();
    file_put_contents("output.json", json_encode($data));

    $statementPDO = $pdo->prepare(SELECT * FROM city);
    $statementPDO->execute();
    $data = $statementPDO->fetchAll();
    file_put_contents("output.json", json_encode($data));

    $statementPDO = $pdo->prepare(SELECT * FROM data);
    $statementPDO->execute();
    $data = $statementPDO->fetchAll();
    file_put_contents("output.json", json_encode($data));

    $statementPDO = $pdo->prepare(SELECT * FROM shops);
    $statementPDO->execute();
    $data = $statementPDO->fetchAll();
    file_put_contents("output.json", json_encode($data));

    $statementPDO = $pdo->prepare(SELECT * FROM users);
    $statementPDO->execute();
    $data = $statementPDO->fetchAll();
    file_put_contents("output.json", json_encode($data));

    }
    if($signal == false){
      $jsonDb = json_decode(file_get_contents("output.json"));
      file_put_contents("output.sql", $jsonDb);
     }
  }
}
$dump = new Dump();
$dump->dumpDataBase(1);
?>
