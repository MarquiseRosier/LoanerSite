<?php
  include $_SERVER['DOCUMENT_ROOT'] . '/form/processing/Connect.php';

  $db = new Connect();
  $dbc = $db->getPDO();
  
  $stmt = $dbc->prepare('SELECT loaner_number FROM Loaner WHERE loaner_number NOT IN (SELECT * FROM OutBook)');

  $stmt->execute();

  $result = $stmt->fetchAll();

  foreach($result as $index){
    echo '<option value="' . $index['loaner_number'] . '">' . $index['loaner_number'] . '</option>';}
?>
