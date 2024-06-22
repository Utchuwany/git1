<form action="" method="post">
    <input type="radio" id="tableName" name="tableName" value="users">
    <label for="Pracownicy">Pracownicy</label><br>
    <input type="radio" id="tableName" name="tableName" value="work">
    <label for="Praca">Tabela Pracy</label><br>

    <input type="submit" value="Wyświetl tabelę">
</form>
<a href="./app/views/home.php">Powrót</a>

<?php if (!empty($rows)): ?>
        <table border="1">
            <thead>
                <tr>
                    <?php foreach (array_keys($rows[0]) as $column): ?>
                        <th><?php echo htmlspecialchars($column); ?></th>
                    <?php endforeach; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($row as $value): ?>
                            <td><?php echo htmlspecialchars($value); ?></td>
                        <?php endforeach; ?>
                        <td>
            <!-- Edit Form -->
            <form action="/git/updateRow" method="post">
                <input type="hidden" name="tableName" value="<?php echo htmlspecialchars($tableName); ?>">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                <?php foreach ($row as $column => $value): ?>
                    <div>
                <label for="<?php echo htmlspecialchars($column); ?>"><?php echo htmlspecialchars($column); ?>:</label>
                <?php if ($column === 'date'): ?>
                <input type="date" id="<?php echo htmlspecialchars($column); ?>" name="data[<?php echo htmlspecialchars($column); ?>]" value="<?php echo htmlspecialchars($value); ?>">
                <?php elseif ($column === 'hours'): ?>
                <input type="number" id="<?php echo htmlspecialchars($column); ?>" name="data[<?php echo htmlspecialchars($column); ?>]" value="<?php echo htmlspecialchars($value); ?>">
                <?php else: ?>
                <input type="text" id="<?php echo htmlspecialchars($column); ?>" name="data[<?php echo htmlspecialchars($column); ?>]" value="<?php echo htmlspecialchars($value); ?>">
                <?php endif; ?>
        </div>
    <?php endforeach; ?>
    <input type="submit" value="Update">
</form>
            </form>
                            <!-- Delete Form -->
                            <form action="/git/deleteRow" method="post">
                                <input type="hidden" name="tableName" value="<?php echo htmlspecialchars($tableName); ?>">
                                <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>No records found</p>
    <?php endif; ?>