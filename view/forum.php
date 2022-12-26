<?php
class Forum{

  private $topics;

  private $page_number;
  private $number_of_pages;

  private $add_topic_title;
  private $add_topic_title_error;
  private $add_topic_content;
  private $add_topic_content_error;

  private $research_content;

  public function addTopics($topics){
    $this->topics = $topics;
  }

  public function addNumberOfPages($number_of_pages){
    $this->number_of_pages = $number_of_pages;
  }
  public function addPageNumber($page_number){
    $this->page_number = $page_number;
  }

  public function addTopicTitle($add_topic_title){
    $this->add_topic_title = $add_topic_title;
  }
  public function addTopicTitleError($add_topic_title_error){
    $this->add_topic_title_error = $add_topic_title_error;
  }
  public function addTopicContent($add_topic_content){
    $this->add_topic_content = $add_topic_content;
  }
  public function addTopicContentError($add_topic_content_error){
    $this->add_topic_content_error = $add_topic_content_error;
  }

  public function addResearchContent($research_content){
    $this->research_content = $research_content;
  }

  public function displayForum()
  {
    $title = 'Forum';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre et recherche

        echo '<div class="col-7 pt-2">';
          echo '<h4>Bienvenue sur le forum <strong>'.$_SESSION["user_last_name"].' '.$_SESSION["user_first_name"].'</strong></h4>';
        echo '</div>';

        echo '<div class="col-5 pt-1">';

          echo '<form action="./" method ="POST" >';
            echo '<div class="form-inline justify-content-center">';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input type="text" class="form-control mr-2" id="research_forum_content" name="research_forum_content" placeholder="Sur le forum" value="">';
              echo '<button name="research_forum_page" type="submit" class="btn btn-secondary" value="1">Rechercher</button>';
            echo '</div>';
          echo '</form>';

        echo '</div>';

      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="your_favorites_page" type="submit" class="btn btn-primary" value="1">Vos favoris</button>';
          echo '</form>';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="your_topics_page" type="submit" class="btn btn-primary" value="1">Vos sujets</button>';
          echo '</form>';

        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="forum_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="forum_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<button name="add_topic" type="submit" class="btn btn-primary">Ajouter un sujet</button>';
          echo '</form>';
        echo '</div>';

      echo '</div>';

      echo '<div class="row pt-2 mt-2">'; //Tableau

        if($this->number_of_pages != 0){
          echo '<div class="col-12">';
              echo '<table class="table table-striped shadow-lg">';
                echo '<thead class="thead-dark">';
                  echo '<tr>';
                    echo '<th scope="col" class="col-6">Sujet</th>';
                    echo '<th scope="col" class="col-1">Auteur</th>';
                    echo '<th scope="col" class="col-1">Messages</th>';
                    echo '<th scope="col" class="col-1">Date</th>';
                    echo '<th scope="col" class="col-3">Actions</th>';
                  echo '</tr>';
                echo '</thead>';

                echo '<tbody>';
                  foreach($this->topics as $topic){
                    echo '<tr>';
                      echo '<th scope="row" class="align-middle">';
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="topic_page" type="hidden" value="1"/>';
                          echo '<button name="topic_id" type="submit" class="btn btn-default" value="'.$topic['ID'].'">'.$topic['titre'].'</button>';
                        echo '</form>';
                      echo '</th>';
                      echo '<td class="align-middle">'.$topic['nom_auteur'].' '.$topic['prenom_auteur'].'</td>';
                      echo '<td class="align-middle">'.$topic['nbr_messages'].'</td>';
                      echo '<td class="align-middle">'.$topic['date_heure'].'</td>';

                      echo '<td class="d-flex justify-content-around">';
                        if($topic['is_favorite'] == false){
                          echo '<form action="./" method ="POST" >';
                            echo '<input name="last_forum_page" type="hidden" value="'.$this->page_number.'"/>';
                            echo '<input name="add_favorite_topic" type="hidden" value="'.$topic['ID'].'"/>';
                            echo '<button name="add_favorite_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Marquer</button>';
                          echo '</form>';
                          echo '<form action="./" method ="POST" >';
                            echo '<input name="forum_signal_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                            echo '<input name="forum_signal_page" type="hidden" value="'.$this->page_number.'"/>';
                            echo '<button name="signal_topic" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Signaler</button>';
                          echo '</form>';
                        }
                        else{
                          echo '<form action="./" method ="POST" >';
                            echo '<input name="forum_signal_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                            echo '<input name="forum_signal_page" type="hidden" value="'.$this->page_number.'"/>';
                            echo '<button name="signal_topic" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Signaler</button>';
                          echo '</form>';
                        }
                      echo '</td>';
                    echo '</tr>';
                  }

                echo '<tbody>';
              echo '</table>';
          echo '</div>';
        }
        else{
          echo '<div class="col-12 p-3 border shadow-lg">';
            echo '<p class="m-0">Il n\'y a pas de sujets sur le forum</p>';
          echo '</div>';
        }

      echo '</div>';

      echo '<div class="row justify-content-center mt-2">'; //Pages

        echo '<div class="col"></div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="forum_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="forum_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="forum_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col"></div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }

  public function displayYourTopics()
  {
    $title = 'Vos Sujets';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre et recherche

        echo '<div class="col-7 pt-2">';
          echo '<h4>Les sujets de <strong>'.$_SESSION["user_last_name"].' '.$_SESSION["user_first_name"].'</strong></h4>';
        echo '</div>';

        echo '<div class="col-5 pt-1">';

          echo '<form action="./" method ="POST" >';
            echo '<div class="form-inline justify-content-center">';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input type="text" class="form-control mr-2" id="research_your_topics_content" name="research_your_topics_content" placeholder="Dans vos sujets" value="">';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-secondary" value="1">Rechercher</button>';
            echo '</div>';
          echo '</form>';

        echo '</div>';

      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="your_favorites_page" type="submit" class="btn btn-primary" value="1">Vos favoris</button>';
          echo '</form>';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="forum_page" type="submit" class="btn btn-primary" value="1">Le Forum</button>';
          echo '</form>';

        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_topics_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<button name="add_topic" type="submit" class="btn btn-primary">Ajouter un sujet</button>';
          echo '</form>';
        echo '</div>';

      echo '</div>';

      echo '<div class="row pt-2 mt-2">'; //Tableau
        if($this->number_of_pages != 0){
          echo '<div class="col-12">';

            echo '<table class="table table-striped shadow-lg">';
              echo '<thead class="thead-dark">';
                echo '<tr>';
                  echo '<th scope="col" class="col-6">Sujet</th>';
                  echo '<th scope="col" class="col-1">Auteur</th>';
                  echo '<th scope="col" class="col-1">Messages</th>';
                  echo '<th scope="col" class="col-1">Date</th>';
                  echo '<th scope="col" class="col-3">Actions</th>';
                echo '</tr>';
              echo '</thead>';

              echo '<tbody>';
                foreach($this->topics as $topic){
                  echo '<tr>';
                    echo '<th scope="row" class="align-middle">';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="topic_page" type="hidden" value="1"/>';
                        echo '<button name="topic_id" type="submit" class="btn btn-default" value="'.$topic['ID'].'">'.$topic['titre'].'</button>';
                      echo '</form>';
                    echo '</th>';
                    echo '<td class="align-middle">'.$topic['nom_auteur'].' '.$topic['prenom_auteur'].'</td>';
                    echo '<td class="align-middle">'.$topic['nbr_messages'].'</td>';
                    echo '<td class="align-middle">'.$topic['date_heure'].'</td>';

                    echo '<td class="d-flex justify-content-around">';
                      if($topic['is_favorite'] == false){
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="last_your_topics_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<input name="add_favorite_topic" type="hidden" value="'.$topic['ID'].'"/>';
                          echo '<button name="add_favorite_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Marquer</button>';
                        echo '</form>';

                        echo '<form action="./" method ="POST" >';
                          echo '<input name="delete_your_topics_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<input name="delete_your_topics_id" type="hidden" value="'.$topic['ID'].'"/>';
                          echo '<button name="delete_your_topics_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Supprimer</button>';
                        echo '</form>';
                      }
                      else{
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="delete_your_topics_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<input name="delete_your_topics_id" type="hidden" value="'.$topic['ID'].'"/>';
                          echo '<button name="delete_your_topics_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Supprimer</button>';
                        echo '</form>';
                      }
                    echo '</td>';
                  echo '</tr>';
                }
              echo '<tbody>';

            echo '</table>';

          echo '</div>';
        }
        else{
          echo '<div class="col-12 p-3 border shadow-lg">';
            echo '<p class="m-0">Vous n\'avez pas de sujets</p>';
          echo '</div>';
        }

      echo '</div>';

      echo '<div class="row justify-content-center mt-2">'; //Pages

        echo '<div class="col"></div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_topics_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_topics_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col"></div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }

  public function displayYourFavorites()
  {
    $title = 'Vos Favoris';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre et recherche

        echo '<div class="col-7 pt-2">';
          echo '<h4>Les favoris de <strong>'.$_SESSION["user_last_name"].' '.$_SESSION["user_first_name"].'</strong></h4>';
        echo '</div>';

        echo '<div class="col-5 pt-1">';

          echo '<form action="./" method ="POST" >';
            echo '<div class="form-inline justify-content-center">';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input type="text" class="form-control mr-2" id="research_your_favorites_content" name="research_your_favorites_content" placeholder="Dans vos favoris" value="">';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-secondary" value="1">Rechercher</button>';
            echo '</div>';
          echo '</form>';

        echo '</div>';

      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="forum_page" type="submit" class="btn btn-primary" value="1">Le Forum</button>';
          echo '</form>';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="your_topics_page" type="submit" class="btn btn-primary" value="1">Vos sujets</button>';
          echo '</form>';

        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_favorites_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<button name="add_topic" type="submit" class="btn btn-primary">Ajouter un sujet</button>';
          echo '</form>';
        echo '</div>';

      echo '</div>';

      echo '<div class="row pt-2 mt-2">'; //Tableau

        if($this->number_of_pages != 0){
          echo '<div class="col-12">';

            echo '<table class="table table-striped shadow-lg">';
              echo '<thead class="thead-dark">';
                echo '<tr>';
                  echo '<th scope="col" class="col-6">Sujet</th>';
                  echo '<th scope="col" class="col-1">Auteur</th>';
                  echo '<th scope="col" class="col-1">Messages</th>';
                  echo '<th scope="col" class="col-1">Date</th>';
                  echo '<th scope="col" class="col-3">Actions</th>';
                echo '</tr>';
              echo '</thead>';

              echo '<tbody>';
                foreach($this->topics as $topic){
                  echo '<tr>';
                    echo '<th scope="row" class="align-middle">';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="topic_page" type="hidden" value="1"/>';
                        echo '<button name="topic_id" type="submit" class="btn btn-default" value="'.$topic['ID'].'">'.$topic['titre'].'</button>';
                      echo '</form>';
                    echo '</th>';
                    echo '<td class="align-middle">'.$topic['nom_auteur'].' '.$topic['prenom_auteur'].'</td>';
                    echo '<td class="align-middle">'.$topic['nbr_messages'].'</td>';
                    echo '<td class="align-middle">'.$topic['date_heure'].'</td>';
                    echo '<td class="d-flex justify-content-around">';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="report_your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                        echo '<input name="report_your_favorites_page" type="hidden" value="'.$this->page_number.'"/>';
                        echo '<button name="report_your_favorites_id" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Signaler</button>';
                      echo '</form>';

                      echo '<form action="./" method ="POST" >';
                        echo '<input name="delete_your_favorites_page" type="hidden" value="'.$this->page_number.'"/>';
                        echo '<input name="delete_your_favorites_id" type="hidden" value="'.$topic['ID'].'"/>';
                        echo '<button name="delete_your_favorites_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Supprimer</button>';
                      echo '</form>';
                    echo '</td>';
                  echo '</tr>';
                }
              echo '<tbody>';

            echo '</table>';

          echo '</div>';
        }
        else{
          echo '<div class="col-12 p-3 border shadow-lg">';
            echo '<p class="m-0">Vous n\'avez pas de favoris</p>';
          echo '</div>';
        }

      echo '</div>';

      echo '<div class="row justify-content-center mt-2">'; //Pages

        echo '<div class="col"></div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_favorites_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<button name="your_favorites_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col"></div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }

  public function displayResearchForum()
  {
    $title = 'Rechercher sur le forum';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre et recherche

        echo '<div class="col-7 pt-2">';
          echo '<h4><strong>'.$_SESSION["user_last_name"].' '.$_SESSION["user_first_name"].'</strong> a recherché sur le forum</h4>';
        echo '</div>';

        echo '<div class="col-5 pt-1">';

          echo '<form action="./" method ="POST" >';
            echo '<div class="form-inline justify-content-center">';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input type="text" class="form-control mr-2" id="research_forum_content" name="research_forum_content" placeholder="" value="'.$this->research_content.'">';
              echo '<button name="research_forum_page" type="submit" class="btn btn-secondary" value="1">Rechercher</button>';
            echo '</div>';
          echo '</form>';

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
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_forum_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<button name="add_topic" type="submit" class="btn btn-primary">Ajouter un sujet</button>';
          echo '</form>';
        echo '</div>';

      echo '</div>';

      echo '<div class="row pt-2 mt-2">'; //Tableau

        if($this->number_of_pages != 0){
          echo '<div class="col-12">';

            echo '<table class="table table-striped shadow-lg">';
              echo '<thead class="thead-dark">';
                echo '<tr>';
                  echo '<th scope="col" class="col-6">Sujet</th>';
                  echo '<th scope="col" class="col-1">Auteur</th>';
                  echo '<th scope="col" class="col-1">Messages</th>';
                  echo '<th scope="col" class="col-1">Date</th>';
                  echo '<th scope="col" class="col-3">Actions</th>';
                echo '</tr>';
              echo '</thead>';

              echo '<tbody>';
                foreach($this->topics as $topic){
                  echo '<tr>';
                    echo '<th scope="row" class="align-middle">';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="topic_page" type="hidden" value="1"/>';
                        echo '<button name="topic_id" type="submit" class="btn btn-default" value="'.$topic['ID'].'">'.$topic['titre'].'</button>';
                      echo '</form>';
                    echo '</th>';
                    echo '<td class="align-middle">'.$topic['nom_auteur'].' '.$topic['prenom_auteur'].'</td>';
                    echo '<td class="align-middle">'.$topic['nbr_messages'].'</td>';
                    echo '<td class="align-middle">'.$topic['date_heure'].'</td>';

                    echo '<td class="d-flex justify-content-around">';
                      if($topic['is_favorite'] == false){
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="add_favorite_research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                          echo '<input name="add_favorite_research_forum_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<input name="add_favorite_research_forum_id" type="hidden" value="'.$topic['ID'].'"/>';
                          echo '<button name="add_favorite_research_forum_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Marquer</button>';
                        echo '</form>';
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="report_research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                          echo '<input name="report_research_forum_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                          echo '<input name="report_research_forum_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<button name="report_research_forum_id" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Signaler</button>';
                        echo '</form>';
                      }
                      else{
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="report_research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                          echo '<input name="report_research_forum_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                          echo '<input name="report_research_forum_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<button name="report_research_forum_id" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Signaler</button>';
                        echo '</form>';
                      }
                    echo '</td>';
                  echo '</tr>';
                }
              echo '<tbody>';

            echo '</table>';

          echo '</div>';
        }
        else{
          echo '<div class="col-12 p-3 border shadow-lg">';
            echo '<p class="m-0">Aucun résultat trouvé sur le forum</p>';
          echo '</div>';
        }

      echo '</div>';

      echo '<div class="row justify-content-center mt-2">'; //Pages

        echo '<div class="col"></div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_forum_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_forum_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_forum_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col"></div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }

  public function displayResearchYourTopics()
  {
    $title = 'Rechercher dans vos sujets';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre et recherche

        echo '<div class="col-7 pt-2">';
          echo '<h4><strong>'.$_SESSION["user_last_name"].' '.$_SESSION["user_first_name"].'</strong> a recherché dans ses sujets</h4>';
        echo '</div>';

        echo '<div class="col-5 pt-1">';

          echo '<form action="./" method ="POST" >';
            echo '<div class="form-inline justify-content-center">';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input type="text" class="form-control mr-2" id="research_your_topics_content" name="research_your_topics_content" placeholder="" value="'.$this->research_content.'">';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-secondary" value="1">Rechercher</button>';
            echo '</div>';
          echo '</form>';

        echo '</div>';

      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="your_topics_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="your_topics_page" type="submit" class="btn btn-primary" value="1">Vos sujets</button>';
          echo '</form>';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="forum_page" type="submit" class="btn btn-primary" value="1">Le Forum</button>';
          echo '</form>';

        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<button name="add_topic" type="submit" class="btn btn-primary">Ajouter un sujet</button>';
          echo '</form>';
        echo '</div>';

      echo '</div>';

      echo '<div class="row pt-2 mt-2">'; //Tableau

        if($this->number_of_pages != 0){
          echo '<div class="col-12">';

            echo '<table class="table table-striped shadow-lg">';
              echo '<thead class="thead-dark">';
                echo '<tr>';
                  echo '<th scope="col" class="col-6">Sujet</th>';
                  echo '<th scope="col" class="col-1">Auteur</th>';
                  echo '<th scope="col" class="col-1">Messages</th>';
                  echo '<th scope="col" class="col-1">Date</th>';
                  echo '<th scope="col" class="col-3">Actions</th>';
                echo '</tr>';
              echo '</thead>';

              echo '<tbody>';
                foreach($this->topics as $topic){
                  echo '<tr>';
                    echo '<th scope="row" class="align-middle">';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="topic_page" type="hidden" value="1"/>';
                        echo '<button name="topic_id" type="submit" class="btn btn-default" value="'.$topic['ID'].'">'.$topic['titre'].'</button>';
                      echo '</form>';
                    echo '</th>';
                    echo '<td class="align-middle">'.$topic['nom_auteur'].' '.$topic['prenom_auteur'].'</td>';
                    echo '<td class="align-middle">'.$topic['nbr_messages'].'</td>';
                    echo '<td class="align-middle">'.$topic['date_heure'].'</td>';

                    echo '<td class="d-flex justify-content-around">';
                      if($topic['is_favorite'] == false){
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="add_favorite_research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                          echo '<input name="add_favorite_research_your_topics_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<input name="add_favorite_research_your_topics_id" type="hidden" value="'.$topic['ID'].'"/>';
                          echo '<button name="add_favorite_research_your_topics_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Marquer</button>';
                        echo '</form>';

                        echo '<form action="./" method ="POST" >';
                          echo '<input name="delete_research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                          echo '<input name="delete_research_your_topics_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<input name="delete_research_your_topics_id" type="hidden" value="'.$topic['ID'].'"/>';
                          echo '<button name="delete_research_your_topics_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Supprimer</button>';
                        echo '</form>';
                      }
                      else{
                        echo '<form action="./" method ="POST" >';
                          echo '<input name="delete_research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                          echo '<input name="delete_research_your_topics_page" type="hidden" value="'.$this->page_number.'"/>';
                          echo '<input name="delete_research_your_topics_id" type="hidden" value="'.$topic['ID'].'"/>';
                          echo '<button name="delete_research_your_topics_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Supprimer</button>';
                        echo '</form>';
                      }
                    echo '</td>';
                  echo '</tr>';
                }
              echo '<tbody>';

            echo '</table>';

          echo '</div>';
        }
        else{
          echo '<div class="col-12 p-3 border shadow-lg">';
            echo '<p class="m-0">Aucun résultat trouvé dans vos sujets</p>';
          echo '</div>';
        }

      echo '</div>';

      echo '<div class="row justify-content-center mt-2">'; //Pages

        echo '<div class="col"></div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_topics_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_topics_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_topics_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col"></div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }

  public function displayResearchYourFavorites()
  {
    $title = 'Rechercher dans vos favoris';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre et recherche

        echo '<div class="col-7 pt-2">';
          echo '<h4><strong>'.$_SESSION["user_last_name"].' '.$_SESSION["user_first_name"].'</strong> a recherché dans ses favoris</h4>';
        echo '</div>';

        echo '<div class="col-5 pt-1">';

          echo '<form action="./" method ="POST" >';
            echo '<div class="form-inline justify-content-center">';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input type="text" class="form-control mr-2" id="research_your_favorites_content" name="research_your_favorites_content" placeholder="" value="'.$this->research_content.'">';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-secondary" value="1">Rechercher</button>';
            echo '</div>';
          echo '</form>';

        echo '</div>';

      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="your_favorites_page" type="submit" class="btn btn-primary" value="1">Vos favoris</button>';
          echo '</form>';

          echo '<form  action="./" method ="POST" >';
            echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="forum_page" type="submit" class="btn btn-primary" value="1">Le Forum</button>';
          echo '</form>';

        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<button name="add_topic" type="submit" class="btn btn-primary">Ajouter un sujet</button>';
          echo '</form>';
        echo '</div>';

      echo '</div>';

      echo '<div class="row pt-2 mt-2">'; //Tableau

        if($this->number_of_pages != 0){
          echo '<div class="col-12">';

            echo '<table class="table table-striped shadow-lg">';
              echo '<thead class="thead-dark">';
                echo '<tr>';
                  echo '<th scope="col" class="col-6">Sujet</th>';
                  echo '<th scope="col" class="col-1">Auteur</th>';
                  echo '<th scope="col" class="col-1">Messages</th>';
                  echo '<th scope="col" class="col-1">Date</th>';
                  echo '<th scope="col" class="col-3">Actions</th>';
                echo '</tr>';
              echo '</thead>';

              echo '<tbody>';
                foreach($this->topics as $topic){
                  echo '<tr>';
                    echo '<th scope="row" class="align-middle">';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="topic_page" type="hidden" value="1"/>';
                        echo '<button name="topic_id" type="submit" class="btn btn-default" value="'.$topic['ID'].'">'.$topic['titre'].'</button>';
                      echo '</form>';
                    echo '</th>';
                    echo '<td class="align-middle">'.$topic['nom_auteur'].' '.$topic['prenom_auteur'].'</td>';
                    echo '<td class="align-middle">'.$topic['nbr_messages'].'</td>';
                    echo '<td class="align-middle">'.$topic['date_heure'].'</td>';
                    echo '<td class="d-flex justify-content-around">';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="report_research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                        echo '<input name="report_research_your_favorites_author" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                        echo '<input name="report_research_your_favorites_page" type="hidden" value="'.$this->page_number.'"/>';
                        echo '<button name="report_research_your_favorites_id" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Signaler</button>';
                      echo '</form>';
                      echo '<form action="./" method ="POST" >';
                        echo '<input name="delete_research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                        echo '<input name="delete_research_your_favorites_page" type="hidden" value="'.$this->page_number.'"/>';
                        echo '<input name="delete_research_your_favorites_id" type="hidden" value="'.$topic['ID'].'"/>';
                        echo '<button name="delete_research_your_favorites_author" type="submit" class="btn btn-secondary" value="'.$_SESSION["user_number"].'">Supprimer</button>';
                      echo '</form>';
                    echo '</td>';
                  echo '</tr>';
                }
              echo '<tbody>';

            echo '</table>';

          echo '</div>';
        }
        else{
          echo '<div class="col-12 p-3 border shadow-lg">';
            echo '<p class="m-0">Aucun résultat trouvé dans vos favoris</p>';
          echo '</div>';
        }

      echo '</div>';

      echo '<div class="row justify-content-center mt-2">'; //Pages

        echo '<div class="col"></div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          if($this->number_of_pages != 0){
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
            echo '</form>';
          }
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
                echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
                echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="research_your_favorites_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
              echo '<input name="research_your_favorites_content" type="hidden" value="'.$this->research_content.'"/>';
              echo '<button name="research_your_favorites_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col"></div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }


  public function displayAddTopicScreen()
  {
    $title = 'Ajouter un sujet sur le forum';

    ob_start();

    echo '<div class="container">';

      echo '<div class="row pt-1 pb-2">'; //Titre
        echo '<div class="col-7 pt-2">';
          echo '<h4><strong>Ajouter un sujet sur le forum</strong></h4>';
        echo '</div>';
      echo '</div>';

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Boutons

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<input name="forum_user" type="hidden" value="'.$_SESSION["user_number"].'"/>';
            echo '<button name="forum_page" type="submit" class="btn btn-primary" value="1">Le Forum</button>';
          echo '</form>';
        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
        echo '</div>';

      echo '</div>';

      echo '<div class="row justify-content-center pt-2 mt-2">'; //Formulaire

        echo '<div class="col-12 pl-5 pr-5 pt-4 pb-4 border shadow-lg">';

          if($this->add_topic_title_error == '' && $this->add_topic_content_error == ''){
            echo '<form  action="./" method ="POST" >';
              echo '<div class="form-row">';
                echo '<label for="topic_title"><strong>Titre du sujet :</strong></label>';
                echo '<input type="text" class="form-control" id="topic_title" name="topic_title" placeholder="" value="'.$this->add_topic_title.'">';
              echo '</div>';

              echo '<div class="form-row mt-4">';
                echo '<label for="topic_content"><strong>Description du sujet :</strong></label>';
                echo '<textarea class="form-control" id="topic_content" name="topic_content" rows="8" placeholder="">'.$this->add_topic_content.'</textarea>';
              echo '</div>';

              echo '<button name="topic_author" type="submit" class="btn btn-primary mt-4" value="'.$_SESSION["user_number"].'">Créer le sujet</button>';

            echo '</form>';
          }
          else if($this->add_topic_title_error != '' && $this->add_topic_content_error == ''){
            echo '<form  action="./" method ="POST" >';
              echo '<div class="form-row">';
                echo '<label for="topic_title"><strong>Titre du sujet :</strong></label>';
                echo '<input type="text" class="form-control is-invalid" id="topic_title" name="topic_title" placeholder="" value="'.$this->add_topic_title.'">';
                echo'<div class="invalid-feedback">';
                  echo $this->add_topic_title_error;
                echo'</div>';
              echo '</div>';

              echo '<div class="form-row mt-4">';
                echo '<label for="topic_content"><strong>Description du sujet :</strong></label>';
                echo '<textarea class="form-control is-valid" id="topic_content" name="topic_content" rows="8" placeholder="">'.$this->add_topic_content.'</textarea>';
                echo'<div class="valid-feedback">';
                  echo 'Votre description est correcte';
                echo'</div>';
              echo '</div>';

              echo '<button name="topic_author" type="submit" class="btn btn-primary mt-4" value="'.$_SESSION["user_number"].'">Créer le sujet</button>';

            echo '</form>';
          }
          else if($this->add_topic_title_error == '' && $this->add_topic_content_error != ''){
            echo '<form  action="./" method ="POST" >';
              echo '<div class="form-row">';
                echo '<label for="topic_title"><strong>Titre du sujet :</strong></label>';
                echo '<input type="text" class="form-control is-valid" id="topic_title" name="topic_title" placeholder="" value="'.$this->add_topic_title.'">';
                echo'<div class="valid-feedback">';
                  echo 'Votre titre est correct';
                echo'</div>';
              echo '</div>';

              echo '<div class="form-row mt-4">';
                echo '<label for="topic_content"><strong>Description du sujet :</strong></label>';
                echo '<textarea class="form-control is-invalid" id="topic_content" name="topic_content" rows="8" placeholder="">'.$this->add_topic_content.'</textarea>';
                echo'<div class="invalid-feedback">';
                  echo $this->add_topic_content_error;
                echo'</div>';
              echo '</div>';

              echo '<button name="topic_author" type="submit" class="btn btn-primary mt-4" value="'.$_SESSION["user_number"].'">Créer le sujet</button>';

            echo '</form>';
          }
          else if($this->add_topic_title_error != '' && $this->add_topic_content_error != ''){
            echo '<form  action="./" method ="POST" >';
              echo '<div class="form-row">';
                echo '<label for="topic_title"><strong>Titre du sujet :</strong></label>';
                echo '<input type="text" class="form-control is-invalid" id="topic_title" name="topic_title" placeholder="" value="'.$this->add_topic_title.'">';
                echo'<div class="invalid-feedback">';
                  echo $this->add_topic_title_error;
                echo'</div>';
              echo '</div>';

              echo '<div class="form-row mt-4">';
                echo '<label for="topic_content"><strong>Description du sujet :</strong></label>';
                echo '<textarea class="form-control is-invalid" id="topic_content" name="topic_content" rows="8" placeholder="">'.$this->add_topic_content.'</textarea>';
                echo'<div class="invalid-feedback">';
                  echo $this->add_topic_content_error;
                echo'</div>';
              echo '</div>';

              echo '<button name="topic_author" type="submit" class="btn btn-primary mt-4" value="'.$_SESSION["user_number"].'">Créer le sujet</button>';

            echo '</form>';
          }

        echo '</div>';

      echo '</div>';

    echo '</div>';

    $content = ob_get_clean();

    require('template.php');
  }

}
?>
