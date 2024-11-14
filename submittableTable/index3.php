<?php
$host = 'localhost'; 
$dbname = 'test'; 
$user = 'liam'; 
$pass = 'liam';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['entry_id']) && isset($_POST['set_name']) && isset($_POST['set_price']) && isset($_POST['set_year'])) {
        $set_name = htmlspecialchars($_POST['entry_id']);
        $set_name = htmlspecialchars($_POST['set_name']);
        $set_price = htmlspecialchars($_POST['set_price']);
        $set_year = htmlspecialchars($_POST['set_year']);
    
        $insert_sql = 'INSERT INTO legos (entry_id, set_name, set_price, set_year) VALUES (:entry_id, :set_name, :set_price, :set_year)';
        $stmt_insert = $pdo->prepare($insert_sql);
        $stmt_insert->execute(['entry_id' => $entry_id, 'set_name' => $set_name, 'set_price' => $set_price, 'set_year' => $set_year]);
    } elseif (isset($_POST['delete_id'])) {
        // Delete an entry
        $delete_id = (int) $_POST['delete_id'];
        
        $delete_sql = 'DELETE FROM legos WHERE entry_id = :entry_id';
        $stmt_delete = $pdo->prepare($delete_sql);
        $stmt_delete->execute(['entry_id' => $delete_id]);
    }
}

$sql = 'SELECT entry_id, set_name, set_price, set_year FROM legos';
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Display of Lego Sets and more.</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add New Entry</h2>
    <form action="index3.php" method="post">
        <label for="entry_id">Number:</label>
        <input type="text" id="entry_id" name="entry_id" required>
        <br><br>
        <label for="set_name">Name:</label>
        <input type="text" id="set_name" name="set_name" required>
        <br><br>
        <label for="price">Price:</label>
        <input type="set_text" id="set_price" name="set_price" required>
        <br><br>
        <label for="set_year">Year:</label>
        <input type="text" id="set_year" name="set_year" required>
        <br><br>
        <input type="submit" value="Add Entry">
    </form>

    <h1>Data Listing from Table 'legos'</h1>
    <table class="half-width-left-align">
        <thead>
            <tr>
                <th>Number</th>
                <th>Name</th>
                <th>Price</th>
                <th>Year</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['entry_id']); ?></td>
                <td><?php echo htmlspecialchars($row['set_name']); ?></td>
                <td><?php echo htmlspecialchars($row['set_price']); ?></td>
                <td><?php echo htmlspecialchars($row['set_year']); ?></td>
                <td>
                    <form action="index3.php" method="post" style="display:inline;">
                        <input type="hidden" name="delete_id" value="<?php echo $row['entry_id']; ?>">
                        <!-- <input type="submit" value="Delete"> --> 
                        <!-- this line will do a confirmation --> 
                        <input type="submit" value="Delete" onclick="return confirm('Are you sure you want to delete this entry?');">
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
