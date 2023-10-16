<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Regjistrim useri</title>
</head>

<body>

    <?php require "../App/functions.php";
        $id = $_POST["prop0"];
        $user = $_POST["prop1"];
        $username = $_POST["prop2"];
        $salaryId = $_POST["prop3"];

        $wd = $_POST["prop3"];
        $fd = $_POST["prop4"];
        $od = $_POST["prop5"];
        $ex = $_POST["prop6"];

        if (!empty($_POST)){ appendUser("../Files/user.csv",$id,$user,$username,$salaryId);}
        pagesaPerUser("../Files/feePerHourInAD.csv",$id,$wd,$fd,$od,$ex);
        ?>

    <a href="Views.php"><input type="button" value="Faqja kryesore" style="margin-top: 5px"></a>
</body>
</html>
