<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
        }

        public function registerView(){
            return [
                "view" => VIEW_DIR."security/register.php",
                "data" => []
            ];
        }

        public function loginView(){
            return [
                "view" => VIEW_DIR."security/login.php",
                "data" => []
            ];
        }

        public function profileView(){
            return [
                "view" => VIEW_DIR."security/profil.php",
                "data" => []
            ];
        }

        public function logout(){
            Session::SetUser(null);
            return [
                "view" => VIEW_DIR."home.php",
                "data" => []
            ];
        }

        public function editTopicView($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $topic = $topicManager->findOneById($id);
            $posts = $postManager->findFirstTopicPost($id);

            return [
                "view" => VIEW_DIR."security/editTopic.php",
                "data" => [
                    "topic" => $topic,
                    "posts" => $posts
                ]
            ];
        }

        public function editPostView($id){
            $postManager = new PostManager();

            $posts = $postManager->findFirstTopicPost($id);

            return [
                "view" => VIEW_DIR."security/editPost.php",
                "data" => [
                    "posts" => $posts
                ]
            ];
        }
        
        public function register(){
            $userManager = new UserManager();
            
            if(isset($_POST['submitRegister'])){

                if(isset($_POST['pseudo']) && (!empty($_POST['pseudo'])) && isset($_POST['email']) && (!empty($_POST['email'])) && isset($_POST['password']) && (!empty($_POST['password'])) && isset($_POST['passwordVerif']) && (!empty($_POST['passwordVerif'])) ){
                    $pseudo = filter_input(INPUT_POST,'pseudo',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $passwordVerif = filter_input(INPUT_POST,'passwordVerif',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    
                    if($pseudo && $password && $email) {
                        if($password == $passwordVerif ){
                            $checkMail = $userManager->checkMail($email);
                            if($checkMail == NULL){
                                $checkPseudo = $userManager->checkPseudo($pseudo);
                                if($checkPseudo == null){

                                    $userManager->add([
                                        "pseudo" => $pseudo,
                                        "inscriptionDate" => date('d-m-y h:i:s'),
                                        "password" => $password,
                                        "email" => $email,
                                        "role" => "ROLE_USER",
                                        "status" => "actif"
                                    ]);
                                    header("Location:index.php?ctrl=security&action=registerView");
                                }else{
                                    Session::addFlash("error","pseudo deja existant");
                                }
                            }else{
                                Session::addFlash("error","mail deja existant");
                            }
                        }else{
                            Session::addFlash("error","different");
                        }
                    }
                }
            }
        } 


        public function login(){

            $userManager = new UserManager();
            if(isset($_POST['submitLogin'])){

                if(isset($_POST['email']) && (!empty($_POST['email'])) && isset($_POST['password']) && (!empty($_POST['password']))){

                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL,FILTER_VALIDATE_EMAIL);
                    $password = filter_input(INPUT_POST,'password',FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    if($email && $password){

                        $dbPass = $userManager->retrievePassword($email);

                        if($dbPass){

                            $hash = $dbPass->getPassword();
                            $user = $userManager->findOneByEmail($email);
                            
                            if($this->password_verify($password,$hash)){
                                
                                if($user->getStatus() == "Actif"){
                                    
                                    Session::SetUser($user);
                                }else{
                                    Session::addFlash("error","vous etez banni");
                                }
                            }else{
                                Session::addFlash("error","mot de passe incorrect");
                            }
                        }
                    }
                }
            }
            header("Location:index.php?ctrl=home");
        }

        function password_verify($password,$hash){
            if($password === $hash){
                return true;
            }else{
                return false;
            }
            
        }

        public function listUser(){
            
            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR."security/listUser.php",
                "data" => [
                    "user" => $userManager->findAll(["pseudo", "ASC"]),
                ]
            ];
            
        }

        public function changeStatusUser($id){
            $userManager = new UserManager();
            $user= $userManager->findOneById($id);
            if($user->getStatus() == "Ban"){
                $userManager->changeStatus($id,"Actif");
            }else{
                $userManager->changeStatus($id,"Ban");
            }

            header("Location:index.php?ctrl=security&action=listUser");
        }


        public function changeStatusTopic($id){
            $topicManager = new TopicManager();
            $topic= $topicManager->findOneById($id);
            
            if($topic->getStatus() == "Close"){
                $topicManager->changeStatus($id,"Open");
            }else{
                $topicManager->changeStatus($id,"Close");
            }

            header("Location:index.php?ctrl=forum&action=listTopicsByCategorie");
        }

        public function deleteTopic($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $topic = $topicManager->findOneById($id);
            $posts  =$postManager->findPostByTopic($id);

            foreach($posts as $post){
                $postManager->delete($post->getId());
            }
            $topicManager->delete($id);

            header("Location:index.php?ctrl=forum&action=listTopicsByCategorie&id=".$topic->getCategorie()->getId()."");
        }
        
        public function deletePost($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $post =$postManager->findOneById($id);
            
            $postManager->delete($id);

            header("Location:index.php?ctrl=post&action=listPostByTopic&id=".$post->getTopic()->getId()."");
        }

        
        public function editTopic($id){
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            $topic = $topicManager->findOneById($id);
            $posts = $postManager->findFirstTopicPost($id);
            $postEdited = null;

            foreach($posts as $postBoocle){
                $postEdited = $postBoocle;
            }
            
            if(isset($_POST['submit'])){
                
                if(isset($_POST['post']) && (!empty($_POST['post']))){
                    $post = filter_input(INPUT_POST,"post",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    

                    if($post && $title) {   
                        $topicManager->updateTilte($id,$title);
                        $postManager->updatePost($postEdited->getId(),$post);
                    }
                }
            }

            header("Location:index.php?ctrl=forum&action=listTopicsByCategorie&id=".$topic->getCategorie()->getId()."");
        }

        public function editPost($id){
            $postManager = new PostManager();

            $posts = $postManager->findFirstTopicPost($id);
            $postEdited = null;

            foreach($posts as $postBoocle){
                $postEdited = $postBoocle;
            }
            
            if(isset($_POST['submit'])){
                
                if(isset($_POST['post']) && (!empty($_POST['post']))){
                    $post = filter_input(INPUT_POST,"post",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                   
                    if($post && $title) {   
                        $postManager->updatePost($postEdited->getId(),$post);
                    }
                }
            }

            header("Location:index.php?ctrl=forum&action=listTopicsByCategorie&id=".$topic->getCategorie()->getId()."");
        }
    }