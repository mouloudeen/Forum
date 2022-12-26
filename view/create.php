<?php
class Create extends VIEW{

  function include_create()
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
        <form  action=" ./" method ="POST" >
          <div class="form-group form-check">
            <p></p>
            <label for="usr"><font color="black">Identifiant</font></label>
            <input type="text" class="form-control" placeholder="Entrez un identifiant" id="usr" name="identifiant">
            <label for="usr"><font color="black">Numero personnel</font></label>
            <input type="text" class="form-control" placeholder="EX:0000001" id="code" name="code">
            <label for="pwd"><font color="black">Mot de pass:</font></label>
            <input type="password" class="form-control" id="pwd" placeholder="Entrez un mot de pass" name="pwd1">
            <label for="pwd"><font color="black">confirmer votre Mot de pass:</font></label>
            <input type="password" class="form-control" id="pwd" placeholder="confirmez votre mot de pass" name="pwd2">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" name="remember"> Se souvenir de moi
            </label>
          </div>
          <button type="submit" class="btn btn-primary" name="create">Submit</button>
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
