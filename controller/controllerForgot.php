
<?php
class  ControllerForgot extends Controller{
	public function __construct()
  {
  	parent::__construct();
  }
  public function forgot($post,$forgot)
 {
   if ($this->model->is_empty($post,$forgot)) //if one of the fields is empty then resume
   {
     $this->view->setinfo("*champs du numero est vide veuillez ressayer");
     $this->view->my_website();
   }
   else if ($this->model->exist_np($post['identifiant_forgots'],"user")){ //check if the personal number entered is valid.
     $newpwd=$this->pwd_generate(rand(7,11));//generate a random password
     $this->model->edit_id($post['identifiant_forgots'],$newpwd);//replace the old password with this new one
     $message= "
     Votre mot de passe provisoire est le : ".$newpwd.".
     Vous pouvez le changer une fois connecté, en vous rendant sur la page paramètre.";
     $this->model->send_mail($post['identifiant_forgots'],"VOS IDENTIFIANTS",$message);
     $this->view->setinfo("*Consultez votre boite mail ! Nous avons envoyé vos identifiants",0);
     $this->view->my_website();
     exit();
   }
   else
   {
     $this->view->setinfo("*Numero inconnu !",0);
      $this->view->retry_connect_or_create();
      exit();
   }
 }


}
?>
