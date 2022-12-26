< ?php
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
?>
