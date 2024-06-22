<form action="" method="post">
<label for="id_worker"<?php if ($_SESSION['role'] == 'Pracownik') echo 'hidden'; ?>>Podaj nr id pracownika:</label>

<input type="text" name="id_worker" id="id_worker" value="<?php echo $_SESSION['id'];?>"  <?php if ($_SESSION['role'] == 'Pracownik') echo 'hidden'; ?> ><br><br>

    <label for="calendar">Wybierz dzien:</label>
    <input type="date" name="calendar" id="calendar" autofocus><br><br>

    <?php
    switch ($_SESSION['role']) {
    case 'Pracownik': 
        echo "<label for='comment_user'>Komentarz: </label>";
        echo "<input type='comment_user' name='comment_user' id='comment_user'><br><br>";
    break;

    case 'Kierownik': 
        echo "<label for='comment_superviser'>Komentarz: </label>";
        echo "<input type='comment_superviser' name='comment_superviser' id='comment_superviser'><br><br>";
    break;

    case 'Administrator': 
        echo "<label for='comment_admin'>Komentarz: </label>";
        echo "<input type='comment_admin' name='comment_admin' id='comment_admin'><br><br>";
        break;

    default;
    echo "Wystąpił błąd z wczytaniem roli";
    break;
    } ?>

    <input type="submit" value="Dodaj komentarz">
</form>
<a href="./app/views/home.php">Powrót</a>