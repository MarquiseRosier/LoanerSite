<?php

  require_once $_SERVER['DOCUMENT_ROOT'] . '/form/processing/Connect.php';
  
  $db = new Connect();
  $pdo = $db->getPDO();
  $last_names = array();
  $counter = 0;

  $statement = $pdo->prepare('select employee_first, employee_last from Employees');
  $statement->execute();
  $result = $statement->fetchAll();
   
  foreach($result as $index)
    echo '<option value=' . $index['employee_last'] . '>'  
    . $index['employee_first'] . ' ' . $index['employee_last'] . '</option>';
?>
