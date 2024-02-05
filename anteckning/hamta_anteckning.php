<?php
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!
    $svar=[];
    if(kolla_data('anvandare_id','nyckel')){
        $anvandare_id = $_REQUEST['anvandare_id'];
        $nyckel = $_REQUEST['nyckel'];
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            $sql = "SELECT anvandare.anvandare_id,ant_anv.anteckning_id,anteckning.titel FROM anvandare 
            JOIN ant_anv ON anvandare.anvandare_id=ant_anv.anvandare_id  
            JOIN anteckning ON anteckning.anteckning_id = ant_anv.anteckning_id
            WHERE anvandare.anvandare_id = ?";
            $svar=hamta_data($db,$sql,"i", $anvandare_id)->fetch_all(MYSQLI_ASSOC);
        }
        else {
            $svar['error']="fel anv eller losen";
        }
        skriv_ut_svar($svar);
    }
    $db->close();
?>