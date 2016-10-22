<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/form/processing/Connect.php';

  $db = new Connect();
  $dbc = $db->getPDO();

  $stmt = $dbc->prepare('SELECT loaner_number FROM OutBook');
  $stmt2 = $dbc->prepare('SELECT loaner_number FROM OutBook');
  
  $stmt->execute();
  $stmt2->execute();

  $result = $stmt->fetchAll();
  $test = $stmt2->fetchAll();
  $testHolder = array();

  foreach($test as $testIndex)
    $testHolder[] = $testIndex['loaner_number'];
  
  if($testHolder !=  null){
    echo '<select name="InList">';
    foreach($result as $index){
      echo '<option value="' .  $index['loaner_number'] . '">' . $index['loaner_number'      ] . '</option>';
  }
    echo '</select>';
    echo '<button type="submit">Return Selected Loaner</button>';
}
  else{
  echo '<b><br><p>There Are No Loaners Rented Currently</p></br></b>';
  echo '<button type="submit">Continue</button>'; 
}
?>
