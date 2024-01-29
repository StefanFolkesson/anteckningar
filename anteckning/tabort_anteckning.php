<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!

    $anvandare_id = $_REQUEST['anvandare_id'];
    $anteckning_id = $_REQUEST['anteckning_id'];
    $nyckel = $_REQUEST['nyckel'];

    if(!isset($anteckning_id)||!isset($anvandare_id)||!isset($nyckel)){
        $svar = "Användar id, antecknings id eller nyckel blev inte skickade";
        skriv_ut_svar($svar);
        $db->close();
        die;
    }

    if(verifiera_anvandare($db,$anvandare_id,$nyckel)){

        $sql="SELECT agare FROM ant_anv 
        WHERE (anteckning_id,anvandare_id) = (?,?)";
        $stmt=$db->prepare($sql);
        $stmt->bind_param("ii", $anteckning_id,$anvandare_id);
        $stmt->execute();
        $result=$stmt->get_result();
        $svar = $result->fetch_assoc();
        $stmt->close();
        if($svar["agare"] == 1){
            $svar = "worked: owner";
            
            $sql="DELETE FROM ant_anv
            WHERE anteckning_id = ?";
            $stmt=$db->prepare($sql);
            $stmt->bind_param("i", $anteckning_id);
            $stmt->execute();
            $result=$stmt->get_result();
            $stmt->close();

            $sql="DELETE FROM ant_tag
            WHERE anteckning_id = ?";
            $stmt=$db->prepare($sql);
            $stmt->bind_param("i", $anteckning_id);
            $stmt->execute();
            $result=$stmt->get_result();
            $stmt->close();
    
            $sql="DELETE FROM anteckning 
            WHERE anteckning_id = ?";
            $stmt=$db->prepare($sql);
            $stmt->bind_param("i", $anteckning_id);
            $stmt->execute();
            $result=$stmt->get_result();
            $stmt->close();
            
        } else {
            $svar = "worked: not owner";
            
            $sql="DELETE FROM ant_anv
            WHERE (anteckning_id,anvandare_id) = (?,?)";
            $stmt=$db->prepare($sql);
            $stmt->bind_param("ii", $anteckning_id,$anvandare_id);
            $stmt->execute();
            $result=$stmt->get_result();
            $stmt->close();
            
        }
    } else {
        $svar = "inkorrekt nyckel";
    }


    skriv_ut_svar($svar);
    $db->close();

?>