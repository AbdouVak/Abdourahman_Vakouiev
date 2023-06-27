<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $pseudo;
        private $motDePasse;
        private $dateInscription;
        private $role;
        private $email;

        public function __construct($data){         
            $this->hydrate($data);        
        }
 
        /**
         * Get the value of id
         */ 
        public function getId()
        {
                return $this->id;
        }

        /**
         * Set the value of id
         *
         * @return  self
         */ 
        public function setId($id)
        {
                $this->id = $id;

                return $this;
        }

        /**
         * Get the value of pseudo
         */ 
        public function getPseudo()
        {
                return $this->pseudo;
        }

        /**
         * Set the value of pseudo
         *
         * @return  self
         */ 
        public function setPseudo($pseudo)
        {
                $this->pseudo = $pseudo;

                return $this;
        }

        /**
         * Get the value of motDePasse
         */ 
        public function getMotDePasse()
        {
                return $this->motDePasse;
        }

        /**
         * Set the value of motDePasse
         *
         * @return  self
         */ 
        public function setMotDePasse($motDePasse)
        {
                $this->motDePasse = $motDePasse;

                return $this;
        }

        /**
         * Get the value of dateInscription
         */ 
        public function getDateInscription()
        {
                return $this->dateInscription;
        }

        /**
         * Set the value of dateInscription
         *
         * @return  self
         */ 
        public function setDateInscription($dateInscription)
        {
                $this->dateInscription = $dateInscription;

                return $this;
        }

        /**
         * Get the value of role
         */ 
        public function getRole()
        {
                return $this->role;
        }

        /**
         * Set the value of role
         *
         * @return  self
         */ 
        public function setRole($role)
        {
                $this->role = $role;

                return $this;
        }

        /**
         * Get the value of email
         */ 
        public function getEmail()
        {
                return $this->email;
        }

        /**
         * Set the value of email
         *
         * @return  self
         */ 
        public function setEmail($email)
        {
                $this->email = $email;

                return $this;
        }
    }