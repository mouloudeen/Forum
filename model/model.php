<?php
class Model{
    private static $key = 'idkK4556kkUkrkt5gdhddjhdsjsdhdhjsjdhdhdsjdhdhdjsjhdhdjsjddja';
    private static  $mode = 'cbc';
    private static $cipher  = MCRYPT_RIJNDAEL_128;
    public function __construct()
    {
     
    }

    //Function used to connect to the database.
    public function connect(){
    try
    {
      //Ligne à compléter : 
      $bdd = new PDO('mysql:host=vivaldi;dbname=tguesdon;charset=utf8','tguesdon','moimoi123', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch(Exception $e)
    {
      return false;//return false if there is an error during the connection.
    }

    return $bdd;
  }
    /*the crypt and decrypt methods are only used for the email address not for the password */
    //function crypt ,encrypt the email address passed in parameter before saving it in the database
    public static function crypt($data){
      $keyHash = md5(self::$key);
      $key = substr($keyHash, 0, mcrypt_get_key_size(self::$cipher, self::$mode));
      $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode));
   
      $data = mcrypt_encrypt(self::$cipher, $key, $data, self::$mode, $iv);
      
      return base64_encode($data);
  }
   //function decrypt ,decrypt the string passed in parameter
  public static function decrypt($data){
      $keyHash = md5(self::$key);
      $key = substr($keyHash, 0,   mcrypt_get_key_size(self::$cipher, self::$mode) );
      $iv  = substr($keyHash, 0, mcrypt_get_block_size(self::$cipher, self::$mode) );
  
      $data = base64_decode($data);
      $data = mcrypt_decrypt(self::$cipher, $key, $data, self::$mode, $iv);
  
      return rtrim($data);
  }


  //Disconnection.
  public function deconnecte($deconn){
    session_destroy();
  }

  /*Check in the table $table if there is a valid number */
  public function exist_np($np,$table){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    $reponse = $bdd->prepare('SELECT numero FROM '.$table.' WHERE numero=?');
    $reponse->execute(array($np));
    $red = $reponse->fetch();
    if($red==true){
      return true;
    }
    return false;
  }

  /* 	This function check if the login and password are valid.
  If they are it returns true, otherwise false. */
  public function login($post){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    //Get the users and his password encrypted.
    $req = $bdd->prepare('SELECT identifiant, pwd FROM user WHERE identifiant= :identifiant');
    $req->execute(array(
      'identifiant' => $post['identifiant']));
      $resultat = $req->fetch();
      //Comparison between the password and the password on the database.
      $isPasswordCorrect = password_verify($post['pwd'], $resultat['pwd']);

      if (!$resultat)
      {
        return false;
      }
      else
      {
        if ($isPasswordCorrect)
        {
          return true;
        }
        else
        {
          return false;
        }
      }
  }

  /* This function send a message $message to the user by mail. */
  public function send_mail($code,$sujet,$message){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    $req = $bdd->query('SELECT mail  FROM infos WHERE numero=\''.$code.'\''); // Je compte le nombre d'entrées
    if ($donnees=$req->fetch()){
      $mail=$donnees['mail'];
      $decryptedmail = $encrypted = $this->decrypt($mail);
      mail($decryptedmail,$sujet,$message);

    }
  }

  //This function change the  old password with the new : $newpassword
  public function edit_id($numero,$newpwd){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    $pass_hache = password_hash($newpwd, PASSWORD_DEFAULT);
    $bdd->exec('UPDATE user SET pwd =\''.$pass_hache.'\' WHERE  numero =\''.$numero.'\'');
    $bdd->exec('UPDATE user SET pass =\''.$newpwd.'\' WHERE  numero =\''.$numero.'\'');
  }

  //this function return the password with the ID
  public function get_pwd(){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    $req = $bdd->query('SELECT pass FROM user WHERE identifiant=\''.$_SESSION['login'].'\'');
    if ($donnees=$req->fetch())
    {
      return $donnees;
    }
  }

  //This function verify that the password used during registration are the same.
  public function diff_pwds($post) {
    if ($post['pwd1']!=$post['pwd2'])
    {
      return true;
    }
    return false;
  }

  /*This function verify that there is no empty fields during registration.
  *If there is one, the users will have to fill the form again.
  ** $fields : is a tab of fields.
  **$send: Is the submit field, that will be empty but that we don't verify.*/
  public function is_empty($fields,$send){
    foreach($fields as $key=>$value)
    {
      if (empty($fields[$key]) && $send!=$key)
      {
        return true;
      }
    }
    return false;
  }

  //Verify that the login **$id** filled during registration is unique.
  public function user($id){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    $reponse = $bdd->prepare('SELECT identifiant FROM user WHERE identifiant=?');
    $reponse->execute(array($id));
    $red = $reponse->fetch();
    if($red==true){
      return true;
    }
    return false;
  }

  /*This function find an user with his login...
  Used to display the name of this user instead of his login. */
  public function name_identifiant($identifiant){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    $req = $bdd->query('SELECT usr  FROM user WHERE identifiant=\''.$identifiant.'\''); //Counting the entries
    if ($donnees=$req->fetch()){
      return $donnees['usr'];
    }
  }

  /*Find an user with his personnal code so that it can be added to the users table.*/
  public function name_numero($numero){
    $bdd=$this->connect();
    if($bdd==false){
      return false;
    }
    $req = $bdd->query('SELECT prenoms  FROM infos WHERE numero=\''.$numero.'\''); //Counting the entries
    if ($donnees=$req->fetch()){
      return $donnees['prenoms'];
    }
  }

  /*Save in the database the datas after registration and verification. */
  function save_user($post){

    $pass_hache = password_hash($post['pwd1'], PASSWORD_DEFAULT);//Encrypt the password before saving it.
    $bdd=$this->connect();
    $reponse = $bdd->prepare('INSERT INTO user (ID, usr, identifiant, pwd,numero,pass) VALUES(:ID, :usr, :identifiant,:pwd, :numero,:pass)');
    $reponse->execute(array(
      'ID'=>NULL,
      'usr'=>$this->name_numero($post['code']),
      'identifiant'=>$post['identifiant'],
      'pwd'=>$pass_hache,
      'numero'=>$post['code'],
      'pass'=>$post['pwd1']));//The password is in the database in case that the user forget it.
  }

  public function getNumber($identifiant){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $user_number = $bdd->prepare('SELECT numero FROM user WHERE identifiant = :identifiant');
    $user_number->execute(array('identifiant' => $identifiant));

    return $user_number->fetch()['numero'];
  }

  public function getFirstName($user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $user_first_name = $bdd->prepare('SELECT prenoms FROM infos WHERE numero = :numero');
    $user_first_name->execute(array('numero' => $user_number));

    return $user_first_name->fetch()['prenoms'];
  }

  public function getLastName($user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $user_last_name = $bdd->prepare('SELECT nom FROM infos WHERE numero = :numero');
    $user_last_name->execute(array('numero' => $user_number));

    return $user_last_name->fetch()['nom'];
  }

  public function getTopics($topics_per_page, $page_number, $user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $number1 = ($page_number-1)*$topics_per_page;
    $number2 = $topics_per_page;

    //Il faut utliser bindValue à cause de LIMIT, sinon ne fonctionne pas.
    $topics = $bdd->prepare('SELECT ID, titre, nom_auteur, prenom_auteur, numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics ORDER BY ID DESC LIMIT :number1, :number2');
    $topics->bindValue(':number1', $number1, PDO::PARAM_INT);
    $topics->bindValue(':number2', $number2, PDO::PARAM_INT);
    $topics->execute();

    $topics_array = array();

    while($topic = $topics->fetch()){
      $topic['is_favorite'] = $this->isFavorite($topic['ID'], $user_number);
      $topics_array[] = $topic;
    }

    return $topics_array;
  }

  private function isFavorite($topic_id, $user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $favorite = $bdd->prepare('SELECT ID FROM favorites WHERE numero_auteur = :numero_auteur AND numero_topic = :numero_topic');
    $favorite->execute(array('numero_auteur' => $user_number, 'numero_topic' => $topic_id ));

    $is_favorite = $favorite->fetch()['ID'];

    if($is_favorite == false){
      return false;
    }
    else{
      return true;
    }
  }

  public function getYourTopics($topics_per_page, $page_number, $user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $number1 = ($page_number-1)*$topics_per_page;
    $number2 = $topics_per_page;

    //Il faut utliser bindValue à cause de LIMIT, sinon ne fonctionne pas.
    $topics = $bdd->prepare('SELECT ID, titre, nom_auteur, prenom_auteur, numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics WHERE numero_auteur = :numero_auteur ORDER BY ID DESC LIMIT :number1, :number2');
    $topics->bindValue(':numero_auteur', $user_number, PDO::PARAM_INT);
    $topics->bindValue(':number1', $number1, PDO::PARAM_INT);
    $topics->bindValue(':number2', $number2, PDO::PARAM_INT);
    $topics->execute();

    $topics_array = array();

    while($topic = $topics->fetch()){
      $topic['is_favorite'] = $this->isFavorite($topic['ID'], $user_number);
      $topics_array[] = $topic;
    }

    return $topics_array;
  }

  public function getYourFavorites($topics_per_page, $page_number, $user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $number1 = ($page_number-1)*$topics_per_page;
    $number2 = $topics_per_page;

    //Il faut utliser bindValue à cause de LIMIT, sinon ne fonctionne pas.
    $topics = $bdd->prepare('SELECT topics.ID AS ID, titre, nom_auteur, prenom_auteur, topics.numero_auteur AS numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics INNER JOIN favorites ON numero_topic = topics.ID WHERE favorites.numero_auteur = :numero_auteur ORDER BY favorites.ID DESC LIMIT :number1, :number2');
    $topics->bindValue(':numero_auteur', $user_number, PDO::PARAM_INT);
    $topics->bindValue(':number1', $number1, PDO::PARAM_INT);
    $topics->bindValue(':number2', $number2, PDO::PARAM_INT);
    $topics->execute();

    $topics_array = array();

    while($topic = $topics->fetch()){
      $topics_array[] = $topic;
    }

    return $topics_array;
  }

  public function getForumFindings($topics_per_page, $page_number, $user_number, $research_content){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $number1 = ($page_number-1)*$topics_per_page;
    $number2 = $topics_per_page;

    $clean_research_content = str_replace("'", "\'", $research_content);
    $keywords = explode(' ', $clean_research_content);
    $likes = '';
    foreach($keywords as $keyword){
      $likes = $likes.' titre LIKE \'%'.$keyword.'%\' OR';
    }
    $likes = substr($likes, 0, strlen($likes)-3);

    //Il faut utliser bindValue à cause de LIMIT, sinon ne fonctionne pas.
    $topics = $bdd->prepare('SELECT ID, titre, nom_auteur, prenom_auteur, numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics WHERE'.$likes.' ORDER BY ID DESC LIMIT :number1, :number2');
    $topics->bindValue(':number1', $number1, PDO::PARAM_INT);
    $topics->bindValue(':number2', $number2, PDO::PARAM_INT);
    $topics->execute();

    $topics_array = array();

    while($topic = $topics->fetch()){
      $topic['is_favorite'] = $this->isFavorite($topic['ID'], $user_number);
      $topics_array[] = $topic;
    }

    return $topics_array;
  }

  public function getYourTopicsFindings($topics_per_page, $page_number, $user_number, $research_content){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $number1 = ($page_number-1)*$topics_per_page;
    $number2 = $topics_per_page;

    $clean_research_content = str_replace("'", "\'", $research_content);
    $keywords = explode(' ', $clean_research_content);
    $likes = '';
    foreach($keywords as $keyword){
      $likes = $likes.' titre LIKE \'%'.$keyword.'%\' OR';
    }
    $likes = substr($likes, 0, strlen($likes)-3);

    //Il faut utliser bindValue à cause de LIMIT, sinon ne fonctionne pas.
    $topics = $bdd->prepare('SELECT ID, titre, nom_auteur, prenom_auteur, numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics WHERE numero_auteur = :numero_auteur AND'.$likes.' ORDER BY ID DESC LIMIT :number1, :number2');
    $topics->bindValue(':numero_auteur', $user_number, PDO::PARAM_INT);
    $topics->bindValue(':number1', $number1, PDO::PARAM_INT);
    $topics->bindValue(':number2', $number2, PDO::PARAM_INT);
    $topics->execute();

    $topics_array = array();

    while($topic = $topics->fetch()){
      $topic['is_favorite'] = $this->isFavorite($topic['ID'], $user_number);
      $topics_array[] = $topic;
    }

    return $topics_array;
  }

  public function getYourFavoritesFindings($topics_per_page, $page_number, $user_number, $research_content){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $number1 = ($page_number-1)*$topics_per_page;
    $number2 = $topics_per_page;

    $clean_research_content = str_replace("'", "\'", $research_content);
    $keywords = explode(' ', $clean_research_content);
    $likes = '';
    foreach($keywords as $keyword){
      $likes = $likes.' titre LIKE \'%'.$keyword.'%\' OR';
    }
    $likes = substr($likes, 0, strlen($likes)-3);

    //Il faut utliser bindValue à cause de LIMIT, sinon ne fonctionne pas.
    $topics = $bdd->prepare('SELECT topics.ID AS ID, titre, nom_auteur, prenom_auteur, topics.numero_auteur AS numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics INNER JOIN favorites ON numero_topic = topics.ID WHERE favorites.numero_auteur = :numero_auteur AND'.$likes.' ORDER BY favorites.ID DESC LIMIT :number1, :number2');
    $topics->bindValue(':numero_auteur', $user_number, PDO::PARAM_INT);
    $topics->bindValue(':number1', $number1, PDO::PARAM_INT);
    $topics->bindValue(':number2', $number2, PDO::PARAM_INT);
    $topics->execute();

    $topics_array = array();

    while($topic = $topics->fetch()){
      $topics_array[] = $topic;
    }

    return $topics_array;
  }

  public function getNumberOfTopics(){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $forum = $bdd->query('SELECT COUNT(*) AS number_of_topics FROM topics');

    return $forum->fetch()['number_of_topics'];
  }

  public function getNumberOfYourTopics($user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $your_topics = $bdd->prepare('SELECT COUNT(*) AS number_of_topics FROM topics WHERE numero_auteur = :numero_auteur');
    $your_topics->execute(array('numero_auteur' => $user_number));

    return $your_topics->fetch()['number_of_topics'];
  }

  public function getNumberOfYourFavorites($user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $your_favorites = $bdd->prepare('SELECT COUNT(*) AS number_of_topics FROM favorites WHERE numero_auteur = :numero_auteur');
    $your_favorites->execute(array('numero_auteur' => $user_number));

    return $your_favorites->fetch()['number_of_topics'];
  }

  public function getNumberOfForumFindings($research_content){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $clean_research_content = str_replace("'", "\'", $research_content);
    $keywords = explode(' ', $clean_research_content);
    $likes = '';
    foreach($keywords as $keyword){
      $likes = $likes.' titre LIKE \'%'.$keyword.'%\' OR';
    }
    $likes = substr($likes, 0, strlen($likes)-3);

    $forum_findings = $bdd->query('SELECT COUNT(*) AS number_of_topics FROM topics WHERE'.$likes);

    return $forum_findings->fetch()['number_of_topics'];
  }

  public function getNumberOfYourTopicsFindings($research_content, $user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $clean_research_content = str_replace("'", "\'", $research_content);
    $keywords = explode(' ', $clean_research_content);
    $likes = '';
    foreach($keywords as $keyword){
      $likes = $likes.' titre LIKE \'%'.$keyword.'%\' OR';
    }
    $likes = substr($likes, 0, strlen($likes)-3);

    $your_topics_findings = $bdd->prepare('SELECT COUNT(*) AS number_of_topics FROM topics WHERE numero_auteur = :numero_auteur AND'.$likes);
    $your_topics_findings->execute(array('numero_auteur' => $user_number));

    return $your_topics_findings->fetch()['number_of_topics'];
  }

  public function getNumberOfYourFavoritesFindings($research_content, $user_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $clean_research_content = str_replace("'", "\'", $research_content);
    $keywords = explode(' ', $clean_research_content);
    $likes = '';
    foreach($keywords as $keyword){
      $likes = $likes.' titre LIKE \'%'.$keyword.'%\' OR';
    }
    $likes = substr($likes, 0, strlen($likes)-3);

    $your_favorites_findings = $bdd->prepare('SELECT COUNT(*) AS number_of_topics FROM favorites INNER JOIN topics ON topics.ID = numero_topic WHERE favorites.numero_auteur = :numero_auteur AND'.$likes);
    $your_favorites_findings->execute(array('numero_auteur' => $user_number));

    return $your_favorites_findings->fetch()['number_of_topics'];
  }

  public function getTopic($topic_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $topic = $bdd->prepare('SELECT ID, titre, nom_auteur, prenom_auteur, numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics WHERE ID = :id');
    $topic->execute(array('id' => $topic_id));

    return $topic;
  }

  public function getMessages($topic_id, $messages_per_page, $page_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $number1 = ($page_number-1)*$messages_per_page;
    $number2 = $messages_per_page;

    $messages = $bdd->prepare('SELECT ID, contenu, nom_auteur, prenom_auteur, numero_auteur, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure, citations FROM messages WHERE numero_topic = :topic_id LIMIT :number1, :number2');
    $messages->bindValue(':topic_id', $topic_id, PDO::PARAM_INT);
    $messages->bindValue(':number1', $number1, PDO::PARAM_INT);
    $messages->bindValue(':number2', $number2, PDO::PARAM_INT);
    $messages->execute();

    $messages_array = array();

    while($message = $messages->fetch()){
      if($message['citations'] != NULL){
        $message['citations'] = unserialize($message['citations']);
      }
      $messages_array[] = $message;
    }
    return $messages_array;
  }

  public function getMessage($message_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $message = $bdd->prepare('SELECT ID, contenu, nom_auteur, prenom_auteur, numero_auteur, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure, citations, numero_topic FROM messages WHERE ID = :message_id');
    $message->bindValue(':message_id', $message_id, PDO::PARAM_INT);
    $message->execute();

    $message_array = $message->fetch();
    if($message_array['citations'] != NULL){
      $message_array['citations'] = unserialize($message_array['citations']);
    }

    return $message_array;
  }

  //REPORTED MESSAGES
  public function getReportedMessages($messages_per_page, $page_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $number1 = ($page_number-1)*$messages_per_page;
    $number2 = $messages_per_page;

    $messages = $bdd->prepare('SELECT ID, contenu, nom_auteur, prenom_auteur, numero_auteur, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM messages WHERE signalements > 0 LIMIT :number1, :number2');
    $messages->bindValue(':number1', $number1, PDO::PARAM_INT);
    $messages->bindValue(':number2', $number2, PDO::PARAM_INT);
    $messages->execute();

    return $messages;
  }

  public function getNumberTotalMessageReported(){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $topic = $bdd->prepare('SELECT COUNT(*) AS number_of_messages FROM messages WHERE signalements > 0');
    $topic->execute();

    return $topic->fetch()['number_of_messages'];
  }
  //-----------------------------------------

  //REPORTED TOPICS
  public function getReportedTopics($topics_per_page, $page_number){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $number1 = ($page_number-1)*$topics_per_page;
    $number2 = $topics_per_page;

    $topics = $bdd->prepare('SELECT ID, titre, nom_auteur, prenom_auteur, numero_auteur, nbr_messages, DATE_FORMAT(date_heure, "%d/%m/%Y %H:%i:%s") AS date_heure FROM topics WHERE signalements > 0 LIMIT :number1, :number2');
    $topics->bindValue(':number1', $number1, PDO::PARAM_INT);
    $topics->bindValue(':number2', $number2, PDO::PARAM_INT);
    $topics->execute();

    return $topics;
  }

  public function getNumberTotalTopicsReported(){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $topic = $bdd->prepare('SELECT COUNT(*) AS number_of_topics FROM topics WHERE signalements > 0');
    $topic->execute();

    return $topic->fetch()['number_of_topics'];
  }
  //-----------------------------------

  public function getNumberOfMessages($topic_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $topic = $bdd->prepare('SELECT COUNT(*) AS number_of_messages FROM messages WHERE numero_topic = :topic_id');
    $topic->execute(array('topic_id' => $topic_id));

    return $topic->fetch()['number_of_messages'];
  }

  public function createTopic($topic_title, $topic_author){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $topic_author_last_name = $this->getLastName($topic_author);
    $topic_author_first_name = $this->getFirstName($topic_author);

    $insert_title = $bdd->prepare('INSERT INTO topics(titre, nom_auteur, prenom_auteur, numero_auteur, nbr_messages, date_heure) VALUES(:titre, :nom_auteur, :prenom_auteur, :numero_auteur, 0, NOW())');
    $insert_title->execute(array('titre' => $topic_title, 'nom_auteur' => $topic_author_last_name, 'prenom_auteur' => $topic_author_first_name, 'numero_auteur' => $topic_author));

    $topic_id = $bdd->prepare('SELECT ID FROM topics WHERE numero_auteur = :numero_auteur ORDER BY ID DESC');
    $topic_id->execute(array('numero_auteur' => $topic_author));

    return $topic_id->fetch()['ID'];
  }

  public function postMessage($message_content, $message_author, $message_topic, $message_quote_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $message_author_last_name = $this->getLastName($message_author);
    $message_author_first_name = $this->getFirstName($message_author);

    if($message_quote_id != NULL){

      $message_quote = $this->getMessage($message_quote_id);

      if($message_quote['citations'] != NULL){
        $message_quote['citations'][] = $message_quote;
      }
      else{
        $message_quote['citations'] = array();
        $message_quote['citations'][] = $message_quote;
      }

      $ser_quotes_array = serialize($message_quote['citations']);

      $insert_message = $bdd->prepare('INSERT INTO messages(contenu, nom_auteur, prenom_auteur, numero_auteur, date_heure, citations, numero_topic) VALUES(:contenu, :nom_auteur, :prenom_auteur, :numero_auteur, NOW(), :citations, :numero_topic)');
      $insert_message->execute(array('contenu' => $message_content, 'nom_auteur' => $message_author_last_name, 'prenom_auteur' => $message_author_first_name, 'numero_auteur' => $message_author, 'citations' => $ser_quotes_array, 'numero_topic' => $message_topic));
    }
    else{
      $insert_message = $bdd->prepare('INSERT INTO messages(contenu, nom_auteur, prenom_auteur, numero_auteur, date_heure, numero_topic) VALUES(:contenu, :nom_auteur, :prenom_auteur, :numero_auteur, NOW(), :numero_topic)');
      $insert_message->execute(array('contenu' => $message_content, 'nom_auteur' => $message_author_last_name, 'prenom_auteur' => $message_author_first_name, 'numero_auteur' => $message_author, 'numero_topic' => $message_topic));
    }

    $update_nbr_messages = $bdd->prepare('UPDATE topics SET nbr_messages = nbr_messages + 1 WHERE ID = :message_topic');
    $update_nbr_messages->execute(array('message_topic' => $message_topic));
  }

  public function addFavorite($favorite_author, $favorite_topic){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $insert_favorite = $bdd->prepare('INSERT INTO favorites(numero_auteur, numero_topic) VALUES(:numero_auteur, :numero_topic)');
    $insert_favorite->execute(array('numero_auteur' => $favorite_author, 'numero_topic' => $favorite_topic));
  }

  public function checkAddTopicTitle($add_topic_title){
    if(empty($add_topic_title) == true){
      return 'Veuillez entrer un titre';
    }
    else{
      echo exec('python3 python/filter.py "'.$add_topic_title.'" 2 > log.txt', $output, $return_code);
      if($return_code == 0){
        return 'Vous avez utilisé un mot vulgaire, ou bien votre titre est mal orthographié';
      }
      return '';
    }
  }

  public function checkAddTopicContent($add_topic_content){
    if(empty($add_topic_content) == true){
      return 'Veuillez entrer une description';
    }
    else{
      echo exec('python3 python/filter.py "'.$add_topic_content.'" 2 > log.txt', $output, $return_code);
      if($return_code == 0){
        return 'Vous avez utilisé un mot vulgaire, ou bien votre description est mal orthographié';
      }
      return '';
    }
  }

  public function checkAddMessageContent($add_message_content){
    if(empty($add_message_content) == true){
      return 'Veuillez entrer un message';
    }
    else{
      echo exec('python3 python/filter.py "'.$add_message_content.'" 2 > log.txt', $output, $return_code);
      if($return_code == 0){
        return 'Vous avez utilisé un mot vulgaire, ou bien votre message est mal orthographié';
      }
      return '';
    }
  }

  public function changePwd($new_pwd){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $pass_hash = password_hash($new_pwd, PASSWORD_DEFAULT);//Encrypt the password before saving it.

    $change = $bdd->prepare('UPDATE user SET pwd = :pwd WHERE identifiant = :id');
    $change->execute(array('pwd' => $pass_hash, 'id' => $_SESSION['login']));

    $change = $bdd->prepare('UPDATE user SET pass = :pwd WHERE identifiant = :id');
    $change->execute(array('pwd' => $new_pwd, 'id' => $_SESSION['login']));
  }

  public function getID(){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $user_number = $bdd->prepare('SELECT numero FROM user WHERE identifiant = :identifiant');
    $user_number->execute(array('identifiant' => $_SESSION['login']));

    return $user_number->fetch()['numero'];
   }

   public function addStudent($name, $surname, $mail, $numero){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }

    $encrypted = $this->crypt($mail);

    $insert = $bdd->prepare('INSERT INTO infos(nom, prenoms, mail, numero) VALUES(:nom, :prenoms, :mail, :numero)');
    $insert->execute(array('nom' => $name, 'prenoms' => $surname, 'mail' => $encrypted, 'numero' => $numero));
   }

   //This function increments the number of report of a message
   public function signalMessage($message_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $update = $bdd->prepare("UPDATE `messages` SET `signalements`= `signalements` + 1 WHERE `ID` = :id");
    $update->execute(array('id' => $message_id));
  }

  public function unSignalMessage($message_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $update = $bdd->prepare("UPDATE `messages` SET `signalements`= 0 WHERE `ID` = :id");
    $update->execute(array('id' => $message_id));
  }

  public function deleteTopic($topic_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    //delete every message of the topic before :
    $delete = $bdd->prepare("DELETE FROM `messages` WHERE `numero_topic` = :id");
    $delete->execute(array('id' => $topic_id));

    $delete = $bdd->prepare("DELETE FROM `favorites` WHERE `numero_topic` = :id");
    $delete->execute(array('id' => $topic_id));

    $delete = $bdd->prepare("DELETE FROM `topics` WHERE `ID` = :id");
    $delete->execute(array('id' => $topic_id));
  }

  public function deleteMessage($message_id){ //Faire 1 sur le nombre de messages du topic
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $reponse = $bdd->prepare('SELECT `numero_topic` FROM `messages` WHERE `ID` = :id');
    $reponse->execute(array('id' => $message_id));
    
    $update = $bdd->prepare("UPDATE `topics` SET `nbr_messages`= `nbr_messages` - 1 WHERE `ID` = :id");
    $update->execute(array('id' => intval($reponse->fetch()))); 

    $delete = $bdd->prepare("DELETE FROM `messages` WHERE `ID` = :id");
    $delete->execute(array('id' => $message_id));

  }

  public function deleteFavorite($topic_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $delete = $bdd->prepare('DELETE FROM favorites WHERE numero_topic = :id');
    $delete->execute(array('id' => $topic_id));

  }

  public function signalTopic($topic_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $update = $bdd->prepare("UPDATE `topics` SET `signalements`= `signalements` + 1 WHERE `ID` = :id");
    $update->execute(array('id' => $topic_id));
  }

  public function unSignalTopic($topic_id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $update = $bdd->prepare("UPDATE `topics` SET `signalements`= 0 WHERE `ID` = :id");
    $update->execute(array('id' => $topic_id));
  }

  public function censorMessage($id){
    $bdd = $this->connect();
    if($bdd == false){
      return false;
    }
    $update = $bdd->prepare("UPDATE `messages` SET `contenu`= 'Ce message a été censuré' WHERE `ID` = :id");
    $update->execute(array('id' => $id));
  }
}

  ?>
