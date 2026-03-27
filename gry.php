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
  require("functions.php");
  $connection = ConnectDB();
  ?>
  <header>
    <h1>Ranking gier komputerowych</h1>
  </header>
  <main>
    <aside>
      <h3>Top 5 gier w tym miesiącu</h3>
      <ul>
        <?php
        echo GetTopGames($connection);
        ?>
      </ul>
      <h3>Nasz sklep</h3>
      <a href="http://sklep.gry.pl">Tu kupisz gry</a>
      <h3>Stronę wykonał</h3>
      <p>Feranen</p>
    </aside>
    <section>
      <?php
      echo CenterImages($connection);
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
        <input id="cena" name="cena" type="number" />
        <label for="zdjecie">zdjęcie</label>
        <input id="zdjecie" name="zdjecie" type="text" />
        <button type="submit">DODAJ</button>
        <?php
        AddGame($connection);
        ?>
      </form>
    </aside>
  </main>
  <footer>
    <form method="post">
      <input type="number" name="wybId" />
      <button>Pokaż opis</button>
      <?php
      echo DescFetcher($connection);
      mysqli_close($connection);
      ?>
    </form>
  </footer>
</body>

</html>