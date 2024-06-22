<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Wyświetlanie i edycja użytkownika</title>
</head>
<body>
    <h1>Wyświetlanie i edycja użytkownika</h1>
    
    <?php if (!empty($user)) : ?>
        <form action="/git/updateUser" method="post">
            <input type="text" name="id" value="<?php echo $user['id']; ?>">
            <label for="name">Imię:</label>
            <input type="text" id="name" name="name" value="<?php echo $user['name']; ?>"><br><br>
            <label for="surname">Nazwisko:</label>
            <input type="text" id="surname" name="surname" value="<?php echo $user['surname']; ?>"><br><br>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $user['email']; ?>"><br><br>
            <label for="role">Rola:</label>
            <select id="role" name="role">
                <option value="Pracownik" <?php echo ($user['role'] === 'Pracownik') ? 'selected' : ''; ?>>Pracownik</option>
                <option value="Kierownik" <?php echo ($user['role'] === 'Kierownik') ? 'selected' : ''; ?>>Kierownik</option>
                <option value="Administrator" <?php echo ($user['role'] === 'Administrator') ? 'selected' : ''; ?>>Administrator</option>
            </select><br><br>
            <label for="active">Aktywny:</label>
            <input type="checkbox" id="active" name="active" value="1" <?php echo ($user['active'] == 1) ? 'checked' : ''; ?>><br><br>
            <input type="submit" value="Zapisz zmiany">
        </form>
        
        <form action="/git/deleteUser" method="post">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type="submit" value="Usuń użytkownika">
        </form>
    <?php else : ?>
        <p>Brak danych użytkownika o podanym ID.</p>
    <?php endif; ?>
    
    <a href="./app/views/home.php">Powrót</a>
</body>
</html>
