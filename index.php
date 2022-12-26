<?php
  if (!isset($_SESSION)) session_start();
  include_once 'controller/controller.php';
  include_once 'controller/controllerSignIn.php';
  include_once 'controller/controllerSignUp.php';
   include_once 'controller/controllerForgot.php';
  $controller = new Controller();

  if(!$_POST)
  {
    $controller->launch();//lance la page d'accueil
  }
  else
  {
    if (isset($_POST['connexion']))//recuperation et redirection du formulaire de connection
    {
      $controllerlog = new ControllerSignIn();
      $controllerlog->login($_POST,'connexion');
    }
    if(isset($_POST['disconnect'])){
      session_destroy();
      header("Location: index.php");
    }
    if (isset($_POST['inscription']))// recuperation et redirection du formulaire de creation du compte
    {
      $controllerIns = new ControllerSignUp();
      $controllerIns->create($_POST,'inscription');
    }
    if (isset($_POST['forgot'])) // recuperation et redirection du formulaire en cas d'oublie d'identifiants
    {
      $controller->forgot($_POST,'forgot');
    }
    if (isset($_POST['active'])) // recuperation et redirection  redirige vers  le formulaire de creation du compte
    {
      $controller->code($_POST,'active');
    }
    if (isset($_POST['send_code']))
    {
    	$controllerforg = new ControllerForgot();
        $controllerforg->forgot($_POST,'send_code');
    }

    //For the Forum
    if(isset($_POST['forum_page']) && isset($_POST['forum_user'])){
      $controller->forum($_POST, 'consult');
    }

    //For your_topics
    if(isset($_POST['your_topics_page']) && isset($_POST['your_topics_author'])){
      $controller->forum($_POST, 'consult_your_topics');
    }
    if(isset($_POST['delete_your_topics_id']) && isset($_POST['delete_your_topics_page']) && isset($_POST['delete_your_topics_author'])){
      $controller->forum($_POST, 'delete_your_topics');
    }
    if(isset($_POST['delete_research_your_topics_content']) && isset($_POST['delete_research_your_topics_page']) && isset($_POST['delete_research_your_topics_id']) && isset($_POST['delete_research_your_topics_author'])){
      $controller->forum($_POST, 'delete_research_your_topics');
    }

    //For favorites
    if(isset($_POST['your_favorites_page']) && isset($_POST['your_favorites_author'])){
      $controller->forum($_POST, 'consult_your_favorites');
    }
    if(isset($_POST['add_favorite_author']) && isset($_POST['add_favorite_topic']) && (isset($_POST['last_forum_page']) || isset($_POST['last_your_topics_page']))){
      $controller->forum($_POST, 'add_favorite');
    }
    if(isset($_POST['add_favorite_research_forum_content']) && isset($_POST['add_favorite_research_forum_page']) && isset($_POST['add_favorite_research_forum_id']) && isset($_POST['add_favorite_research_forum_author'])){
      $controller->forum($_POST, 'add_favorite_research_forum');
    }
    if(isset($_POST['add_favorite_research_your_topics_content']) && isset($_POST['add_favorite_research_your_topics_page']) && isset($_POST['add_favorite_research_your_topics_id']) && isset($_POST['add_favorite_research_your_topics_author'])){
      $controller->forum($_POST, 'add_favorite_research_your_topics');
    }
    if(isset($_POST['report_your_favorites_page']) && isset($_POST['report_your_favorites_author']) && isset($_POST['report_your_favorites_id'])){
      $controller->forum($_POST, 'report_your_favorites');
    }
    if(isset($_POST['delete_your_favorites_id']) && isset($_POST['delete_your_favorites_page']) && isset($_POST['delete_your_favorites_author'])){
      $controller->forum($_POST, 'delete_your_favorites');
    }
    if(isset($_POST['delete_research_your_favorites_content']) && isset($_POST['delete_research_your_favorites_page']) && isset($_POST['delete_research_your_favorites_id']) && isset($_POST['delete_research_your_favorites_author'])){
      $controller->forum($_POST, 'delete_research_your_favorites');
    }


    //For research
    if(isset($_POST['research_forum_content']) && isset($_POST['research_forum_page']) && isset($_POST['research_forum_user'])){
      $controller->forum($_POST, 'research_forum');
    }
    if(isset($_POST['report_research_forum_content']) && isset($_POST['report_research_forum_author']) && isset($_POST['report_research_forum_page']) && isset($_POST['report_research_forum_id'])){
      $controller->forum($_POST, 'report_research_forum');
    }
    if(isset($_POST['research_your_topics_content']) && isset($_POST['research_your_topics_page']) && isset($_POST['research_your_topics_user'])){
      $controller->forum($_POST, 'research_your_topics');
    }
    if(isset($_POST['research_your_favorites_content']) && isset($_POST['research_your_favorites_page']) && isset($_POST['research_your_favorites_user'])){
      $controller->forum($_POST, 'research_your_favorites');
    }
    if(isset($_POST['report_research_your_favorites_content']) && isset($_POST['report_research_your_favorites_author']) && isset($_POST['report_research_your_favorites_page']) && isset($_POST['report_research_your_favorites_id'])){
      $controller->forum($_POST, 'report_research_your_favorites');
    }


    //For topics
    if(isset($_POST['topic_id']) && isset($_POST['topic_page'])){
      $controller->topic($_POST, 'consult');
    }
    if(isset($_POST['add_topic'])) {
      $controller->topic($_POST, 'add_topic');
    }
    if(isset($_POST['topic_title']) && isset($_POST['topic_content']) && isset($_POST['topic_author'])){
      $controller->topic($_POST, 'create_topic');
    }

    //For messages
    if(isset($_POST['message_topic_add']) && isset($_POST['last_page_add'])) { //$_POST['message_quote_id'] (optionnel)
      $controller->message($_POST, 'add_message');
    }
    if(isset($_POST['message_content']) && isset($_POST['message_author']) && isset($_POST['message_topic_post']) && isset($_POST['last_page_post'])) { //$_POST['message_quote_id'] (optionnel)
      $controller->message($_POST, 'post_message');
    }

    //For parameters
    if(isset($_POST['param'])){
      $controller->displayParam();
    }

    if(isset($_POST['old_pwd']) && isset($_POST['pwd1']) && isset($_POST['pwd2'])){
      $controller->changePwd($_POST['old_pwd'], $_POST['pwd1'], $_POST['pwd2']);
    }

    if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['mail']) && isset($_POST['numero'])){
      $controller->addStudent($_POST['name'], $_POST['surname'], $_POST['mail'], $_POST['numero']);
    }

    //For reports
    if(isset($_POST['report_page']) && isset($_POST['report_page_t']) && !isset($_POST['delete_topic']) && !isset($_POST['delete_message']) && !isset($_POST['unreport_message']) && !isset($_POST['unreport_topic']) && !isset($_POST['censor_message'])){
      $controller->displayReports($_POST['report_page'], $_POST['report_page_t']);
    }

    if(isset($_POST['delete_topic']) && isset($_POST['report_page']) && isset($_POST['report_page_t'])){
      $controller->deleteTopic($_POST['delete_topic']);
      $controller->displayReports($_POST['report_page'], $_POST['report_page_t']);
    }

    if(isset($_POST['delete_message']) && isset($_POST['report_page']) && isset($_POST['report_page_t'])){
      $controller->deleteMessage($_POST['delete_message']);
      $controller->displayReports($_POST['report_page'], $_POST['report_page_t']);
    }

    if(isset($_POST['unreport_message']) && isset($_POST['report_page']) && isset($_POST['report_page_t'])){
      $controller->unSignalMessage($_POST['unreport_message']);
      $controller->displayReports($_POST['report_page'], $_POST['report_page_t']);
    }

    if(isset($_POST['unreport_topic']) && isset($_POST['report_page']) && isset($_POST['report_page_t'])){
      $controller->unSignalTopic($_POST['unreport_topic']);
      $controller->displayReports($_POST['report_page'], $_POST['report_page_t']);
    }

    if(isset($_POST['signal_topic']) && isset($_POST['forum_signal_page']) && isset($_POST['forum_signal_user'])){
      $controller->signalTopicRedirect($_POST);
    }

    if(isset($_POST['signal_message']) && isset($_POST['topic_signal_page']) && isset($_POST['topic_signal_id'])){
      $controller->signalMessageRedirect($_POST);
    }

    if(isset($_POST['censor_message']) && isset($_POST['report_page']) && isset($_POST['report_page_t'])){
      $controller->censorMessage($_POST['censor_message']);
      $controller->displayReports($_POST['report_page'], $_POST['report_page_t']);
    }
  }
  ?>
