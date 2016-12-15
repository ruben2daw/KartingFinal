<?php

include 'lib/autoload.php';
include 'db/dao/sessions_users/SessionUser.php';
include 'db/dao/sessions_users/SessionsUsersDAO.php';



encodeWriteJSON(getLapsArray());
readDecodeJSON();


// Genera un tiempo aleatorio
function getRandomTime(){

    srand((double) microtime() * 1000000);

    $minutes=rand(1,3);
    $secAux=rand(0,59);
    $milisAux=rand(0,999);    
    
    if($secAux<10)
        $seconds="0".$secAux;
    else
        $seconds=$secAux;
       
    
    if($milisAux<10)
        $miliseconds="00".$milisAux;
    elseif($milisAux<100)
        $miliseconds="0".$milisAux;
    else
        $miliseconds=$milisAux;

    return "00:0".$minutes.":".$seconds.".".$miliseconds;
}



// Genera array con tiempos aleatorios
// para cada kart de la tanda
function getLapsArray(){

    $sessionUserDAO = new SessionsUsersDAO();
    $sessionDrivers=$sessionUserDAO->getAllBySession($_GET['session']);
    
    $laps=array();
    foreach($sessionDrivers as $sessDriver){
        
        $kartLaps=array();
        $kart=$sessDriver->getKart();
        $kartLaps['kart']=$kart;
        $kartLaps['laps']=array();
        for($i=1;$i<=10;$i++){
            
            
            $kartLaps['laps'][$i]=getRandomTime();
        }
        array_push($laps,$kartLaps);
        $kartLaps=null;
    
        
    }
    
    return $laps;

}


// Codifica array a JSON y escribe en fichero
function encodeWriteJSON($laps){
    

    $json=json_encode($laps, JSON_PRETTY_PRINT);
    //$fp=fopen('json/'.$_GET['session'].".json","w");
    $fp=fopen($_GET['session'].".json","w");
    if($fp){
        fwrite($fp,$json);
        fclose($fp);
    }

}



// Lee fichero y decodifica JSON
function readDecodeJSON(){

    $sessionLaps= new SessionLaps();
    $sessionLapsDao = new SessionsLapsDAO();


    $fp=fopen($_GET['session'].".json","r");

    if($fp){
        
        $json=fread($fp,filesize($_GET['session'].".json"));
        fclose($fp);


        
        $jsonKartLaps=json_decode($json);
        foreach($jsonKartLaps as $kartLaps){
          //  echo "Kart:".$kartLaps->kart."<br>";
            foreach($kartLaps->laps as $lap=>$time)
                $sessionLaps->setLapNum($lap);
                $sessionLaps->setSessionUser($_GET['session_user']);
                $sessionLaps->setTime($time);
              $sessionLapsDao->insert($sessionLaps);

            //echo "Lap ".$lap." : ".$time."<br>";
        }
    }
}

?>