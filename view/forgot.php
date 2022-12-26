<?php
class Forgot extends VIEW{

  function include_forgot()
  {
    $this->message_info();
    echo
    <<<VIEW
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
                    <label for="usr"><font color="black">  Veuillez entrer votre NUMERO PERSONNEL pourque vous puissiez recevoir par mail  vos identifiants"</font></label>
                  </div>

	                <div class="form-group form-check">
                      <label for="usr"><font color="black">Numero Personnel</font></label>
                      <input type="text" class="form-control" id="NP_for" name="NP_CODE">
                  </div>
                  <button type="submit" class="btn btn-primary" name ="forgot">Submit</button>
                </form>
                <p> <a href="./">Retour  l'accueil</a></p>
              </div>
          </div>
        </body>
      </html>
VIEW;
    exit();
  }
}
?>
