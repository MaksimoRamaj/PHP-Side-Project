<!doctype html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagesa</title>
    <link rel="stylesheet" href="Views.css">
    <link rel="stylesheet" href="../bootstrap_css/bootstrap.css">
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
    (int) $ore = [
            'work' => 0,
            'festive' => 0,
            'off' => 0,
            'extra' => 0,
            ];
    while (($row = fgetcsv($file,1000,","))!==false){
            $rowDate = new DateTime("${row[8]}-${row[7]}-${row[6]}");
            if (($rowDate>=$dateFillimi and $rowDate<=$dateFundit)){
                 $ore['work'] = $ore['work'] + (int) $row[2];
                 $ore['festive'] = $ore['festive'] + (int) $row[3];
                 $ore['off'] = $ore['off'] + (int) $row[4];
                 $ore['extra'] = $ore['extra'] + (int) $row[5];
            }
    }
    //u moren oret e punes per periudhen e caktuar tashme marrim tarifimin per ore
    fclose($file);
    $fee = [
            'work' => 0,
            'festive' => 0,
            'off' => 0,
            'extra' => 0,
];
    if (!($tarifaFile = fopen("../Files/feePerHourInAd.csv",'r'))){echo "File e tarifave nuk u hap!";};
    //heq rreshtin e pare
    if (!fgetcsv($tarifaFile,1000,",")){echo "File e tarifave nuk u hap!";};
    while (($data = fgetcsv($tarifaFile,1000,","))!=false){
        if ($data[0]==$user_id){
            $fee['work'] = $data[1];
            $fee['festive'] = $data[2];
            $fee['off'] = $data[3];
            $fee['extra'] = $data[4];
            break;
    }}
?>
<table>
    <tr><td>User me id: <?php echo $user_id?></td><td>Per periudhen: <?php echo "$dita/$muaj/$viti - $dita_f/$muaji_f/$viti_f";?></td></tr>
    <tr><td>Work Day</td><td>Ore pune total: <?php echo $ore['work'] ?></td><td>Paguar per ore: <?php echo $fee['work'] . "$" ?> </td> <td>Total: <?php echo ($fee['work']*$ore['work']) . "$" ?> </td></tr>
    <tr><td>Festive Day</td><td>Ore pune total: <?php echo $ore['festive'] ?></td><td>Paguar per ore: <?php echo $fee['festive'] . "$" ?> </td> <td>Total: <?php echo ($fee['festive']*$ore['festive']) . "$" ?> </td></tr>
    <tr><td>Off Day</td><td>Ore pune total: <?php echo $ore['off'] ?></td><td>Paguar per ore: <?php echo $fee['off'] . "$" ?> </td> <td>Total: <?php echo ($fee['off']*$ore['off']) . "$" ?> </td></tr>
    <tr><td>Extra Day</td><td>Ore pune total: <?php echo $ore['extra'] ?></td><td>Paguar per ore: <?php echo $fee['extra'] . "$" ?> </td> <td>Total: <?php echo ($fee['extra']*$ore['extra']) . "$" ?> </td></tr>
</table>
<a href="Views.php"><input type="button" value="Faqja kryesore" style="margin-top: 5px" class="btn btn-success"></a>
</body>
</html>