<?php
$host = 'localhost'; 
$dbname = '351final'; 
$user = 'root'; 
$pass = 'mysql';
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

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['phrase'])) {
    $ID = htmlspecialchars($_POST['ID']);
    $phrase = htmlspecialchars($_POST['phrase']);
    
    $insert_sql = 'INSERT INTO data (ID, phrase) VALUES (:ID, :phrase)';
    $stmt_insert = $pdo->prepare($insert_sql);
    $stmt_insert->execute(['ID' => $ID, 'phrase' => $phrase]);
}

$sql = 'SELECT ID, phrase FROM data';
$stmt = $pdo->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TDC Quotes</title>
</head>
<body>
    <h1 style="text-align: center;">
        Liam's Dark Crystal Quotes Compendium in Association with the people's Republic of Thra
    </h1>
    <h3>Management Page:</h3>

    <h2>Add New Entry</h2>

    <form action="manage.php" method="post">
        <label for="phrase">Phrase:</label>
        <input type="phrase" id="phrase" name="phrase" required>
        <br><br>
        <input type="submit" value="Add Entry">
    </form>

    <br>
    <button onclick="location.href='frontEnd.php';">Open Index</button>
</body>
</html>