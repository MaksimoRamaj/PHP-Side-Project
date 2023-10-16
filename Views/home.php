<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User</title>
    <script>
        function disableOtherInputs(inputField) {
            // Get all input fields of type "text"
            var inputFields = document.querySelectorAll('input[type="text"]');

            // Loop through the input fields
            for (var i = 0; i < inputFields.length; i++) {
                // Check if the current input field is not the one being typed in
                if (inputFields[i] !== inputField) {
                    inputFields[i].disabled = true;
                }
            }
        }
    </script>
    <link rel="stylesheet" href="Views.css">
</head>
<body>

<?php require "../App/functions.php";?>

<table class="table">
    <tbody>
    <?php
    if ( isset($_POST["user_id"]) && ($_POST["user"] == "kerkoUser") && (!empty($_POST["user_id"]))){
        $user_id = $_POST["user_id"];
        getUser("../Files/user.csv",$user_id);
        $data =  getUser("../Files/user.csv",$user_id);
        $hpages = getPagesaPerHour("../Files/feePerHourInAD.csv",$user_id)?>
            <?php if (!empty($data) || !empty($hpages)){?>
            <tr>
                <th>id_user</th>
                <th>user</th>
                <th>username</th>
                <th>H/P normale</th>
                <th>H/P dite feste</th>
                <th>H/P pushimi</th>
                <th>H/P orare shtese</th>
            </tr>
            <tr>
            <?php for($i=0;$i<3;$i++){?>
                    <td><?php echo $data[$i]?></td>
                <?php } ?>
            <?php for($i=1;$i<=4;$i++){?>
                        <td><?php echo $hpages[$i]."$"?></td>
                    <?php } ?>
            </tr>
            <?php }else echo "User not found!";
        }
    elseif (isset($_POST["user_id"]) && ($_POST["user"] == "shtoUser") && (!empty($_POST["user_id"]))){ $user_id = $_POST["user_id"];
        if (!empty(getUser("../Files/user.csv",$_POST["user_id"]))){
            echo "Useri ekziston!";
        } else{?>

        <tr>
            <form action="regjistroUser.php" method="post">
                <td>id: <input type="number" value="<?php echo $_POST["user_id"];?>" name="prop0"></td>
                <td>User: <input type="text" name="prop1"></td>
                <td>Username: <input type="text" name="prop2"></td>
                <td>Pagesa per Working/H: <input type="number" name="prop3" oninput="disableOtherInputs(this)"></td>
                <td>Festive/H: <input type="number" name="prop4" oninput="disableOtherInputs(this)"></td>
                <td>Off/H: <input type="number" name="prop5" oninput="disableOtherInputs(this)"></td>
                <td>Extra/H: <input type="number" name="prop6"></td>
                <td><input type="submit" value="submit"></td>
            </form>
        </tr>
    <?php }}
    elseif (isset($_POST["user_id"]) && ($_POST["user"] == "shtoOrePune") && (!empty($_POST["user_id"]))){
        if (!getUser("../Files/user.csv",$_POST["user_id"])){echo "Useri nuk ekziston!";die();};
        $currentDate = date("Y-m-d");
        list($year,$month,$day) = explode("-",$currentDate); ?>
            <form action="orePune.php" method="post">
                <tr>
                    <td>id: <input type="number" value="<?php echo $_POST["user_id"];?>" name="id"></td>
                    <td>W/H: <input type="number" name="wd" value="0"></td>
                    <td>F/H: <input type="number" name="fd" value="0"></td>
                    <td>Off/H: <input type="number" name="ofd" value="0"></td>
                    <td>extra/H: <input type="number" name="extr" value="0"></td>
                </tr>
                <tr>
                    <td>Dita: <input type="number" name="dita" value="<?php echo $day ?>"></td>
                    <td>Muaji: <input type="number" name="muaji" value="<?php echo $month ?>"></td>
                    <td>Viti: <input type="number" name="viti" value="<?php echo $year ?>"></td>
                </tr>
                <tr>
                    <td><input type="submit" value="submit"></td>
                </tr>
            </form>
    <?php }
    elseif (isset($_POST["user_id"]) && ($_POST["user"] == "shfaqHP") && (!empty($_POST["user_id"]))){
        $currentDate = date("Y-m-d");
        list($year,$month,$day) = explode("-",$currentDate);
        if (!getUser("../Files/user.csv",$_POST["user_id"])){echo "Useri nuk ekziston!";die();};?>
       <form action="shfaqOrePune.php" method="post">
            <tr>
                <td>Zgjidhni periudhen!</td>
                <td>User id: <input type="number" name="user_id" value="<?php echo $_POST["user_id"] ?>" ></td>
            </tr>
            <tr>
                <td>
                    From:
                </td>
                <td>Dita:<input type="number" name="dita"></td>
                <td>Muaji:<input type="number" name="muaji"></td>
                <td>Viti:<input type="number" name="viti"></td>
            </tr>
           <tr>
               <td>
                   To:
               </td>
               <td>Dita:<input type="number" name="dita_f" value="<?php echo $day ?>"></td>
               <td>Muaji:<input type="number" name="muaji_f" value="<?php echo $month ?>"></td>
               <td>Viti:<input type="number" name="viti_f" value="<?php echo $year ?>"></td>
           </tr>
           <tr>
               <td>
                   <input type="submit" value="submit">
               </td>
           </tr>
       </form>
    <?php }elseif($_POST["user"] == "shfaqUser"){
        $file = fopen("..\Files\user.csv","r");
        if (!$file){echo "File nuk u hap!";}else{
            fgetcsv($file,1000,",");
            while (($data = fgetcsv($file,1000,","))!==false){
                ?>
    <tr>
        <td>Id: <?php echo $data[0] ?></td>
        <td>User: <?php echo $data[1] ?></td>
        <td>Username: <?php echo $data[2] ?></td>
    </tr>
            <?php }
        }
    }else{
        echo "Inputi Gabim!";
    }?>
    </tbody>
</table>
<a href="Views.php"><input type="button" value="Faqja kryesore" style="margin-top: 5px"></a>
</body>
</html>

