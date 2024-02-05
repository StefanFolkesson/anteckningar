<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!
    $svar=[];
    if(kolla_data('anvandare_id','nyckel','anteckning_id')){
        $favorit="";
        $titel="";
        $text="";
        $anvandare_id = $_REQUEST['anvandare_id'];
        $nyckel = $_REQUEST['nyckel'];
        $anteckning_id = $_REQUEST['anteckning_id'];
        if(isset($_REQUEST['titel']))    
            $titel = $_REQUEST['titel'];
        if(isset($_REQUEST['text']))    
            $text = $_REQUEST['text'];
        if(isset($_REQUEST['favorit']))    
            $favorit = $_REQUEST['favorit'];
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            if($favorit!=""){
                $sql = "UPDATE ant_anv SET favorit=? WHERE anteckning_id=? AND anvandare_id=?";
                hamta_data($db,$sql,"iii", $favorit, $anteckning_id,$anvandare_id);
                $svar['error']="uppdaterad favorit, ";
            }
            $sql = "UPDATE anteckning SET";
            $bind = "";
            $vars=[];
            if ($titel!=""){
                $sql .=" titel = ?";
                $bind.="s";
                array_push($vars,$titel);
            }
            if($text!=""){
                if(count($vars)>0)
                    $sql.=",";
                $sql .=" text = ?";
                $bind.="s";
                array_push($vars,$text);
            }
            $sql.=" WHERE anteckning_id = ? ";
            array_push($vars,$anteckning_id);
            $bind.="i";
            if(count($vars)>0){
                hamta_data($db,$sql,$bind, ...$vars);
                $svar['error']="Din anteckning har blivit uppdaterad";
            }
        }
    }
    else {
        $svar['error']="fel anv eller losen";
    }
    skriv_ut_svar($svar);
    $db->close();
?>

