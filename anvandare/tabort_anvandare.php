<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!
    $svar=[];
    if(kolla_data('anvandare_id','nyckel')){
        $anvandare_id = $_REQUEST['anvandare_id'];
        $nyckel = $_REQUEST['nyckel'];
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            $sql="SELECT * FROM ant_anv
            WHERE anvandare_id==? ";
            $svarSQL = hamta_data($db,$sql,"ii", $anteckning_id,$anvandare_id);
            while($row = $svarSQL->fetch_assoc()){            
                $anteckning_id = $svarSQL["anteckning_id"];
                if($svarSQL["agare"] == 1){
                    $svar['error'] = "worked: owner";
                    $sql="DELETE FROM ant_anv
                    WHERE anteckning_id = ? AND anvandare_id= ?";
                    hamta_data($db,$sql,"ii", $anteckning_id,$anvandare_id);

                    $sql="SELECT anvandare_id 
                    from ant_anv 
                    WHERE anteckning_id=?";
                    $svarSQL2=hamta_data($db,$sql,"i", $anteckning_id);
                    $svarSQL2 = $svarSQL2->fetch_assoc();
                    if($svarSQL2!=null){
                        $anvandare_id2=$svarSQL2['anvandare_id'];
                        $sql="UPDATE ant_anv 
                        SET agare=1
                        WHERE anvandare_id=? AND anteckning_id=?";
                        hamta_data($db,$sql,"ii", $anvandare_id2,$anteckning_id);
                        $svar['error']="ägandeskap ändrat";
                    } else {
                        $sql ="DELETE FROM anteckning WHERE anteckning_id =?";
                        hamta_data($db,$sql,"i",$anteckning_id);
                        $sql="DELETE FROM ant_tag
                        WHERE anteckning_id = ?";
                        hamta_data($db,$sql,"i", $anteckning_id);
                    }            
                        
                } else {
                    $svar['error'] = "worked: not owner";
                    
                    $sql="DELETE FROM ant_anv
                    WHERE (anteckning_id,anvandare_id) = (?,?)";
                    hamta_data($db,$sql,"ii", $anteckning_id,$anvandare_id);
                }
            }
        }
    }
    skriv_ut_svar($svar);
    $db->close();
?>