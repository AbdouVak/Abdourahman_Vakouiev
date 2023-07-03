<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    
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

                                    $this->redirectTo("security","registerView");

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
                                
                                if($user->getStatus()){
                                    
                                    Session::SetUser($user);
                                }
                            }else{
                                Session::addFlash("error","mot de passe incorrect");
                            }
                        }
                    }
                }
            }
            
            $this->redirectTo("security","loginView");
        }

        function password_verify($password,$hash){
            if($password === $hash){
                return true;
            }else{
                return false;
            }
            
        }
    }