<?php
function skriv_ut_svar($svar){
    echo json_encode($svar);
}

// Verifiera användaren!
function verifiera_anvandare($anvandare_id,$nyckel){
    $sql="SELECT anvandare_id FROM anvandare 
          WHERE anvandare_id=? AND inloggning_nyckel=? AND nyckel_utgangstid > now()";
    $stmt=$db->prepare($sql);
    $stmt->bind_param("is",$anvandare_id,$nyckel);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows==1){
        return true;
    }
    else{
        return false;
    }  

}
?>