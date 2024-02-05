<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    $svar=[];
    if(kolla_data('anvandare_id','nyckel','titel','text')){
        $anvandare_id = $_REQUEST['anvandare_id'];
        $nyckel = $_REQUEST['nyckel'];
        if(verifiera_anvandare($db,$anvandare_id,$nyckel)){
            $favorit = 0;
            if(isset($_REQUEST['favorit'])) {
                $favorit = $_REQUEST['favorit'];
            }
            $titel = $_REQUEST['titel'];
            $text = $_REQUEST['text'];
            $sql ="INSERT INTO anteckning (titel,text,skapad_datum) VALUES(?,?,now())";
            hamta_data($db,$sql,"ss", $titel, $text);
            // Error hantering om man inte kan binda den till användaren? 
            $sql ="INSERT INTO ant_anv (anvandare_id,anteckning_id,agare,favorit) VALUES(?,(SELECT LAST_INSERT_ID()),?,?)";
            hamta_data($db,$sql,"iii",$anvandare_id,$anvandare_id,$favorit);
            $svar['error']="Ok!"; //<------
        }
        else {
            $svar['error']="fel anv eller losen";
        }
        skriv_ut_svar($svar);
    }
    $db->close();
?>