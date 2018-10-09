<?php
if(isset($_POST['submit']) && (isset($_GET['tel'])) && (!empty($_GET['tel']))){
//    echo "<pre>";
//    var_dump($_POST);
//    var_dump($_GET);
//    echo "</pre>";

    $email = $_POST['email'];
    $tel = $_GET['tel'];
    $list = array(array($tel.";".$email.";".md5($tel)));

    $fp = fopen('file.csv', 'a');
    fputs($fp, $bom =( chr(0xEF) . chr(0xBB) . chr(0xBF) ));
    foreach ($list as $fields) {
        fputcsv($fp,$fields);
    }
    fclose($fp);
}else if((isset($_GET['email'])) && (isset($_GET['token']))){
    $email = $_GET['email'];
    $token = $_GET['token'];

    $row = 1;
    if (($handle = fopen("file.csv", "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $num = count($data);
            $row++;
            for ($c=0; $c < $num; $c++) {
                echo $data[$c] . "<br />\n";
                $list[]=$data[$c];
            }
        }
        fclose($handle);
    }

    

    foreach ($list as $key=>$value){
        $value = explode(";", $value);
        //echo $key."->".$value[1]." and ".$value[2]."<br />\n";

        if(($email == $value[1]) && ($token==$value[2])){
            echo "All OK";
        }else{
            continue;
        }
    }

    exit();
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <title>Test Landing Page</title>
    <meta name="description" content="description">
    <meta name="keywords" content="keywords">

    <link rel="stylesheet" href="css/main-style.css">

    <script src="js/jquery-3.3.1.min.js"></script>
</head>
<body>
    <div class="wrapper">
        <header>Header Block</header>
        <div class="mainBlock">
            <h4>Оновіть мейл</h4>
            <form action="<?=$PHP_SELF?>" method="post">
                <label for="email">New email:</label><br/>
                <input type="email" name="email"><br/>
                <input type="submit" name="submit">
            </form>
        </div>
        <footer>Footer block</footer>
    </div>

<srcript src="js/main-script.js"></srcript>
</body>
</html>