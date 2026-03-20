<!doctype html>
<html lang="pl">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Gry komputerowe</title>
  <link rel="stylesheet" href="styl.css" />
</head>

<body>
  <?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "gry";

  $conn = mysqli_connect($servername, $username, $password, $dbname);

  if (!$conn) {
    echo mysqli_error($conn);
  }
  ?>
  <header>
    <h1>Ranking gier komputerowych</h1>
  </header>
  <main>
    <aside>
      <h3>Top 5 gier w tym miesiącu</h3>
      <ul>
        <?php
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        $query = "SELECT gry.nazwa, gry.punkty FROM `gry` ORDER BY gry.punkty DESC LIMIT 5;";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_array($result)) {


          echo "<li>";
          echo "<div class='div'>{$row['nazwa']} <div class='punkt'>{$row['punkty']}</div></div>";
          echo "</li>";
        }

        mysqli_close($conn);
        ?>
      </ul>
      <h3>Nasz sklep</h3>
      <a href="http://sklep.gry.pl">Tu kupisz gry</a>
      <h3>Stronę wykonał</h3>
      <p>Feranen</p>
    </aside>
    <section>
      <?php
      $conn = mysqli_connect($servername, $username, $password, $dbname);

      $query = "SELECT gry.id, gry.nazwa, gry.zdjecie FROM `gry`;";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_array($result)) {


        echo "<div class='image'>";
        echo "<img src='{$row['zdjecie']}' alt='{$row["nazwa"]}' title='{$row['id']}''>";
        echo "<p>{$row['nazwa']}</p>";
        echo "</div>";
      }

      mysqli_close($conn);
      ?>
    </section>
    <aside>
      <h3>Dodaj nową grę</h3>
      <form method="post" class="form">
        <label for="nazwa">nazwa</label>
        <input id="nazwa" name="nazwa" type="text" />
        <label for="opis">opis</label>
        <input id="opis" name="opis" type="text" />
        <label for="cena">cena</label>
        <input id="cena" name="cena" type="text" />
        <label for="zdjecie">zdjęcie</label>
        <input id="zdjecie" name="zdjecie" type="text" />
        <button type="submit">DODAJ</button>
        <?php
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        if (isset($_POST["nazwa"]) && isset($_POST["opis"]) && isset($_POST["cena"]) && isset($_POST["zdjecie"])) {
          $query = "SELECT gry.nazwa, LEFT(gry.opis, 100) opis,gry.punkty, gry.cena FROM gry WHERE id = '{$wybId}';";
          $result = mysqli_query($conn, $query);

        }

        mysqli_close($conn);
        ?>

      </form>
    </aside>
  </main>
  <footer>
    <form method="post">
      <input type="text" name="wybId" />
      <button>Pokaż opis</button>
      <?php
      ?>
    </form>
  </footer>
</body>

</html>