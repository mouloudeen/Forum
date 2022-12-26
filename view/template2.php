<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">
    <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    <!-- BootStrap Core -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom style -->
    <link href="css/main.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bas de page -->

    <!-- Script Javascript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="js/vendor/jquery-1.11.3.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script src="js/main.js"></script>
    <script src="js/bootstrap.js"></script>
</head>

<body>
    <!-- Navbar -->
    <div class="navbar navbar-default " role="navigation">
        <div class="container">
            <div>
                <ul class="nav navbar-nav navbar-right">

                  <div class="container">
                  <div class="row">
                    <form method="post" action="./" id="connexion_form">
                    <font color="red"> &emsp;&emsp;&emsp;&emsp;<?=$error_conn ?></br></font>
                      <div class="col-sm-3"></div>
                      <div class="col-sm-3">
                      <font color="white">Identifiant :</font><input type="text" name="identifiant" id="identifiant_con">
                      </div>
                      <div class="col-sm-3">
                      <font color="white">Mot de passe:</font><input type="password" name="pwd" id="pwd">
                      </div>
                      <div class="col-sm-3">
                      <br>
                      <button type="submit" class="btn btn-primary" name="connexion">Connexion</button>
                      </div>
                      <br>
                  </div>
                  <div class="row">
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3"></div>
                  <div class="col-sm-3">
                    <!-- Trigger the modal with a link -->
                    <a href="" rel="modal:open" data-toggle="modal" data-target="#myModal"><font color="white">Identifiants oubliés ?</font></a>

                    <!-- Modal -->
                  </div>
                  </form>
                  <div class="modal fade" id="myModal" role="dialog">
                    <div class="modal-dialog ">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Entrez votre numero personnel </h4>
                        </div>
                        <div class="modal-body">
                          <form method="POST" action=" ./" id="forgot_form"  data-autosubmit>
                              <h1>Entrez votre numero personnal,puis vous recevrez un  mail vous expliquant comment recuperer vos identifiants !  </h1>
                              <h10></h10>
                            <font color="black">Numero personnel:</font><input type="text" name="identifiant_forgots" id="identifiant_forgots">
                            <button type="submit" class="btn btn-primary" name="send_code">Envoyer</button>

                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  </div>
                </ul>
            </div>
        </div>
    </div>
  </div>

    <!-- Introduction -->
    <section id="home" name="home"></section>
    <div id="Introduction">
        <div class="container">
            <h1>Bienvenue sur ce site !</h1>
            <br>
            <form action=" ./" method="post" id="inscription_form" data-autosubmit>
                <font color="red"> &emsp; <?=$error_ins ?> </font>
                <!-- numero personnel  -->
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3 text-left">
                        <label for="code">
                            <font color="white">Numero personnel :</font>
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <input type="integer" id="code" name="code" ></input>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <!--   -->
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3 text-left">
                        <label for="identifiant" >
                            <font color="white">Identifiant :</font>
                        </label>

                    </div>
                    <div class="col-sm-3">
                        <input type="text" id="identifiant" name="identifiant"></input> </br>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <!--   -->
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3 text-left">
                        <label for="pwd1">
                            <font color="white">Mot de passe :</font>
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <input type="password" id="pwd1" name="pwd1" ></input>
                    </div>
                    <div class="col-sm-3"></div>
                </div>
                <!--   -->
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3 text-left">
                        <label for="pwd2">
                            <font color="white">Confirmer le mot de passe :</font>
                        </label>
                    </div>
                    <div class="col-sm-3">
                        <input type="password" id="pwd2" name="pwd2" ></input>
                    </div>
                    <div class="col-sm-3"></div>

                </div>
                <div class="row">
                <br/>
                    <button type="submit"  class="btn btn-primary" name="inscription">Inscription</button>
                </div>
            </form>
            <br>
            <br>
        </div>
    </div>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
    (function(b, o, i, l, e, r) {
        b.GoogleAnalyticsObject = l;
        b[l] || (b[l] =
            function() {
                (b[l].q = b[l].q || []).push(arguments)
            });
        b[l].l = +new Date;
        e = o.createElement(i);
        r = o.getElementsByTagName(i)[0];
        e.src = 'https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e, r)
    }(window, document, 'script', 'ga'));
    ga('create', 'UA-XXXXX-X', 'auto');
    ga('send', 'pageview');
    </script>
    <script>
 $(document).ready(function() {
  $('#inscription_form').submit(function(e) {
    var nb_error=0;
    var identifiant = $('#identifiant').val();
    var code = $('#code').val();
    var pwd1 = $('#pwd1').val();
    var pwd2 = $('#pwd2').val();

    $(".error").remove();
    if (identifiant.length<5 ) {
      nb_error+=1;

      $('#identifiant').before('<span class="error">at least 5 characters required </span>');
    }
    if (identifiant.length >40) {
      nb_error+=1;

      $('#identifiant').before('<span class="error"> max char 40</span>');
    }
    if (code.length !=6) {
        nb_error+=1;

        $('#code').before('<span class="error"> The personnal number is invalid</span>');
    }
    if (pwd1.length <6) {
        nb_error+=1;

      $('#pwd1').before('<span class="error"> insufficient password</span>');
    }
    if (pwd2.length <6) {
        nb_error+=1;

        $('#pwd2').before('<span class="error">insufficient password</span>');
    }
    if (pwd1.length >6  && pwd2.length >6  && pwd1 !=pwd2) {
        nb_error+=1;

      $('#pwd2').after('<span class="error">the two passwords are differents </span>');
    }
    if (nb_error!=0){
      //s'il  y a au moins une erreur , il n'envoie pas les données
      e.preventDefault();
    }


  });
  $('#connexion_form').submit(function(e) {
    var nb_error2=0;
    var identifiant = $('#identifiant_con').val();
    var pwd = $('#pwd').val();
    $(".error").remove();
    if (identifiant.length<5) {
      nb_error2+=1;
      $('#identifiant_con').after('<span class="error">least 5 characters required </span>');
    }
    if (identifiant.length >40) {
      nb_error2+=1;
      $('#identifiant_con').after('<span class="error"> max char 10</span>');
    }
    if (pwd.length <6) {
        nb_error2+=1;
      $('#pwd').after('<span class="error"> insufficient password</span>');
    }
    if (nb_error2!=0){
      //s'il  y a au moins une erreur , il n'envoie pas les données
      e.preventDefault();
    }


  });
  $('#forgot_form').submit(function(e) {
    var nb_error3=0;
    var numero = $('#identifiant_forgots').val();

    $(".error").remove();
    if (numero.length !=6) {
      nb_error3+=1;
      $('h10').after('<span class="error">The number must contain exactly six characters <br></span>');
    }
    if (nb_error3!=0){
      //s'il  y a au moins une erreur , il n'envoie pas les données
      e.preventDefault();
    }


  });

});
</script>
</body>

</html>
