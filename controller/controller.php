<?php
class Controller
{
  protected $view;//attribut pour la classe view
  protected $model;//attribut pour la classe Model

  /* le constructeur prend un seul parametre.
  $value qui est un booleen qui est true pour dire que les pages qu'on veut inclure ne pas  vient pas de view ou model et false sinon */
  public function __construct()
  {
    include_once 'view/view.php';
    include_once 'model/model.php';
    $this->view = new View();
    $this->model = new Model();
  }

  public function launch()
  {
    $this->view->my_website();
  }
  /*cette fonction verifie que le numero personnel entrer est correcte avant de le sumettre.
  le param $post est le tableau $_POST qu'il faut tester pour la validité .
  le param $submit :indice 'submit' dans $_POST
  */
  function code($post,$submit)
  {
    if ($this->model->is_empty($post,$submit))
    {//si l'un des champs est vide alors reprendre
      $this->view->setinfo("*champs du numero est vide veuillez ressayer");
      $this->view->include_code();
    }
    else if ($this->model->exist_np($post['NP_CODE'],"infos"))
    { //verifie si le numero personnel saisi est valable .Si oui alors il redirige vers l'inscription
      $this->view->setinfo("*Remplissez ce formulaire avec votre numero personnel");
      $this->view->include_create();
      exit();
    }
    else
    {
      $this->view->setinfo("*Ce numero personnel n'existe pas.Ressayer");
      $this->view->include_code();
    }

  }

//load account information from user and connect him
  function loadParameter($post){
    $_SESSION["login"] = $post['identifiant'];
    $_SESSION["user_number"] = $this->model->getNumber($post['identifiant']);
    $_SESSION["user_last_name"] = $this->model->getLastName($_SESSION["user_number"]);
    $_SESSION["user_first_name"] = $this->model->getFirstName($_SESSION["user_number"]);

    //verify if the account is the admin, if so store it in the session
    if($this->isAdmin()){
      $_SESSION["admin"] = true;
    }else{
      $_SESSION["admin"] = false;
    }

    $post['forum_page'] = 1;
    $post['forum_user'] = $_SESSION["user_number"];
    $this->forum($post,'consult');
  }

  function pwd_generate($nb_car, $chaine = 'azertyuiopqsdfghjklmwxcvbn123456789')
{
    $nb_lettres = strlen($chaine) - 1;
    $generation = '';
    for($i=0; $i < $nb_car; $i++)
    {
        $pos = mt_rand(0, $nb_lettres);
        $car = $chaine[$pos];
        $generation .= $car;
    }
    return $generation;
}
  //charger de renvoyer les identifiant   par mail


  public function forum($post, $action){
    if($action == "consult"){//POST(forum_page, forum_user, forum_alert (optionnel))
      $topics_per_page = 2;
      $number_of_topics = $this->model->getNumberOfTopics();
      $number_of_pages = ceil($number_of_topics/$topics_per_page);
      $topics = $this->model->getTopics($topics_per_page, $post['forum_page'], $post['forum_user']);
      while($post['forum_page'] > 1 && empty($topics) == true){
        $post['forum_page'] = $post['forum_page'] - 1;
        $topics = $this->model->getTopics($topics_per_page, $post['forum_page'], $post['forum_user']);
      }
      if(isset($post['forum_alert'])){
        $this->view->include_forum($topics, $number_of_pages, $post['forum_page'], $post['forum_alert']);
      }
      else{
        $this->view->include_forum($topics, $number_of_pages, $post['forum_page'], '');
      }
    }
    else if($action == "consult_your_topics"){//POST(your_topics_page, your_topics_author)
      $topics_per_page = 2;
      $number_of_topics = $this->model->getNumberOfYourTopics($post['your_topics_author']);
      $number_of_pages = ceil($number_of_topics/$topics_per_page);
      $topics = $this->model->getYourTopics($topics_per_page, $post['your_topics_page'], $post['your_topics_author']);
      while($post['your_topics_page'] > 1 && empty($topics) == true){
        $post['your_topics_page'] = $post['your_topics_page'] - 1;
        $topics = $this->model->getYourTopics($topics_per_page, $post['your_topics_page'], $post['your_topics_author']);
      }
      $this->view->yourTopicsScreen($topics, $number_of_pages, $post['your_topics_page']);
    }
    else if($action == "delete_your_topics"){//POST(delete_your_topics_id, delete_your_topics_page, delete_your_topics_author)
      $this->model->deleteTopic($post['delete_your_topics_id']);
      $post['your_topics_page'] = $post['delete_your_topics_page'];
      $post['your_topics_author'] = $post['delete_your_topics_author'];
      $this->forum($post, 'consult_your_topics');
    }
    else if($action == "add_favorite"){//POST(add_favorite_author, add_favorite_topic, last_forum_page ou last_your_topics_page)
      $this->model->addFavorite($post['add_favorite_author'], $post['add_favorite_topic']);
      if(isset($post['last_forum_page'])){
        $post['forum_page'] = $post['last_forum_page'];
        $post['forum_user'] = $post['add_favorite_author'];
        $this->forum($post, 'consult');
      }
      else if(isset($post['last_your_topics_page'])){
        $post['your_topics_page'] = $post['last_your_topics_page'];
        $post['your_topics_author'] = $post['add_favorite_author'];
        $this->forum($post, 'consult_your_topics');
      }
    }
    else if($action == "consult_your_favorites"){//POST(your_favorites_page, your_favorites_author, your_favorites_alert (optionnel))
      $topics_per_page = 2;
      $number_of_topics = $this->model->getNumberOfYourFavorites($post['your_favorites_author']);
      $number_of_pages = ceil($number_of_topics/$topics_per_page);
      $topics = $this->model->getYourFavorites($topics_per_page, $post['your_favorites_page'], $post['your_favorites_author']);
      while($post['your_favorites_page'] > 1 && empty($topics) == true){
        $post['your_favorites_page'] = $post['your_favorites_page'] - 1;
        $topics = $this->model->getYourFavorites($topics_per_page, $post['your_favorites_page'], $post['your_favorites_author']);
      }
      if(isset($post['your_favorites_alert'])){
        $this->view->yourFavoritesScreen($topics, $number_of_pages, $post['your_favorites_page'], $post['your_favorites_alert']);
      }
      else{
        $this->view->yourFavoritesScreen($topics, $number_of_pages, $post['your_favorites_page'], '');
      }
    }
    else if($action == "report_your_favorites"){//POST(report_your_favorites_page, report_your_favorites_author, report_your_favorites_id)
      $this->model->signalTopic($post['report_your_favorites_id']);
      $post['your_favorites_page'] = $post['report_your_favorites_page'];
      $post['your_favorites_author'] = $post['report_your_favorites_author'];
      $post['your_favorites_alert'] = 'Votre signalement a bien été reçu, un administrateur prendra une décision vis à vis de ce sujet';
      $this->forum($post, 'consult_your_favorites');
    }
    else if($action == "delete_your_favorites"){//POST(delete_your_favorites_id, delete_your_favorites_page, delete_your_favorites_author)
      $this->model->deleteFavorite($post['delete_your_favorites_id']);
      $post['your_favorites_page'] = $post['delete_your_favorites_page'];
      $post['your_favorites_author'] = $post['delete_your_favorites_author'];
      $this->forum($post, 'consult_your_favorites');
    }
    else if($action == "research_forum"){//POST(research_forum_content, research_forum_page, research_forum_user, research_forum_alert (optionnel))
      $topics_per_page = 2;
      $number_of_topics = $this->model->getNumberOfForumFindings($post['research_forum_content']);
      $number_of_pages = ceil($number_of_topics/$topics_per_page);
      $topics = $this->model->getForumFindings($topics_per_page, $post['research_forum_page'], $post['research_forum_user'], $post['research_forum_content']);
      while($post['research_forum_page'] > 1 && empty($topics) == true){
        $post['research_forum_page'] = $post['research_forum_page'] - 1;
        $topics = $this->model->getForumFindings($topics_per_page, $post['research_forum_page'], $post['research_forum_user'], $post['research_forum_content']);
      }
      if(isset($post['research_forum_alert'])){
        $this->view->researchForumScreen($topics, $number_of_pages, $post['research_forum_page'], $post['research_forum_content'], $post['research_forum_alert']);
      }
      else{
        $this->view->researchForumScreen($topics, $number_of_pages, $post['research_forum_page'], $post['research_forum_content'], '');
      }
    }
    else if($action == "add_favorite_research_forum"){//POST(add_favorite_research_forum_content, add_favorite_research_forum_page, add_favorite_research_forum_id, add_favorite_research_forum_author)
      $this->model->addFavorite($post['add_favorite_research_forum_author'], $post['add_favorite_research_forum_id']);
      $post['research_forum_content'] = $post['add_favorite_research_forum_content'];
      $post['research_forum_page'] = $post['add_favorite_research_forum_page'];
      $post['research_forum_user'] = $post['add_favorite_research_forum_author'];
      $this->forum($post, 'research_forum');
    }
    else if($action == "report_research_forum"){//POST(report_research_forum_content, report_research_forum_author, report_research_forum_page, report_research_forum_id)
      $this->model->signalTopic($post['report_research_forum_id']);
      $post['research_forum_content'] = $post['report_research_forum_content'];
      $post['research_forum_page'] = $post['report_research_forum_page'];
      $post['research_forum_user'] = $post['report_research_forum_author'];
      $post['research_forum_alert'] = 'Votre signalement a bien été reçu, un administrateur prendra une décision vis à vis de ce sujet';
      $this->forum($post, 'research_forum');
    }
    else if($action == "research_your_topics"){//POST(research_your_topics_content, research_your_topics_page, research_your_topics_user)
      $topics_per_page = 2;
      $number_of_topics = $this->model->getNumberOfYourTopicsFindings($post['research_your_topics_content'], $post['research_your_topics_user']);
      $number_of_pages = ceil($number_of_topics/$topics_per_page);
      $topics = $this->model->getYourTopicsFindings($topics_per_page, $post['research_your_topics_page'], $post['research_your_topics_user'], $post['research_your_topics_content']);
      while($post['research_your_topics_page'] > 1 && empty($topics) == true){
        $post['research_your_topics_page'] = $post['research_your_topics_page'] - 1;
        $topics = $this->model->getYourTopicsFindings($topics_per_page, $post['research_your_topics_page'], $post['research_your_topics_user'], $post['research_your_topics_content']);
      }
      $this->view->researchYourTopicsScreen($topics, $number_of_pages, $post['research_your_topics_page'], $post['research_your_topics_content']);
    }
    else if($action == "add_favorite_research_your_topics"){//POST(add_favorite_research_your_topics_content, add_favorite_research_your_topics_page, add_favorite_research_your_topics_id, add_favorite_research_your_topics_author)
      $this->model->addFavorite($post['add_favorite_research_your_topics_author'], $post['add_favorite_research_your_topics_id']);
      $post['research_your_topics_content'] = $post['add_favorite_research_your_topics_content'];
      $post['research_your_topics_page'] = $post['add_favorite_research_your_topics_page'];
      $post['research_your_topics_user'] = $post['add_favorite_research_your_topics_author'];
      $this->forum($post, 'research_your_topics');
    }
    else if($action == "delete_research_your_topics"){//POST(delete_research_your_topics_content, delete_research_your_topics_page, delete_research_your_topics_id, delete_research_your_topics_author)
      $this->model->deleteTopic($post['delete_research_your_topics_id']);
      $post['research_your_topics_content'] = $post['delete_research_your_topics_content'];
      $post['research_your_topics_page'] = $post['delete_research_your_topics_page'];
      $post['research_your_topics_user'] = $post['delete_research_your_topics_author'];
      $this->forum($post, 'research_your_topics');
    }
    else if($action == "research_your_favorites"){//POST(research_your_favorites_content, research_your_favorites_page, research_your_favorites_user, research_your_favorites_alert (optionnel))
      $topics_per_page = 2;
      $number_of_topics = $this->model->getNumberOfYourFavoritesFindings($post['research_your_favorites_content'], $post['research_your_favorites_user']);
      $number_of_pages = ceil($number_of_topics/$topics_per_page);
      $topics = $this->model->getYourFavoritesFindings($topics_per_page, $post['research_your_favorites_page'], $post['research_your_favorites_user'], $post['research_your_favorites_content']);
      while($post['research_your_favorites_page'] > 1 && empty($topics) == true){
        $post['research_your_favorites_page'] = $post['research_your_favorites_page'] - 1;
        $topics = $this->model->getYourFavoritesFindings($topics_per_page, $post['research_your_favorites_page'], $post['research_your_favorites_user'], $post['research_your_favorites_content']);
      }
      if(isset($post['research_your_favorites_alert'])){
        $this->view->researchYourFavoritesScreen($topics, $number_of_pages, $post['research_your_favorites_page'], $post['research_your_favorites_content'], $post['research_your_favorites_alert']);
      }
      else{
        $this->view->researchYourFavoritesScreen($topics, $number_of_pages, $post['research_your_favorites_page'], $post['research_your_favorites_content'], '');
      }
    }
    else if($action == "report_research_your_favorites"){//POST(report_research_your_favorites_content, report_research_your_favorites_author, report_research_your_favorites_page, report_research_your_favorites_id)
      $this->model->signalTopic($post['report_research_your_favorites_id']);
      $post['research_your_favorites_content'] = $post['report_research_your_favorites_content'];
      $post['research_your_favorites_page'] = $post['report_research_your_favorites_page'];
      $post['research_your_favorites_user'] = $post['report_research_your_favorites_author'];
      $post['research_your_favorites_alert'] = 'Votre signalement a bien été reçu, un administrateur prendra une décision vis à vis de ce sujet';
      $this->forum($post, 'research_your_favorites');
    }
    else if($action == "delete_research_your_favorites"){//POST(delete_research_your_favorites_content, delete_research_your_favorites_page, delete_research_your_favorites_id, delete_research_your_favorites_author)
      $this->model->deleteFavorite($post['delete_research_your_favorites_id']);
      $post['research_your_favorites_content'] = $post['delete_research_your_favorites_content'];
      $post['research_your_favorites_page'] = $post['delete_research_your_favorites_page'];
      $post['research_your_favorites_user'] = $post['delete_research_your_favorites_author'];
      $this->forum($post, 'research_your_favorites');
    }
  }

  public function topic($post, $action){
    if($action == "consult"){ //POST(topic_id, topic_page, topic_alert (optionnel))
      $messages_per_page = 2;
      $number_of_messages = $this->model->getNumberOfMessages($post['topic_id']);
      $number_of_pages = ceil($number_of_messages/$messages_per_page);

      $topic = $this->model->getTopic($post['topic_id']);
      $messages = $this->model->getMessages($post['topic_id'], $messages_per_page, $post['topic_page']);
      while($post['topic_page'] > 1 && empty($messages) == true){
        $post['topic_page'] = $post['topic_page'] - 1;
        $messages = $this->model->getMessages($post['topic_id'], $messages_per_page, $post['topic_page']);
      }
      if(isset($post['topic_alert'])){
        $this->view->include_sujet($topic, $messages, $number_of_pages, $post['topic_page'], $post['topic_alert']);
      }
      else{
        $this->view->include_sujet($topic, $messages, $number_of_pages, $post['topic_page'], '');
      }
    }
    else if($action == "add_topic"){ //POST(add_topic_title (optionnel), add_topic_content (optionnel), add_topic_title_error (optionnel), add_topic_content_error (optionnel))
      if(isset($post['add_topic_title']) && isset($post['add_topic_content']) && isset($post['add_topic_title_error']) && isset($post['add_topic_content_error'])){
        $this->view->addTopicScreen($post['add_topic_title'], $post['add_topic_content'], $post['add_topic_title_error'], $post['add_topic_content_error']);
      }
      else{
        $this->view->addTopicScreen('','','','');
      }
    }
    else if($action == "create_topic"){//POST(topic_title, topic_content, topic_author)
      $add_topic_title_error = $this->model->checkAddTopicTitle($post['topic_title']);
      $add_topic_content_error = $this->model->checkAddTopicContent($post['topic_content']);

      if($add_topic_title_error == '' && $add_topic_content_error == ''){
        $post['message_topic_post'] = $this->model->createTopic($post['topic_title'], $post['topic_author']);
        $post['message_content'] = $post['topic_content'];
        $post['message_author'] = $post['topic_author'];
        $post['last_page_post'] = 1;
        $this->message($post, 'post_message');
      }
      else{
        $post['add_topic_title'] = $post['topic_title'];
        $post['add_topic_content'] = $post['topic_content'];
        $post['add_topic_title_error'] = $add_topic_title_error;
        $post['add_topic_content_error'] = $add_topic_content_error;
        $this->topic($post, 'add_topic');
      }

    }
  }

  //si le message n'est pas accepté, retourner false.
  public function message($post, $action){
    if($action == "add_message"){//POST(message_topic_add, last_page_add, add_message_content (optionnel), add_message_content_error (optionnel), message_quote_id (optionnel))
      if(isset($post['add_message_content']) && isset($post['add_message_content_error'])){
        if(isset($post['message_quote_id'])){
          $topic = $this->model->getTopic($post['message_topic_add']);
          $message_quote = $this->model->getMessage($post['message_quote_id']);
          $this->view->addMessageScreen($topic, $post['last_page_add'], $post['add_message_content'], $post['add_message_content_error'], $message_quote);
        }
        else{
          $topic = $this->model->getTopic($post['message_topic_add']);
          $this->view->addMessageScreen($topic, $post['last_page_add'], $post['add_message_content'], $post['add_message_content_error'], '');
        }
      }
      else{
        if(isset($post['message_quote_id'])){
          $topic = $this->model->getTopic($post['message_topic_add']);
          $message_quote = $this->model->getMessage($post['message_quote_id']);
          $this->view->addMessageScreen($topic, $post['last_page_add'], '', '', $message_quote);
        }
        else{
          $topic = $this->model->getTopic($post['message_topic_add']);
          $this->view->addMessageScreen($topic, $post['last_page_add'], '', '', '');
        }
      }
    }
    else if($action == "post_message"){//POST(message_content, message_author, message_topic_post, last_page_post, message_quote_id (optionnel))

      $add_message_content_error = $this->model->checkAddMessageContent($post['message_content']);

      if($add_message_content_error == ''){
        if(isset($post['message_quote_id'])){
          $this->model->postMessage($post['message_content'], $post['message_author'], $post['message_topic_post'], $post['message_quote_id']);
          $post['topic_id'] = $post['message_topic_post'];
          $post['topic_page'] = $post['last_page_post'];
          $this->topic($post, 'consult');
        }
        else{
          $this->model->postMessage($post['message_content'], $post['message_author'], $post['message_topic_post'], NULL);
          $post['topic_id'] = $post['message_topic_post'];
          $post['topic_page'] = $post['last_page_post'];
          $this->topic($post, 'consult');
        }
      }
      else{
        $topic = $this->model->getTopic($post['message_topic_post']);
        $post['message_topic_add'] = $post['message_topic_post'];
        $post['last_page_add'] = $post['last_page_post'];
        $post['add_message_content'] = $post['message_content'];
        $post['add_message_content_error'] = $add_message_content_error;
        $this->message($post, 'add_message');
      }
    }
  }

  public function displayParam(){
    $this->view->include_param();
  }

  public function changePwd($old_pwd, $pwd1, $pwd2){
    $post['identifiant'] = $_SESSION['login'];
    $post['pwd'] = $old_pwd;
    //verify old_pwd
    if($this->model->login($post)){
      if($pwd1 == $pwd2){
        $this->model->changePwd($pwd1);
        $this->view->include_param_changed('success');
      }else{
        $this->view->include_param_changed('fail_new_pwd');
      }
    }else{
      $this->view->include_param_changed('fail_old_pwd');
    }
  }

  public function isAdmin(){
    if($this->model->getID() == 232323){

      return true;
    }else{
      return false;
    }
  }

  public function addStudent($name, $surname, $mail, $numero){
    $this->model->addStudent($name,$surname,$mail,$numero);
    $this->view->include_param_added('success');
  }

  public function displayReports($page_number, $page_number_t){
    $messages_per_page = 2;
    $number_of_messages = $this->model->getNumberTotalMessageReported(); //Total nb of messages
    $number_of_pages = ceil($number_of_messages/$messages_per_page);
    $messages = $this->model->getReportedMessages($messages_per_page, $page_number);

    $topics_per_page = 2;
    $number_of_topics = $this->model->getNumberTotalTopicsReported();
    $number_of_pages_t = ceil($number_of_topics/$topics_per_page);
    $topics = $this->model->getReportedTopics($topics_per_page, $page_number_t);

    $this->view->includeReports($messages,$number_of_pages,$page_number, $topics, $number_of_pages_t, $page_number_t);
  }

  public function deleteTopic($topic_id){
    $this->model->deleteTopic($topic_id);
  }

  public function deleteMessage($message_id){
    $this->model->deleteMessage($message_id);
  }

  public function unSignalMessage($message_id){
    $this->model->unSignalMessage($message_id);
  }

  public function unSignalTopic($message_id){
    $this->model->unSignalTopic($message_id);
  }

  public function signalTopicRedirect($post){
    $this->model->signalTopic($post['signal_topic']);
    $post['forum_user'] = $post['forum_signal_user'];
    $post['forum_page'] = $post['forum_signal_page'];
    $post['forum_alert'] = 'Votre signalement a bien été reçu, un administrateur prendra une décision vis à vis de ce sujet';
    $this->forum($post,'consult');
  }

  public function signalMessageRedirect($post){
    $this->model->signalMessage($post['signal_message']);
    $post['topic_id'] = $post['topic_signal_id'];
    $post['topic_page'] = $post['topic_signal_page'];
    $post['topic_alert'] = 'Votre signalement a bien été reçu, un administrateur prendra une décision vis à vis de ce message';
    $this->topic($post,'consult');
  }

  public function censorMessage($id){
    $this->model->censorMessage($id);
  }

}

?>
