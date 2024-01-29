<?php
function skriv_ut_svar($svar){
    echo json_encode($svar);
}

// Verifiera användaren!
function verifiera_anvandare($db,$anvandare_id,$nyckel){
    $sql="SELECT anvandare_id FROM anvandare 
          WHERE anvandare_id=? AND inloggning_nyckel=? AND nyckel_utgangstid > now()";
    $stmt=$db->prepare($sql);
    $stmt->bind_param("is",$anvandare_id,$nyckel);
    $stmt->execute();
    $result=$stmt->get_result();
    if($result->num_rows==1){
        // Uppdatera användaren
        $sql="UPDATE anvandare 
        SET nyckel_utgangstid= now() + interval 30 minute 
        WHERE anvandare_id=?";
        $stmt=$db->prepare($sql);
        $stmt->bind_param("i",$anvandare_id);
        $stmt->execute();
        $resultat=$stmt->get_result();
        return true;
    }
    else{
        return false;
    }  
}
function hamta_data($db,$sql,$bind,...$var){
    $stmt = $db->prepare($sql); 
    $stmt->bind_param($bind, ...$var);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}
?>