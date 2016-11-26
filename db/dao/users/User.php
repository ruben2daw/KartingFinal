<?php

class User{
    
    private $id;
    private $login;
    private $firstname;
    private $lastname;
    private $password;
    private $email;
    private $role;
    private $registerdate;
    
           /*             
    function __construct($id=null,$login,$firstname,$lastname,$password,$email,$registerdate,$role){
        $this->id=$id;
        $this->login=$login;
        $this->firstname=$firstname;
        $this->lastname=$lastname;
        $this->password=$password;
        $this->email=$email;
        $this->registerdate=$registerdate;
        $this->role=$role;
    }*/


    function __toString()
    {
        return "
        </br> Mi login es " . $this->login . "
         </br>Mi nombre es " . $this->firstname . " 
        </br> Mi apellido es " . $this->lastname . "
        </br> Mi email es " . $this->email . "
         </br> fecha registro " . $this->registerdate . "
        </br> Mi role es " . $this->role;

    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param mixed $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @return mixed
     */
    public function getRegisterdate()
    {
        return $this->registerdate;
    }

    /**
     * @param mixed $registerdate
     */
    public function setRegisterdate($registerdate)
    {
        $this->registerdate = $registerdate;
    }
    

}


?>