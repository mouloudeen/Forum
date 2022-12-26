<?php

Class Parameters{

    private $changed;

    private $student_added;

    public function setChanged($bool){
        $this->changed = $bool;
    }

    public function setAdded($value){
        $this->student_added = $value;
    }

    public function displayParameters(){
        $title = 'Parameters';
        ob_start();

        //HTML :

        echo '<div class="container">';
        echo '<div class="row">';
        echo '<h1> Changer de mot de passe : </h1>';
        echo '</div>';

        echo '<form  action="./" method ="POST" >';

        echo '<div class="row">';
        echo '<div class="col-sm">';
        echo '<span class="input-group-addon">Ancien mot de passe</span>';
        echo '<input id="old_pwd" type="password" class="form-control" name="old_pwd" placeholder="Ancien mot de passe">';
        echo '<hr />';
        echo '</div>';
        echo '</div>';

        echo '<div class="row">';
        echo '<div class="col-sm">';
        echo '<span class="input-group-addon">Nouveau mot de passe</span>';
        echo '<input id="pwd1" type="password" class="form-control" name="pwd1" placeholder="Nouveau mot de passe">';
        echo '</div>';
        echo '</div>';

        echo '<div class="row">';
        echo '<div class="col-sm">';
        echo '<span class="input-group-addon">Confirmation</span>';
        echo '<input id="pwd2" type="password" class="form-control" name="pwd2" placeholder="Nouveau mot de passe">';
        echo '</div>';
        echo '</div>';
        echo '</br>';


        if($this->changed == 'success'){
            echo '</br>';
            echo '<div class="alert alert-success"> Mot de passe changé </div>';
        }else if($this->changed == 'fail_new_pwd'){
            echo '</br>';
            echo '<div class="alert alert-danger"> Vous avez mal entré la confirmation de votre mot de passe. </div>';
        }else if($this->changed == 'fail_old_pwd'){
            echo '</br>';
            echo '<div class="alert alert-danger"> Vous avez mal entré votre ancien mot de passe. </div>';
        }

        echo '<div class="row">';
        echo '<div class="col-sm-4"></div>';
        echo '<div class="col-sm-8">';
        echo '<button type="submit" class="btn btn-primary">Confirmer</button>';
        echo '</div>';


        echo '</form>';

        echo '</div>';

        echo '<hr />';

        if($_SESSION['admin']){
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<h1> Ajouter un élève :  </h1>';
            echo '</div>';

            echo '<form  action="./" method ="POST" >';
            echo '<div class="row">';
            echo '<div class="col-sm">';
            echo '<span class="input-group-addon">Nom</span>';
            echo '<input id="name" type="text" class="form-control" name="name" placeholder="Nom">';
            echo '</div>';
            echo '</div>';
    
            echo '<div class="row">';
            echo '<div class="col-sm">';
            echo '<span class="input-group-addon">Prénom</span>';
            echo '<input id="surname" type="text" class="form-control" name="surname" placeholder="Prénom">';
            echo '</div>';
            echo '</div>';
    
            echo '<div class="row">';
            echo '<div class="col-sm">';
            echo '<span class="input-group-addon">Adresse mail</span>';
            echo '<input id="mail" type="text" class="form-control" name="mail" placeholder="Adresse mail">';
            echo '</div>';
            echo '</div>';

            echo '<div class="row">';
            echo '<div class="col-sm">';
            echo '<span class="input-group-addon">Numéro</span>';
            echo '<input id="numero" type="text" class="form-control" name="numero" placeholder="Numéro">';
            echo '</div>';
            echo '</div>';
            echo '</br>';
            
            
            if($this->student_added == 'success'){
                echo '</br>';
                echo '<div class="alert alert-success"> élève ajouté </div>';
            }else if($this->student_added == 'error') {
                echo '</br>';
                echo '<div class="alert alert-danger"> Il y a eu une erreur lors de l\'ajout. </div>';
            }
    
            echo '<div class="row">';
            echo '<div class="col-sm-4"></div>';
            echo '<div class="col-sm-8">';
            echo '<button type="submit" class="btn btn-primary">Confirmer</button>';
            echo '</div>';
            echo '</form>';

        }else{
            //Not admin
        }

        $content = ob_get_clean();
        require('template.php');
    }

}