<?php
    
  require $_SERVER['DOCUMENT_ROOT'] . '/form/processing/Connect.php';

  $db = new Connect();
  $dbc = $db->getPDO();

  $staPick = array('in' => '1', 'out' => '0');

  function query($dbc, $lst, $stat, $arr){
    if($lst === ''){
      if($stat === 'all'){
        $stmt = $dbc->prepare('SELECT * FROM Trans');
        $stmt->execute();
      }
      else{
        $stmt = $dbc->prepare('SELECT * FROM Trans WHERE staIn=:st');
        $stmt->execute(array('st' => $arr[$stat]));
      }
      return $stmt;
    }
    else{
      if($stat != 'all'){
        $stmt = $dbc->prepare('SELECT * FROM Trans WHERE last_name=:ln AND staIn=:st');
        $stmt->execute(array('ln' => $lst, 'st' => $arr[$stat]));
      }
      else{
        $stmt = $dbc->prepare('SELECT * FROM Trans WHERE last_name=:ln');
        $stmt->execute(array('ln' => $lst));
      }
      return $stmt;
    }
  }

  echo $staPick[$_POST['status']] . "MARQUISE ROSIER";
  
  $result = query($dbc, $_POST['last_name'], $_POST['status'], $staPick);

  $result1 = $result->fetchAll();  
  
  echo '<table style="width:100%">';
  echo '<tr>';
  echo '<th>Loaner Number</th>';
  echo '<th>Renters Name </th>';
  echo '<th>Employee Last </th>';
  echo '<th>Issue</th>';
  echo '<th>Status</th>';
  echo '</tr>';

  foreach($result1 as $index){
    echo '<tr>';
    echo '<td>' . $index['loaner_number'] . '</th>';
    echo '<td>' . $index['first_name'] . $index['last_name'] . '</td>';
    echo '<td>' . $index['employee_last'] . '</td>';
    echo '<td>' . $index['issue'] . '</td>';
    if($index['staIn'] === '1'){
      echo '<td>' . 'IN' . '</td>';
    }
    else if($index['staIn'] === '0'){
      echo '<td>' . 'OUT' . '</td>';
    }
  }
  echo '</table>';  
?>
