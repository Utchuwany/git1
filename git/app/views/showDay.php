
<form action="" method="post">
    <label for="year">Wybierz rok:</label>
    <input type="text" name="year" id="year" autofocus required><br><br>

    <label for="month">Wybierz miesiąc:</label>
    <input type="month" name="month" id="month"  required><br><br>

    <label for="id_worker"<?php if ($_SESSION['role'] == 'Pracownik') echo 'hidden'; ?>>Podaj nr id pracownika:</label>
    
    <input type="text" name="id_worker" id="id_worker" value="<?php echo $_SESSION['id'];?>"  <?php if ($_SESSION['role'] == 'Pracownik') echo 'hidden'; ?> ><br><br>

    <input type="submit" value="Pokaż historie">
</form>
<a href="./app/views/home.php">Powrót</a>