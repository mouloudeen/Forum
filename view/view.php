<?php
class View
{
  private $info="";
  private $error_m;

  //Display the home page of the website.
  public function my_website(){
    include_once 'accueil.php';
    $code=new Accueil();
    $code->set_message_conn($this->info);
    $code->Connexion();
    exit();
  }

  function get_info(){
    return $this->info;
  }

  public function setinfo($message ,$error_value){
    $this->info=$message;
    $this->error_m=$error_value;
  }

  //Display the form for the code.
  public  function include_code(){
    $this->message_info();
    include_once 'code.php';
    $code=new Code();
    $code->include_code();
    exit();
  }

  //Display the forgotten ids form.
  public function include_forgot(){
    $this->message_info();
    include 'forgot.php';
    $forgot=new Forgot();
    $forgot->include_forgot();
    exit();
  }

  //Connect to the account.
  function retry_connect_or_create(){
    include_once 'accueil.php';
    $code=new Accueil();
    if ($this->error_m==0){
      $code->set_message_conn($this->info);
    }
    else {
      $code->set_message_ins($this->info);
    }
    $code->Connexion();
    exit();
  }

  //Display the Forum
  public function include_forum($topics, $number_of_pages, $page_number, $alert){
    include_once 'forum.php';
    $forum = new Forum();
    $forum->addTopics($topics);
    $forum->addNumberOfPages($number_of_pages);
    $forum->addPageNumber($page_number);
    $forum->displayForum();
    if($alert != ''){
      echo '<script>alert("'.$alert.'")</script>';
    }
  }

  public function yourTopicsScreen($topics, $number_of_pages, $page_number){
    include_once 'forum.php';
    $forum = new Forum();
    $forum->addTopics($topics);
    $forum->addNumberOfPages($number_of_pages);
    $forum->addPageNumber($page_number);
    $forum->displayYourTopics();
  }

  public function yourFavoritesScreen($topics, $number_of_pages, $page_number, $alert){
    include_once 'forum.php';
    $forum = new Forum();
    $forum->addTopics($topics);
    $forum->addNumberOfPages($number_of_pages);
    $forum->addPageNumber($page_number);
    $forum->displayYourFavorites();
    if($alert != ''){
      echo '<script>alert("'.$alert.'")</script>';
    }
  }

  public function researchForumScreen($topics, $number_of_pages, $page_number, $research_content, $alert){
    include_once 'forum.php';
    $forum = new Forum();
    $forum->addTopics($topics);
    $forum->addNumberOfPages($number_of_pages);
    $forum->addPageNumber($page_number);
    $forum->addResearchContent($research_content);
    $forum->displayResearchForum();
    if($alert != ''){
      echo '<script>alert("'.$alert.'")</script>';
    }
  }

  public function researchYourTopicsScreen($topics, $number_of_pages, $page_number, $research_content){
    include_once 'forum.php';
    $forum = new Forum();
    $forum->addTopics($topics);
    $forum->addNumberOfPages($number_of_pages);
    $forum->addPageNumber($page_number);
    $forum->addResearchContent($research_content);
    $forum->displayResearchYourTopics();
  }

  public function researchYourFavoritesScreen($topics, $number_of_pages, $page_number, $research_content, $alert){
    include_once 'forum.php';
    $forum = new Forum();
    $forum->addTopics($topics);
    $forum->addNumberOfPages($number_of_pages);
    $forum->addPageNumber($page_number);
    $forum->addResearchContent($research_content);
    $forum->displayResearchYourFavorites();
    if($alert != ''){
      echo '<script>alert("'.$alert.'")</script>';
    }
  }

  public function addTopicScreen($add_topic_title, $add_topic_content, $add_topic_title_error, $add_topic_content_error){
    include_once 'forum.php';
    $forum = new Forum();
    $forum->addTopicTitle($add_topic_title);
    $forum->addTopicContent($add_topic_content);
    $forum->addTopicTitleError($add_topic_title_error);
    $forum->addTopicContentError($add_topic_content_error);
    $forum->displayAddTopicScreen();
  }

  public function addMessageScreen($topic, $last_page, $add_message_content, $add_message_content_error, $message_quote){
    include_once 'sujet.php';
    $sujet = new Sujet();
    $sujet->addTopic($topic);
    $sujet->addNumberOfPages($last_page);
    $sujet->addMessageContent($add_message_content);
    $sujet->addMessageContentError($add_message_content_error);
    $sujet->addMessageQuote($message_quote);
    $sujet->displayAddMessageScreen();
  }

  //Display a topic and his messages
  public function include_sujet($topic, $messages, $number_of_pages, $page_number, $alert){
    include_once 'sujet.php';
    $sujet = new Sujet();
    $sujet->addTopic($topic);
    $sujet->addMessages($messages);
    $sujet->addNumberOfPages($number_of_pages);
    $sujet->addPageNumber($page_number);
    $sujet->displayTopic();
    if($alert != ''){
      echo '<script>alert("'.$alert.'")</script>';
    }
  }

  //Display parameters
  public function include_param(){
    include_once 'parameters.php';
    $param = new Parameters();
    $param->displayParameters();
  }

  public function include_param_changed($status){
    include_once 'parameters.php';
    $param = new Parameters();
    $param->setChanged($status);
    $param->displayParameters();
  }

  public function include_param_added($status){
    include_once 'parameters.php';
    $param = new Parameters();
    $param->setAdded($status);
    $param->displayParameters();
  }

  //Display reported messages & topics
  public function includeReports($messages,$number_of_pages,$page_number, $topics, $number_of_pages_t, $page_number_t){
    include_once 'reports.php';
    $reports = new Reports();
    $reports->setMessages($messages);
    $reports->setNumberOfPages($number_of_pages);
    $reports->setPageNumber($page_number);
    $reports->setTopics($topics);
    $reports->setNumberOfPagesT($number_of_pages_t);
    $reports->setPageNumberT($page_number_t);
    $reports->displayReports();
  }

  //Welcome message for an user.
  public function accueil($user){
    echo "<html><h1>".$user." ! Bienvenue  sur ce site <br></html>";
    echo "(page d'accueille à completer !) <br>";
    $this->retour();
  }

  //Back to home page.
  public function retour(){
    echo '<a href="./">Deconnexion</a>';
  }
}
?>
