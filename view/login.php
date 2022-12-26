<?php
class Login extends VIEW{
  function include_login()
  {
    echo <<<VIEW
    <!DOCTYPE html>
<html lang="en">
  <head>
    <title>Monsite</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  </head>

  <body>
    <div class="col-lg-4">
      <div class="container">
        <h2>FORMULAIRE</h2>
        <form  action="./" method ="POST" >
          <div class="form-group form-check">
            <label for="usr"><font color="black">Identifiant</font></label>
            <input type="text" class="form-control" id="usr"  name="identifiant">
          </div>
          <div class="form-group form-check">
            <label for="pwd"><font color="black">Mot de pass:</font></label>
            <input type="password" class="form-control" id="pwd" placeholder="Entrez votre mot de pass" name="pwd">
          </div>
          <button type="submit" class="btn btn-primary" name="login">Connexion</button>
           <p> <a href="./">Retour à l'accueil</a></p>
        </form>
      </div>
    </div>
  </body>
</html>
VIEW;

  }
}
?>
