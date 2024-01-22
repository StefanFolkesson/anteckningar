<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');

    $namn=$_REQUEST['namn'];
    $losen=$_REQUEST['losen'];
    
    $sql="SELECT anvandare_id FROM anvandare WHERE namn=? AND losen=?";
    $stmt=$db->prepare($sql);
    $stmt->bind_param("ss",$namn,$losen);
    $stmt->execute();
    $resultat=$stmt->get_result();
    if($resultat->num_rows==1){
        $svar = $resultat->fetch_assoc();
        $anvandare_id=$svar['anvandare_id'];
        $inloggning_nyckel="asdasd";//skapa_nyckel();
        $sql="UPDATE anvandare 
              SET inloggning_nyckel=? , nyckel_utgangstid= now() + interval 10 minute 
              WHERE anvandare_id=?";
        $stmt=$db->prepare($sql);
        $stmt->bind_param("si",$inloggning_nyckel,$anvandare_id);
        $stmt->execute();
        $resultat=$stmt->get_result();

        // Vad händer här?
    }
    




    $svar =[];  // Nyckeln och användarid
    $svar['nyckel']=$inloggning_nyckel;// = $inloggning_nyckel;
    $svar['anvandare_id']=$anvandare_id;// = $anvandare_id;  
    skriv_ut_svar($svar);
    $db->close();
?>