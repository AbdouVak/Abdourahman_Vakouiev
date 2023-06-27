<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\PostManager;

    class TopicsController extends AbstractController implements ControllerInterface{

        public function index(){

            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR."forum/topics.php",
                "data" => [
                    "posts" => $postManager->findAll(["creationdate", "ASC"]),
                ]
            ];

            
        
        }

        

    }
