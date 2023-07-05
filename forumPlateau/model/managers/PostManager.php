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
                    AND creationdate=(
                        SELECT MIN(creationdate) 
                        FROM " . $this->tableName." p 
                        WHERE p.topic_id = :id)";
                
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }
    }