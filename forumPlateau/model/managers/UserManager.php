<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function checkPseudo($pseudo){

            $sql = "SELECT *
                    FROM " . $this->tableName." u
                    WHERE u.pseudo = :pseudo";
                
            return $this->getMultipleResults(
                DAO::select($sql, ['pseudo' => $pseudo]),
                $this->className
            );
        }

        public function checkMail($email){

            $sql = "SELECT *
                    FROM " . $this->tableName." u
                    WHERE u.email = :email";
                
            return $this->getMultipleResults(
                DAO::select($sql, ['email' => $email]),
                $this->className
            );
        }

        public function retrievePassword($email){
            $sql = "SELECT *
                    FROM " . $this->tableName." u
                    WHERE u.email = :email";
                
            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email],false),
                $this->className
            );
        }

        public function findOneBYEmail($email){
            $sql = "SELECT *
                    FROM " . $this->tableName." u
                    WHERE u.email = :email";
                
            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email],false),
                $this->className
            );
        }

        
    }