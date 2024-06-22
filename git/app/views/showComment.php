<form action="" method="post">
    <label for="id_worker"<?php if ($_SESSION['role'] == 'Pracownik') echo 'hidden'; ?>>Podaj nr id pracownika:</label>

    <input type="text" name="id_worker" id="id_worker" value="<?php echo $_SESSION['id'];?>"  <?php if ($_SESSION['role'] == 'Pracownik') echo 'hidden'; ?> ><br><br>

    <input type="submit" value="Wprowadzenie">
</form>
<a href="./app/views/home.php">Powrót</a>