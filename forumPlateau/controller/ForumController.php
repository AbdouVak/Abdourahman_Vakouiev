<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;
    use Model\Managers\PostManager;
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){

            $CategorieManager = new CategorieManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $CategorieManager->findAll(["categorie", "ASC"]),
                    "topics" => null,
                    "addTopic" => false,
                    "IDCategorie" => null,
                    "categoryNames" => null
                ]
            ];
            
        }

        public function listTopicsByCategorie($id){
            $CategorieManager = new CategorieManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $CategorieManager->findAll(["categorie", "ASC"]),
                    "topics" => $topicManager->findTopicByID($id),
                    "addTopic" => true,
                    "IDCategorie" => $id,
                    "categoryNames" => $CategorieManager->categorieName($id)
                ]
            ];
            
        }

        public function addTopic($id){
            
            $topicManager = new TopicManager();
            $postManager = new PostManager();

            if(isset($_POST['submit'])){

                if(isset($_POST['post']) && (!empty($_POST['post']))){
                    $post = filter_input(INPUT_POST,"post",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    
                    
                    if($post && $title) {
                        $idTopicPublish = $topicManager->add([
                            "title" => $title,
                            "creationdate" => date('d-m-y h:i:s'),
                            "user_id" => 1,
                            "closed" => "open",
                            "categorie_id" => $id,
                        ]);

                        $postManager->add([
                            "texte" => $post,
                            "creationdate" => date('d-m-y h:i:s'),
                            "topic_id" => $idTopicPublish,
                            "user_id" => 1
                        ]);
                    }
                    
                    header("Location:index.php?ctrl=forum&action=listTopicsByCategorie&id=$id");
                }
            }
        }
    }
