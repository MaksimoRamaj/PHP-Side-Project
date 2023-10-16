<?php

declare(strict_types=1);

function appendUser(string $filePath,int $id,string $user,string $username){
    $file = fopen($filePath,"a");
    if (!$file){
        return false;
    }
    //nese data nuk eshte bosh dmth qe useri me te njejten id ekziston
    $data = getUser($filePath,$id);
    if (!empty($data)){
        echo "Useri me id = {$id} ekziston";
        return false;
    }

    if (!fputcsv($file,array($id,$user,$username))){
        return false;
    }
    echo "Useri u shtua!";
    return true;
}

function pagesaPerUser(string $filepath,int $id,string $wd,string $fd,string $od,string $extra){
    $pagesa = [$id,$wd,$fd,$od,$extra];
    $file = fopen($filepath,"r+");
    if (!$file){
        echo "Hapja e files deshtoi";
        die();
    }
    $newData = array($id,$wd,$fd,$od,$extra);
    //kontrollojm nese useri ekziston
    $data = getUser($filepath,$id);
    if (empty($data)){
        //useri nuk u gjet
        if (fseek($file,0,SEEK_END)==(-1)){
            echo "Fseek nuk u arrit!";
            die();
        }else{
            if (fputcsv($file,$newData)){
                echo "Te dhenat u shtuan ne fund te files si rekord i ri!";
                return;
            };
        };
    }else{
        //useri ekziston por kerkohet updatim i te dhenave
        fclose($file);
        updateCsv($filepath,$newData);
    }
}

function updateCsv(string $filepath,array $array){
    $file = fopen($filepath,"r");
    if (!$file){die("File nuk u hap");}
    $modifiedData = [];
    fgetcsv($file,1000,",");
    while (($data = fgetcsv($file,1000,","))!==false){
        if ($data[0]==$array[1]){
            continue;
        }else{
            $modifiedData[] = $data;
        }
    }
    fclose($file);
    //kalo te dhenat nga array ne file
    $file = fopen($filepath,"w");
    if (!$file){die("File nuk u hap");}

    if (!fputcsv($file,array("user_id","working_day","festive_day","off_day","extra"),",")){die("update files deshtoi");};

    foreach ($modifiedData as $row){
        if (!fputcsv($file,$row)){
            die("Modifikimi files deshtoi!");
        };
    }
    fclose($file);
}

function getUser(string $filePath,int $user_id):array|bool{
    $file = fopen($filePath,"r");
    if (!$file){
        echo "File not opened";
        die();
    }
    $data = fgetcsv($file,1000,",");
    while ( ($data = fgetcsv($file,1000,",")) !== false){
        if ($data[0] == $user_id){
            return $data;
        }
    }
    return false;
}

function getPagesaPerHour(string $filepath,int $user_id):array{
    $file = fopen($filepath,"r");
    if (!$file){
        echo "getPGH file error";
        die();
    }
    fgetcsv($file,1000,",");
    while ( ($data = fgetcsv($file,1000,",")) !== false){
        if ($data[0] == $user_id){
            return $data;
        }
    }
    echo "GetPage Fail";
    return [];
}

function addHP(string $filePath,int $dita_id,int $id,string $wd,string $fd,string $ofd,string $extr,int $dita,int $muaji,int $viti){

    if(!$file = fopen($filePath,"r")){echo "File nuk u hap!";die();};

    $input = array($dita_id,$id,$wd,$fd,$ofd,$extr,$dita,$muaji,$viti);

    fgetcsv($file,1000,",");

    while (($data = fgetcsv($file,1000,",")) !== false){
        if ($data[1]==$id AND $data[6]==$dita AND $data[7]==$muaji AND $data[8]==$viti){
            echo "Dita figuron e regjistruar ne file!";
            echo "<a href='Views.php'><input type='button' value='Faqja kryesore' style='margin-top: 5px'></a>";
            die();
        }
    }

    if (!fclose($file)){echo "File nuk u mbyll dot!";die();};
    if(!$file = fopen($filePath,"a")){echo "File nuk u hap!";die();};
    if(!fputcsv($file,$input,",")){echo "addHP:nuk u shtuan!";die();};
    fclose($file);
    echo "Oret u shtuan!\n";
}



