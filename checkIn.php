<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/form/processing/Connect.php';

  session_start();
  $index;

  function Redirect($url, $permanent=false){
  if(headers_sent() == false)
  {
    header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
  }
    exit();
  }

  $loanerNumb = $_SESSION['lnr'];
  
  $db = new Connect();
  $dbc = $db->getPDO();

  $stmt = $dbc->prepare('SELECT charger FROM Trans WHERE loaner_number=:loaner AND (staIn = "0" AND staOut = "1")');
  $stmt->execute(array('loaner' => $loanerNumb));
  
  $result = $stmt->fetch();
 
  if(($result['charger'] == 'YES') && ($_POST['chg'] === null)){
    echo '<br><b> This Student Must Return Charger </b></br>';

  echo '<form method="post" action=""/>';
  echo '<br><label for="chargerQuestion">Did Student Submit Charger></br>';
  echo '<br><label for="yes">Yes</label></br>';
  echo '<input type="radio" name="chg" value="1">';
  echo '<br><label for="no">No</label></br>';
  echo '<input type="radio" name="chg" value="0">';
  echo '<br><button type="submit">Submit Answer</button></br>';
  }

  else if($_POST['chg'] === "1"){
  $stmt1 = $dbc->prepare('SELECT * FROM Trans WHERE loaner_number=:loaner'); 
  $stmt1->execute(array('loaner' => $loanerNumb));
  $result = $stmt1->fetchAll();
  $in = "in";
  foreach($result as $index){}

  $lNumb = $index['loaner_number'];

$stmt3 = $dbc->prepare('UPDATE Trans SET staIn=:sIn,staOut=:sOut,dateIn=NOW() WHERE loaner_number=:lN');

  $stmt3->execute(array('lN' => $lNumb,'sIn' => '1','sOut' => '0'));
    
  $stmt2 = $dbc->prepare('DELETE FROM OutBook WHERE loaner_number=:loaner');
  $stmt2->execute(array('loaner' => $loanerNumb));
  
  print_r($index);
  echo '<b>' . $loanerNumb . ' Was Successfully Checked In. GoodBye! </b>';
  
  echo '<form action="../index.php" method="get"/>';
  echo '<button type="submit">Return To Rental Page</button>';
}

  else{
  Redirect('../index.php', true);
}
?>
