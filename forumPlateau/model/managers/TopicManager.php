<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\TopicManager;

    class TopicManager extends Manager{

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function findTopicByID($id){

            $sql = "SELECT *
                    FROM " . $this->tableName." p
                    WHERE p.categorie_id = :id";
                
            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id]),
                $this->className
            );
        }

        public function changeStatus($id,$status){
            $sql = "UPDATE ".$this->tableName." 
                SET `status`= '".$status."'
                WHERE  id_".$this->tableName."=:id;";

            return DAO::delete($sql, ['id' => $id]); 
        }

        public function updateTilte($id,$title){
            $sql = "UPDATE ".$this->tableName."
                    SET title='$title' 
                    WHERE  id_".$this->tableName."=:id;";

            return DAO::delete($sql, ['id' => $id]); 
        }
    }