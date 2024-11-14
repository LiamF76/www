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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['year'])) {
    $name = htmlspecialchars($_POST['name']);
    $price = htmlspecialchars($_POST['price']);
    $year = htmlspecialchars($_POST['year']);
    
    $insert_sql = 'INSERT INTO data (name, price, year) VALUES (:name, :price, :year)';
    $stmt_insert = $pdo->prepare($insert_sql);
    $stmt_insert->execute(['name' => $name, 'price' => $price, 'year' => $year]);
}

$sql = 'SELECT name, price, year FROM data';
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Display</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Add New Entry</h2>
    <form action="index2.php" method="post">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br><br>
        <label for="price">Price:</label>
        <input type="float" id="price" name="price" required>
        <br><br>
        <label for="year">Year:</label>
        <input type="int" id="year" name="year" required>
        <br><br>
        <input type="submit" value="Add Entry">
    </form>

    <h2>Data Listing from Table 'data1'</h2>
    <table class="half-width-left-align">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Release Year</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['price']); ?></td>
                <td><?php echo htmlspecialchars($row['year']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>