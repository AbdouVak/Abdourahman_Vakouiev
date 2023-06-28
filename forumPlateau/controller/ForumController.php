<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\CategorieManager;

    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){

            $CategorieManager = new CategorieManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $CategorieManager->findAll(["categorie", "ASC"]),
                    "topics" => $topicManager->findAll(["creationdate", "DESC"])
                ]
            ];
            
        }

        public function listTopicsByCategorie($id) {
            $CategorieManager = new CategorieManager();
            $topicManager = new TopicManager();
            
            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "categories" => $CategorieManager->findAll(["categorie", "ASC"]),
                    "topics" => $topicManager->findTopicByID($id)
                ]
            ];
            
        }
    }
