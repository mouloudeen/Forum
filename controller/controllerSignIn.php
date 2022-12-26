<?php
class  ControllerSignIn extends Controller{
	public function __construct()
  {

  parent::__construct();
  }
  public function login($post,$login)
  {
    if ( $this->model->is_empty($post,$login))//champs vide?
        {
          $this->view->setinfo("*Tous les champs doivent etre remplits",0);
          $this->view->retry_connect_or_create();
          exit();
        }
        if ($this->model->login($post))
        {//verifie si le mot de pass et l'identifiant se correspondent .si oui alors conncetion
          $this->loadParameter($post);
          exit();
        }
        else
        {
         $this->view->setinfo("*Compte non trouvé!",0);
         $this->view->retry_connect_or_create();
         exit();
        }

  }

	}
?>
