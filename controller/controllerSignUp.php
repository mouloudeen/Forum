<?php
class ControllerSignUp extends Controller{
	public function __construct()
  {

  parent::__construct();
  }
  public function create($post,$create)
  {
     //verifier que tous les champs sont remplis
     if ( $this->model->is_empty($post,$create))
     {
       $this->view->setinfo("*Tous les champs doivent etre remplits",1);
       $this->view->retry_connect_or_create();
       exit();
     }

      //verfier que les deux mot de passes ne sont pas differents
     else if ($this->model->diff_pwds($post))
     {
       $this->view->setinfo("*Les deux mots de passes sont differents",1);
       $this->view->retry_connect_or_create();
       exit();
     }
     //verifier que l'identifiant n'est pas utiliser par une autre personne
     else if ($this->model->user($post['identifiant']))
     {
       $this->view->setinfo("*identifiant deja utilisé",1);
       $this->view->retry_connect_or_create();
       exit();
     }
     // verifier le numero personnel saisi  existe dans base de données,sinon c'est faux numero
     else if (!$this->model->exist_np($post['code'],"infos"))
     {//s'il daje dans la table user alors il est deja utiliser par quelqu'un d'autres
       $this->view->setinfo("*Numero personnel inconnu",1);
       $this->view->retry_connect_or_create();
       exit();
     }
     //verifier qu'il n y ait pas deja un autre compte avec le numero personnel
     else if ($this->model->exist_np($post['code'],"user"))
     {//s'il daje dans la table user alors il est deja utiliser par quelqu'un d'autres
       $this->view->setinfo("*Un compte avec ce numero existe déja",1);
         $this->view->retry_connect_or_create();
       exit();
     }
    //si tout est normal alors on enregistre les données dans la BD
     else
     {
       $this->model->save_user($post);
     //  $this->view->accueil( $this->model->name_identifiant($post['identifiant']));
    	$this->loadParameter($post);
       exit();
     }

  }

	}
?>
