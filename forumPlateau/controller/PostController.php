<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\PostManager;
    use Model\Managers\TopicManager;
    class PostController extends AbstractController implements ControllerInterface{

        public function index(){

        }

        public function listPostByTopic($id){
            $postManager = new PostManager();
            $topicManager = new TopicManager();

            $post = $postManager->findPostByTopic($id);
            $topic = $topicManager->findOneById($id);
            return [
                "view" => VIEW_DIR."forum/listPost.php",
                "data" => [
                    "posts" => $post,
                    "topic" => $topic
                ]
            ];
        }
        
        public function addPost($id){
            
            $postManager = new PostManager();
            if(isset($_POST['submit'])){

                if(isset($_POST['post']) && (!empty($_POST['post']))){
                    $post = filter_input(INPUT_POST,"post",FILTER_SANITIZE_FULL_SPECIAL_CHARS);    
                    
                    if($post) {

                        $postManager->add([
                            "texte" => $post,
                            "creationdate" => date('d-m-y h:i:s'),
                            "topic_id" => $id,
                            "user_id" => Session::getUser()->getId(),
                        ]);
                    }
                    header("Location:index.php?ctrl=post&action=listPostByTopic&id=$id");

                }
            }
        }
    }
