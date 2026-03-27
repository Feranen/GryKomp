<?php
function ConnectDB()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "gry";

    return mysqli_connect($servername, $username, $password, $dbname);
}

function GetTopGames($connection)
{

    $query = "SELECT gry.nazwa, gry.punkty FROM `gry` ORDER BY gry.punkty DESC LIMIT 5;";
    $result = mysqli_query($connection, $query);
    $temp = "";
    while ($row = mysqli_fetch_array($result)) {

        $temp = $temp . "<li> <div class='div'>{$row['nazwa']} <div class='punkt'>{$row['punkty']}</div></div> </li>";
    }
    return $temp;
}

function CenterImages($connection)
{

    $query = "SELECT gry.id, gry.nazwa, gry.zdjecie FROM `gry`;";
    $result = mysqli_query($connection, $query);
    $temp = "";
    while ($row = mysqli_fetch_array($result)) {

        $temp = $temp . "<div class='image'> <img src='{$row['zdjecie']}' alt='{$row["nazwa"]}' title='{$row['id']}'> <p>{$row['nazwa']}</p> </div>";
    }
    return $temp;
}

function AddGame($connection)
{
    if (isset($_POST["nazwa"])) {
        $nazwa = $_POST['nazwa'];
        $opis = $_POST['opis'];
        $cena = $_POST['cena'];
        $zd = $_POST['zdjecie'];
        $query = "INSERT INTO `gry`(`nazwa`, `opis`, `punkty`, `cena`, `zdjecie`) VALUES ('{$nazwa}','{$opis}',0,'{$cena}','{$zd}');";
        $result = mysqli_query($connection, $query);
        mysqli_close($connection);
        $_POST = [];

        header("Location: " . $_SERVER['PHP_SELF']);
    }
}

function DescFetcher($connection)
{
    if (isset($_POST["wybId"])) {
        $wybId = $_POST["wybId"];
        $query = "SELECT gry.nazwa, LEFT(gry.opis, 100) opis,gry.punkty, gry.cena FROM gry WHERE id = '{$wybId}';";
        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result);
        $temp = "<h2>{$row["nazwa"]}, {$row['punkty']} punktów, {$row['cena']} zł</h2> <p>{$row['opis']}</p>";
        return $temp;
    }
}

?>