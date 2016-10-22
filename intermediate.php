<?php
  class pubSub{
    private $currLoaner;
    
    function __construct(){
      $this->currLoaner = $_POST['InList'];
    }

    function getLoaner()
    {
     return $this->currLoaner; 
    }

    function Redirect($url, $permanent = false)
    {
      header('Location: ' . $url, true, $permanent ? 301 : 302);
      exit();
    }
  }
  session_start();
  $driver = new pubSub();
  $_SESSION['lnr'] = $driver->getLoaner();
  $driver->Redirect('./checkIn.php', false);
?>
