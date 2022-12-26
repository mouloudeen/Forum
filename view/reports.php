<?php

Class Reports{

    private $messages;
    private $page_number;
    private $number_of_pages;

    private $topics;
    private $page_number_t;
    private $number_of_pages_t;
  
    public function setMessages($messages){
        $this->messages = $messages;
    }

    public function setPageNumber($page_number){
        $this->page_number = $page_number;
    }
    
    public function setNumberOfPages($number_of_pages){
        $this->number_of_pages = $number_of_pages;
    }

    public function setTopics($topics){
        $this->topics = $topics;
    }

    public function setPageNumberT($page_number){
        $this->page_number_t = $page_number;
    }
    
    public function setNumberOfPagesT($number_of_pages){
        $this->number_of_pages_t = $number_of_pages;
    }

    public function displayReports(){
        $title = 'Reports';
        ob_start();

        //HTML
        echo '<div class="container">';
        echo '<div class="row">';
        echo '<h2>Sujets signalés : </h2>';
        echo '</div>';

        echo '<div class="container">';

      

      echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';
        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number_t-1<=4){
            for ($i=1 ; $i<=$this->page_number_t-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
                echo '<button name="report_page_t" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
              echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
              echo '<button name="report_page_t" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number_t-3 ; $i<=$this->page_number_t-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
                echo '<button name="report_page_t" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          echo '<form  action="./" method ="POST" >';
            echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
            echo '<button name="report_page_t" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
          echo '</form>';
          if($this->number_of_pages_t-$this->page_number_t<=4){
            for ($i=$this->page_number_t+1 ; $i<=$this->number_of_pages_t ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
                echo '<button name="report_page_t" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number_t+1 ; $i<=$this->page_number_t+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
                echo '<button name="report_page_t" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
              echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
              echo '<button name="report_page_t" type="submit" class="btn btn-default" value="'.$this->number_of_pages_t.'">'.$this->number_of_pages_t.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          
        echo '</div>';

      echo '</div>';

      echo '<div class="row pt-2 mt-2">'; //Tableau

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
                         echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
                         echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
                         echo '<button name="delete_topic" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Supprimer</button>';
                         echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
                         echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
                         echo '<button name="unreport_topic" type="submit" class="btn btn-secondary" value="'.$topic['ID'].'">Approuver</button>';
                      echo '</form>';    
                      echo '</td>';
                    echo '</tr>';
                  }
                echo '<tbody>';

              echo '</table>';

            echo '</div>';

          echo '</div>';

    echo '</div>';

        //--------------------------REPORTED MESSAGES----------------------------------//

        echo '<div class="row">';
        echo '<h2>Messages signalés : </h2>';
        echo '</div>';

        echo '<div class="container">';


        echo '<div class="row justify-content-center pt-2 pb-2">'; //Pages et boutons

        echo '<div class="col d-flex justify-content-around">';
        echo '</div>';

        echo '<div class="col-5 d-flex justify-content-center">';
          if($this->page_number-1<=4){
            for ($i=1 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
                echo '<button name="report_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            echo '<form  action="./" method ="POST" >';
                echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
              echo '<button name="report_page" type="submit" class="btn btn-default" value="1">1</button>';
            echo '</form>';
            echo '<p class="btn btn-default mb-0">...</p>';
            for ($i=$this->page_number-3 ; $i<=$this->page_number-1 ; $i++){
              echo '<form  action="./" method ="POST" >';
                echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
                echo '<button name="report_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          echo '<form  action="./" method ="POST" >';
            echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
            echo '<button name="report_page" type="submit" class="btn btn-primary" value="'.$i.'">'.$i.'</button>';
          echo '</form>';
          if($this->number_of_pages-$this->page_number<=4){
            for ($i=$this->page_number+1 ; $i<=$this->number_of_pages ; $i++){
              echo '<form  action="./" method ="POST" >';
              echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
                echo '<button name="report_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
          }
          else{
            for ($i=$this->page_number+1 ; $i<=$this->page_number+3 ; $i++){
              echo '<form  action="./" method ="POST" >';
              echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
                echo '<button name="report_page" type="submit" class="btn btn-default" value="'.$i.'">'.$i.'</button>';
              echo '</form>';
            }
            echo '<p class="btn btn-default mb-0">...</p>';
            echo '<form  action="./" method ="POST" >';
            echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
              echo '<button name="report_page" type="submit" class="btn btn-default" value="'.$this->number_of_pages.'">'.$this->number_of_pages.'</button>';
            echo '</form>';
          }
        echo '</div>';

        echo '<div class="col d-flex justify-content-around">';
          echo '<form  action="./" method ="POST" >';
            echo '<input name="last_page_add" type="hidden" value="'.$this->number_of_pages.'"/>';
          echo '</form>';
        echo '</div>';

      echo '</div>';

      while($message = $this->messages->fetch()){ //Messages

        echo '<div class="row justify-content-center mt-3">';

          echo '<div class="col-7 pt-2 pb-2 border shadow-lg">';
            echo '<p class="mb-0"><strong>'.$message['nom_auteur'].' '.$message['prenom_auteur'].'</strong></p>';
          echo '</div>';

          echo '<div class="col-3 d-flex pt-2 justify-content-center border shadow-lg">';
            echo '<p class="mb-0">'.$message['date_heure'].'</p>';
          echo '</div>';

          echo '<div class="col-2">';
          echo '</div>';

        echo '</div>';

        echo '<div class="row justify-content-center">';

          echo '<div class="col-10 pt-3 mb-2 bg-light border shadow-lg">';
            echo '<p>'.$message['contenu'].'</p>';
          echo '</div>';

          echo '<div class="col-2 d-flex justify-content-center align-self-center">';
          echo '<form action="./" method ="POST" >';
            echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
            echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
            echo '<button name="delete_message" type="submit" class="btn btn-secondary" value="'.$message['ID'].'">Supprimer</button>';
          echo '</form>';
          echo '<form action="./" method ="POST" >';
          echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
          echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
            echo '<button name="censor_message" type="submit" class="btn btn-secondary" value="'.$message['ID'].'">Censurer</button>';
          echo '</form>';          
          echo '<form action="./" method ="POST" >';
            echo '<input name="report_page" type="hidden" value="'.$this->page_number.'"/>';
            echo '<input name="report_page_t" type="hidden" value="'.$this->page_number_t.'"/>';
            echo '<button name="unreport_message" type="submit" class="btn btn-secondary" value="'.$message['ID'].'">Approuver</button>';
          echo '</form>';           
       echo '</div>';

        echo '</div>';

      }

    echo '</div>';

        echo '</div>';
        $content = ob_get_clean();
        require('template.php');
    }
}