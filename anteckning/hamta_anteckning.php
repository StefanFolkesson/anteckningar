<?php
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!
    $svar="";
    $anvandare_id="";
    $nyckel="";
    if(isset($_REQUEST['anvandare_id'])){
        $anvandare_id = $_REQUEST['anvandare_id'];
    } else {
        $svar=$svar."Du måste ha en användare_id. ";
    }
    if(isset($_REQUEST['nyckel'])){
        $nyckel = $_REQUEST['nyckel'];
    } else {
        $svar=$svar."Du måste ha en nyckel. ";
    }
    if($svar==""){
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            $sql = "SELECT anvandare.anvandare_id,ant_anv.anteckning_id,anteckning.titel FROM anvandare 
            JOIN ant_anv ON anvandare.anvandare_id=ant_anv.anvandare_id  
            JOIN anteckning ON anteckning.anteckning_id = ant_anv.anteckning_id
            WHERE anvandare.anvandare_id = ?";
            $svar=hamta_data($db,$sql,"i", $anvandare_id)->fetch_all(MYSQLI_ASSOC);
            skriv_ut_svar($svar);
            $db->close();
        }
    }
?>