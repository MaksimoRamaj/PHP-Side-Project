<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oret e punes</title>
</head>
<body>

<?php
    require "../App/functions.php";

    $fileName =  "../Files/".$_POST["id"] . ".csv";
    if (file_exists($fileName)){
        if (!($file = fopen($fileName,"a"))){echo "File nuk u hap";die();};
        fclose($file);
    }else{
        if (!($file = fopen($fileName,"w"))){echo "File nuk u hap";die();};
        $array = array("dita_id","user_id","working_day","festive_day","off_day","extra","dita","muaji","viti");
        fputcsv($file,$array,",");
        fclose($file);
    }
    //hap prap filen per te lexuar dita_id
    if (!($file = fopen($fileName,"r"))){echo "File nuk u hap";die();};
    fgetcsv($file,1000,",");

    $dita_id = -1;
    while (($data = fgetcsv($file,1000,","))!==false){
        $dita_id = $data[0];
    }

    if ($dita_id==(-1)){$dita_id=0;}
    else{$dita_id++;}

    addHP($fileName,$dita_id,$_POST["id"],$_POST["wd"],$_POST["fd"],$_POST["ofd"],$_POST["extr"],$_POST["dita"],$_POST["muaji"],$_POST["viti"]);

    unset($_POST);
?>
<a href="Views.php"><input type="button" value="Faqja kryesore" style="margin-top: 5px"></a>
</body>
</html>
