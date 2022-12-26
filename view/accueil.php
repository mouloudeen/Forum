<?php
class Accueil {
  private $message_ins="";
  private $message_conn="";
  function set_message_conn($message){
    $this->message_conn=$message;
  }
  function set_message_ins($message){
    $this->message_ins=$message;
  }
  function Connexion(){
    $error_conn=$this->message_conn;
    $error_ins=$this->message_ins;
    require ('template2.php');
  }
function forgot(){
}
  function launch($methode){
    if ($methode=="connexion"){
      $this->Connexion();
    }
    else{
      $this->forgot();
    }
    //$this->inscription();
    exit();
  }
}
?>
