<?php

  require $_SERVER['DOCUMENT_ROOT'] . '/form/errors/creds.php';  
 
  class Connect{
    private $pdo;
    private $dns;

    function __construct(){
      $this->dns = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' .
      DB_NAME;
      try{
      $this->pdo = new PDO($this->dns, DB_USER, DB_PW);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $this->pdo->exec('set session sql_mode = traditional');
      $this->pdo->exec('set session innodb_strict_mode = on');
      }catch(PDOException $e){die(htmlspecialchars($e->getMessages()));}
    }

    function getPDO(){
      return $this->pdo;
    }
  }
?>
