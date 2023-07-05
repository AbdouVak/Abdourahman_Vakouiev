<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function findPostByTopic($id){

            $sql = "SELECT *
                    FROM " . $this->tableName." p
                    WHERE p.topic_id = :id
                    ORDER BY p.creationdate DESC";
                
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

        public function findFirstTopicPost($id){
            $sql = "SELECT *
                    FROM " . $this->tableName." p
                    WHERE p.topic_id = :id
                    ORDER BY creationdate
                    LIMIT 1";
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

        public function updatePost($id,$post){
            $sql = "UPDATE ".$this->tableName."
                    SET texte='$post' 
                    WHERE  id_".$this->tableName."=:id;";

            return DAO::delete($sql, ['id' => $id]); 
        }
    }