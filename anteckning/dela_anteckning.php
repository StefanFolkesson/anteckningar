<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    $svar=[];
    if(kolla_data('anvandare_id','nyckel','van_id','anteckning_id')){
        $anvandare_id = $_REQUEST['anvandare_id'];
        $nyckel = $_REQUEST['nyckel'];
        $van_id=$_REQUEST['van_id'];
        $anteckning_id=$_REQUEST['anteckning_id'];
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            //Lägga till vän
            $sql ="INSERT INTO ant_anv (anvandare_id,anteckning_id,agare,favorit) 
            VALUES(?,(SELECT LAST_INSERT_ID()),?,?)";
            hamta_data($db,$sql,"iii",$anvandare_id,$anvandare_id,$favorit);
    }
    else {
        $svar['error']="fel anv eller losen";
    }
    skriv_ut_svar($svar);
}
    $db->close();
?>