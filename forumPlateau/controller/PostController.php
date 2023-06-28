<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\PostManager;

    class PostController extends AbstractController implements ControllerInterface{

        public function index(){

        }

        public function listPostByTopic($id){
            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR."forum/listPost.php",
                "data" => [
                    "posts" => $postManager->findPostByTopic($id)
                ]
            ];
        }
        

    }
