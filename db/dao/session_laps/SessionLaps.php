<?php
/*TANDA O CARRERA*/
class SessionLaps{
    
    private $id;
    private $session_user;
    private $lap_num;
    private $time;

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
    public function getSessionUser()
    {
        return $this->session_user;
    }

    /**
     * @param mixed $session_user
     */
    public function setSessionUser($session_user)
    {
        $this->session_user = $session_user;
    }

    /**
     * @return mixed
     */
    public function getLapNum()
    {
        return $this->lap_num;
    }

    /**
     * @param mixed $lap_num
     */
    public function setLapNum($lap_num)
    {
        $this->lap_num = $lap_num;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }


  
}


?>