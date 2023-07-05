<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){

            $CategorieManager = new CategorieManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $CategorieManager->findAll(["categorie", "ASC"]),
                    "topics" => null,
                    "category" => null,
                ]
            ];
            
        }

        public function listTopicsByCategorie($id){
            $CategorieManager = new CategorieManager();
            $topicManager = new TopicManager();

            $category = $CategorieManager->findOneById($id);
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $CategorieManager->findAll(["categorie", "ASC"]),
                    "topics" => $topicManager->findTopicByID($id),
                    "category" => $category,
                ]
            ];
            
        }

        public function addTopic($id){
            
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            if(isset($_POST['submit'])){

                if(isset($_POST['post']) && (!empty($_POST['post'])) && isset($_POST['title']) && (!empty($_POST['title']))){
                    $post = filter_input(INPUT_POST,"post",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    

                    if($post  && $title) {

                        $idTopicPublish = $topicManager->add([
                            "title" => $title,
                            "creationdate" => date('d-m-y h:i:s'),
                            "user_id" => Session::getUser()->getId(),
                            "categorie_id" => $id,
                        ]);

                        $postManager->add([
                            "texte" => $post,
                            "creationdate" => date('d-m-y h:i:s'),
                            "topic_id" => $idTopicPublish,
                            "user_id" => Session::getUser()->getId()
                        ]);
                    }
                    header("Location:index.php?ctrl=forum&action=listTopicsByCategorie&id=$id");
                }
            }
        }

        public function profilView($id){
            $topicManager = new TopicManager();
            $userManager = new UserManager();
            $user = $userManager->findOneById($id);

            if($id == Session::getUser()->getId()){
                return [
                "view" => VIEW_DIR."forum/profil.php",
                "data" => [
                    "pseudo" => $user->getPseudo(),
                    "email" =>  $user->getEmail(),
                    "topics" => $topicManager->findTopicByID($id)
                    
                    ]
                ];
            }else {
                return [
                    "view" => VIEW_DIR."forum/profil.php",
                    "data" => [
                        "pseudo" => $user->getPseudo(),
                        "email" =>  null,
                        "topics" => $topicManager->findTopicByID($id)
                        ]
                    ];
            }
            
        }
                
    }
