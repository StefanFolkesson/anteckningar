<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    
    $svar=[];
    if(kolla_data('anvandare_id','nyckel')){
        $anvandare_id = $_REQUEST['anvandare_id'];
        $nyckel = $_REQUEST['nyckel'];
        $nytt_losen="";
        $nytt_namn="";
        if(isset($_REQUEST['nytt_namn'])){
            $nytt_namn = $_REQUEST['nytt_namn'];
        }
        if(isset($_REQUEST['nytt_losen'])){
            $nytt_losen = $_REQUEST['nytt_losen'];
        }
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            if($nytt_namn!=""){
                echo $nytt_namn;
                $sql = "UPDATE anvandare SET namn = ? WHERE anvandare_id = ?";
                hamta_data($db,$sql,"si", $nytt_namn,$anvandare_id);
                $svar['error'] ="NAMN"; 
            }
            if($nytt_losen!=""){
                $sql = "UPDATE anvandare SET losen = ? WHERE anvandare_id = ?";
                hamta_data($db,$sql,"si",  $nytt_losen,$anvandare_id);
                $svar['error'] ="losen"; 
            }
        }  
        else {
            $svar['error']='ingen inloggning';
        }      
    }
    else {
        $svar['error']="aööt är fel";
    }
    skriv_ut_svar($svar);  
    $db->close();

?>