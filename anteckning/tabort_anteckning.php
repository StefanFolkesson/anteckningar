<?php   
    require_once('..\db.php');
    require_once('..\funktioner.php');
    // Verifiera användaren!

    $titel = $_REQUEST['titel'];
    $text = $_REQUEST['text'];
    $anvandare_id=1;

    $sql="";
    $stmt=$db->prepare($sql);
    $stmt->bind_param(??);
    $stmt->execute();
    $result=$stmt->get_result();
    $svar = $result->fetch_assoc();
    $stmt->close();








    $svar ="";
    skriv_ut_svar($svar);
    $db->close();

?>