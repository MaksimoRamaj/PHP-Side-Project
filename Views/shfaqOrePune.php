<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../bootstrap_css/bootstrap.css">
    <link rel="stylesheet" href="Views.css">
    <title>Shfaq ore pune</title>
</head>
<body>
<?php
    //shfaq oret e punes nga from-to
    $user_id = $_POST["user_id"];

    $dita = $_POST["dita"];
    $muaj = $_POST["muaji"];
    $viti = $_POST["viti"];

    $dita_f = $_POST["dita_f"];
    $muaji_f = $_POST["muaji_f"];
    $viti_f = $_POST["viti_f"];

    if (!file_exists("../Files/${user_id}.csv")){echo "Useri nuk ka asnje ore pune!";
        echo "<br><a href='Views.php'><input  type='button' value='Faqja kryesore' class='btn btn-success' style='margin-top: 5px'></a>";
        die();};

    if(!$file = fopen("../Files/${user_id}.csv","r")){echo "File nuk nuk mund te lexohej!";die();};

    //lexo nga file midis dy periudhave

    $dateFillimi = new DateTime("${viti}-${muaj}-${dita}");
    $dateFundit = new DateTime("${viti_f}-${muaji_f}-${dita_f}");

//    var_dump($dateFillimi<$dateFundit);
//<tr><th>dita_id</th><th>user_id</th><th>working_day</th><th>festive_day</th><th>off_day</th><th>extra_hours</th><th>Data</th></tr>

    fgetcsv($file,1000,"r");
?>
<table>
    <tr><th>dita_id</th><th>user_id</th><th>Ore Pune <br> Dite Normale</th><th>Ore Pune <br>Dite Feste</th><th>Ore Pune <br>Dite Pushimi</th><th>Ore Pune <br> Shtese</th><th>Data</th></tr>
    <?php while (($row = fgetcsv($file,1000,","))!==false){
            $rowDate = new DateTime("${row[8]}-${row[7]}-${row[6]}");
            if (($rowDate>=$dateFillimi AND $rowDate<=$dateFundit)){?>
                <tr><?php for ($i=0;$i<2;$i++){?>
                    <td><?php echo $row[$i] ?></td><?php }
                    for ($i=2;$i<6;$i++){?>
                    <td><?php echo $row[$i]." H"; }?></td>
                    <td><?php  for ($i=6;$i<8;$i++){ ?>
                        <?php echo $row[$i]."/" ?>
                        <?php  } echo $row[8];?></td>
                        </tr> <?php } ?>
            <?php }
    ?>
</table>
<a href='Views.php'><input type='button' value='Faqja kryesore' class="btn btn-success" style='margin-top: 5px'></a>
</body>
</html>
