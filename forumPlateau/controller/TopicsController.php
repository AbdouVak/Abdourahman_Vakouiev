<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicsManager;

    class TopicsController extends AbstractController implements ControllerInterface{

        public function index(){

            $topicManager = new TopicsManager();

            return [
                "view" => VIEW_DIR."forum/listTopic.php",
                "data" => [
                    "topics" => $topicManager->findOneById($id)
                ]
            ];

            
        
        }

        

    }
