<?php
class Sujet{

  private $topic;
  private $messages;

  private $page_number;
  private $number_of_pages;

  private $add_message_content;
  private $add_message_content_error;

  private $message_quote;

  public function addTopic($topic){
    $this->topic = $topic->fetch();
  }
  public function addMessages($messages){
    $this->messages = $messages;
  }

  public function addNumberOfPages($number_of_pages){
    $this->number_of_pages = $number_of_pages;
  }
  public function addPageNumber($page_number){
    $this->page_number = $page_number;
  }

  public function addMessageContent($add_message_content){
    $this->add_message_content = $add_message_content;
  }
  public function addMessageContentError($add_message_content_error){
    $this->add_message_content_error = $add_message_content_error;
  }

  public function addMessageQuote($message_quote){
    $this->message_quote = $message_quote;
  }

  public function displayTopic()
  {
    $title = 'Sujet';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre
        echo '<div class="col-7 pt-2">';
          if($this->topic == false){
            echo '<h4><strong>Une erreur s\'est produite</strong></h4>';
          }
          else{
            echo '<h4><strong>'.$this->topic['titre'].'</strong></h4>';
          }
        echo '</div>';
      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="forum_page" type="submit" class="btn btn-primary" value="1">Le Forum</button>';
          echo '</form>';
        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->topic != false){
            if($this->page_number-1<=4){
              for ($i=1 ; $i<=$this->page_number-1 ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
            }
            else{
              echo '<form  action="./" method ="POST" >';
                echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                echo '<button name="topic_page" type="submit" class="btn btn-default" value="1">1</button>';
              echo '</form>';
              echo '<p class="btn btn-default mb-0">...</p>';
              for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
            }
            echo '<form  action="./" method ="POST" >';
              echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
              echo '<button name="topic_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
            if($this->number_of_pages-$this->page_number<=4){
              for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
            }
            else{
              for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
              echo '<p class="btn btn-default mb-0">...</p>';
              echo '<form  action="./" method ="POST" >';
                echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
              echo '</form>';
            }
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          if($this->topic != false){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="last_page_add" type="hidden" value="'.($this->number_of_pages + 1).'"/>';
              echo '<button name="message_topic_add" type="submit" class="btn btn-primary" value="'.$this->topic['ID'].'">Ajouter un message</button>';
            echo '</form>';
          }
        echo '</div>';

      echo '</div>';

      if($this->topic == false){
        echo '<div class="row justify-content-center mb-4 mt-3">';
          echo '<div class="col-12 p-3 border shadow-lg">';
            echo '<p class="m-0">Le sujet auquel vous essayez d\'accéder est introuvable, il a peut être été supprimé</p>';
          echo '</div>';
        echo '</div>';
      }
      else{
        if($this->number_of_pages != 0){
          foreach ($this->messages as $message){ //Messages
            echo '<div class="row justify-content-center mb-4 mt-3">';

              echo '<div class="col-10 shadow-lg">';

                echo '<div class="row justify-content-center bg-white">';
                  echo '<div class="col-8 pt-2 pb-2 border">';
                    echo '<p class="mb-0"><strong>'.$message['nom_auteur'].' '.$message['prenom_auteur'].'</strong></p>';
                  echo '</div>';

                  echo '<div class="col-4 d-flex pt-2 justify-content-center border">';
                    echo '<p class="mb-0">'.$message['date_heure'].'</p>';
                  echo '</div>';
                echo '</div>';

                echo '<div class="row justify-content-center">';
                  echo '<div class="col-12 pt-3 bg-light border">';
                    if($message['citations'] != NULL){
                      foreach ($message['citations'] as $quote) {
                        echo '<div class="col-11 mb-3">';

                          echo '<div class="row justify-content-center bg-white">';
                            echo '<div class="col-8 pt-2 pb-2 border">';
                              echo '<p class="mb-0"><strong>'.$quote['nom_auteur'].' '.$quote['prenom_auteur'].'</strong></p>';
                            echo '</div>';

                            echo '<div class="col-4 d-flex pt-2 justify-content-center border">';
                              echo '<p class="mb-0">'.$quote['date_heure'].'</p>';
                            echo '</div>';
                          echo '</div>';

                          echo '<div class="row justify-content-center">';
                            echo '<div class="col-12 pt-3 border">';
                              echo '<p>'.$quote['contenu'].'</p>';
                            echo '</div>';
                          echo '</div>';

                        echo '</div>';
                      }
                    }

                    echo '<p>'.$message['contenu'].'</p>';

                  echo '</div>';
                echo '</div>';

              echo '</div>';

              echo '<div class="col-2 pl-4 pr-4 pt-2 flex-column">';

                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_signal_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<input name="topic_signal_page" type="hidden" value="'.$this->page_number.'"/>';
                  echo '<button name="signal_message" type="submit" class="btn btn-secondary mb-2" value="'.$message['ID'].'">Signaler</button>'; // ou supprimer
                echo '</form>';

                echo '<form  action="./" method ="POST" >';
                  echo '<input name="last_page_add" type="hidden" value="'.($this->number_of_pages + 1).'"/>';
                  echo '<input name="message_topic_add" type="hidden" value="'.$this->topic['ID'].'">';
                  echo '<button name="message_quote_id" type="submit" class="btn btn-secondary" value='.$message['ID'].'">Citer</button>';
                echo '</form>';

              echo '</div>';

            echo '</div>';
          }
        }
        else{
          echo '<div class="col-12 p-3 mt-3 border shadow-lg">';
            echo '<p class="m-0">Ce sujet ne contient pas de messages</p>';
          echo '</div>';
        }
      }

      echo '<div class="row justify-content-center mt-3">'; //Pages

        echo '<div class="col"></div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->topic != false){
            if($this->page_number-1<=4){
              for ($i=1 ; $i<=$this->page_number-1 ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
            }
            else{
              echo '<form  action="./" method ="POST" >';
                echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                echo '<button name="topic_page" type="submit" class="btn btn-default" value="1">1</button>';
              echo '</form>';
              echo '<p class="btn btn-default">...</p>';
              for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
            }
            echo '<form  action="./" method ="POST" >';
              echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
              echo '<button name="topic_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
            if($this->number_of_pages-$this->page_number<=4){
              for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
            }
            else{
              for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
                echo '<form  action="./" method ="POST" >';
                  echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                  echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
                echo '</form>';
              }
              echo '<p class="btn btn-default">...</p>';
              echo '<form  action="./" method ="POST" >';
                echo '<input name="topic_id" type="hidden" value="'.$this->topic['ID'].'"/>';
                echo '<button name="topic_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
              echo '</form>';
            }
          }
        echo '</div>';

        echo '<div class="col"></div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }

  public function displayAddMessageScreen()
  {
    $title = 'Ajouter un message';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre
        echo '<div class="col-7 pt-2">';
          echo '<h4><strong>'.$this->topic['titre'].'</strong></h4>';
        echo '</div>';
      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Boutons

        echo '<div class="col d-flex justify-content-around">';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="forum_page" type="submit" class="btn btn-primary" value="1">Le Forum</button>';
          echo '</form>';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="topic_page" type="hidden" value="1"/>';
            echo '<button name="topic_id" type="submit" class="btn btn-primary" value="'.$this->topic['ID'].'">Les messages</button>';
          echo '</form>';

        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
        echo '</div>';

      echo '</div>';

      echo '<div class="row justify-content-center pt-2 mt-2">'; //Formulaire

        echo '<div class="col-12 pl-5 pr-5 pt-4 pb-4 border shadow-lg">';
          if($this->message_quote != ''){

            echo '<p class="form-row"><strong>Message cité :</strong></p>';

            echo '<div class="col-11 mb-4">';

              echo '<div class="row justify-content-center bg-white">';
                echo '<div class="col-8 pt-2 pb-2 border">';
                  echo '<p class="mb-0"><strong>'.$this->message_quote['nom_auteur'].' '.$this->message_quote['prenom_auteur'].'</strong></p>';
                echo '</div>';

                echo '<div class="col-4 d-flex pt-2 justify-content-center border">';
                  echo '<p class="mb-0">'.$this->message_quote['date_heure'].'</p>';
                echo '</div>';
              echo '</div>';

              echo '<div class="row justify-content-center">';
                echo '<div class="col-12 pt-3 bg-light border">';
                  if($this->message_quote['citations'] != NULL){
                    foreach ($this->message_quote['citations'] as $quote) {
                      echo '<div class="col-11 mb-3">';

                        echo '<div class="row justify-content-center bg-white">';
                          echo '<div class="col-8 pt-2 pb-2 border">';
                            echo '<p class="mb-0"><strong>'.$quote['nom_auteur'].' '.$quote['prenom_auteur'].'</strong></p>';
                          echo '</div>';

                          echo '<div class="col-4 d-flex pt-2 justify-content-center border">';
                            echo '<p class="mb-0">'.$quote['date_heure'].'</p>';
                          echo '</div>';
                        echo '</div>';

                        echo '<div class="row justify-content-center">';
                          echo '<div class="col-12 pt-3 border">';
                            echo '<p>'.$quote['contenu'].'</p>';
                          echo '</div>';
                        echo '</div>';

                      echo '</div>';
                    }
                  }
                  echo '<p>'.$this->message_quote['contenu'].'</p>';
                echo '</div>';
              echo '</div>';

            echo '</div>';
          }
          if($this->add_message_content_error == ''){
            echo '<form  action="./" method ="POST" >';

              echo '<div class="form-row">';
                echo '<label for="message_content"><strong>Ecrivez votre message :</strong></label>';
                echo '<textarea class="form-control" id="message_content" name="message_content" rows="8" placeholder="">'.$this->add_message_content.'</textarea>';
                echo '<input name="message_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="last_page_post" type="hidden" value="'.$this->number_of_pages.'"/>';
                if($this->message_quote != ''){
                  echo '<input name="message_quote_id" type="hidden" value="'.$this->message_quote['ID'].'"/>';
                }
              echo '</div>';

              echo '<button name="message_topic_post" type="submit" class="btn btn-primary mt-4" value="'.$this->topic['ID'].'">Poster le message</button>';

            echo '</div>';
          }
          else if($this->add_message_content_error != ''){
            echo '<form  action="./" method ="POST" >';

              echo '<div class="form-row">';
                echo '<label for="message_content"><strong>Ecrivez votre message :</strong></label>';
                echo '<textarea class="form-control is-invalid" id="message_content" name="message_content" rows="8" placeholder="">'.$this->add_message_content.'</textarea>';
                echo '<input name="message_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="last_page_post" type="hidden" value="'.$this->number_of_pages.'"/>';
                if($this->message_quote != ''){
                  echo '<input name="message_quote_id" type="hidden" value="'.$this->message_quote['ID'].'"/>';
                }
                echo'<div class="invalid-feedback">';
                  echo $this->add_message_content_error;
                echo'</div>';
              echo '</div>';

              echo '<button name="message_topic_post" type="submit" class="btn btn-primary mt-4" value="'.$this->topic['ID'].'">Poster le message</button>';

            echo '</div>';
          }

        echo '</div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }
}
?>
