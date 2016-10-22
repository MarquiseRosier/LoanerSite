<?php
  require $_SERVER['DOCUMENT_ROOT'] . '/form/processing/Connect.php';
  
  $db = new Connect();
  $dbc = $db->getPDO();
  $charger_issued = null;

  if($_POST['charger'] === '1'){
    $charger_issued = "YES";
  }
  else{
    $charger_issued = "NO";
  }
  
  $stmt = $dbc->prepare('INSERT INTO Trans(loaner_number, first_name, last_name, grade_level, issue,employee_last,charger,dateOut,staIn,staOut)VALUES(:ln, :first, :last, :grade,:iss,:emlast,:ci,NOW(),:sIn,:sOut)');

  $stmt->execute(array('ln' =>  $_POST['loanerName'], 'first' => $_POST['firstname'],
  'last' => $_POST['lastname'], 'grade' => $_POST['gradeLevel'], 'iss' => $_POST['problem'], 'emlast' => $_POST['employeeLast'], 'ci' => $charger_issued, 'sIn' => '0', 'sOut' => '1'));
  
  $stmt1=$dbc->prepare('INSERT INTO OutBook(loaner_number)VALUES(:ln1)');
  $stmt1->execute(array('ln1' => $_POST['loanerName']));

  echo '<b>'.$_POST['firstname'] . ' ' . $_POST['lastname'] . '</b>'; 
  echo '<b> You Have Rented: ' . $_POST['loanerName'] . '</b> <b> Successfully!</b>';

  echo '<form action="../index.php" method="get"/>';
  echo '<button type="submit">Return to Rental Page</button>';
?>
