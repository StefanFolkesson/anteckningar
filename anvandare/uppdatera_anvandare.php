<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    
    $svar="";
    //hämta id och nyckel
    if(isset($_REQUEST ['anvandare_id'])) {
        $anvandare_id = $_REQUEST['anvandare_id'];
    } else{
        $svar=$svar."Ha ett användare id";
    }

    if(isset($_REQUEST['nyckel'])){
        $nyckel = $_REQUEST['nyckel'];
    }else{
        $svar=$svar."ha en nyckel";
    }

    if(isset($_REQUEST['nytt_namn'])){
        $nytt_namn = $_REQUEST['nytt_namn'];
    }else {
        $svar=$svar."Du har inte angivit ett användarnamn";
    }
    $anvandare_id = $_REQUEST["anvandare_id"];
    $nyckel = $_REQUEST['nyckel'];

    if(isset($_REQUEST['nytt_losen'])){
        $nytt_losen = $_REQUEST['nytt_losen'];
    } else {
        $svar=$svar."Du har inte angivit ett lösenord";
    }

    if($svar==""){
        echo['Du har inte angett ett skit'];
    }


    //verifiera användare
    if(verifiera_anvandare($db,$anvandare_id,$nyckel)){

    

        //Requesta ändringar
        

        //förbered sql fråga
        if(isset($nytt_namn)){
            $sql = "UPDATE anvandare SET namn = ? WHERE anvandare_id = ?";
            $stmt = $db->prepare($sql); 
            $stmt->bind_param("si", $nytt_namn,$anvandare_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $svar ="";  
            skriv_ut_svar($svar);
            $db->close();
        }


        if(isset($nytt_losen)){
            $sql = "UPDATE anvandare SET losen = ? WHERE anvandare_id = ?";
            $stmt = $db->prepare($sql); 
            $stmt->bind_param("si", $nytt_losen,$anvandare_id);
            $stmt->execute();
            $result = $stmt->get_result();

            $svar ="";  
            skriv_ut_svar($svar);
            $db->close();
        }

        

    }
    else {
        echo('Du är inte inloggad');
    }
?>