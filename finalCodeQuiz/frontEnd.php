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

    <table style ="border: 1px solid black; border-collapse: collapse;">
        <thead>
            <tr style ="border: 1px solid black; border-collapse: collapse;">
                <th style ="border: 1px solid black; border-collapse: collapse;">ID: </th>
                <th style ="border: 1px solid black; border-collapse: collapse;">Phrase:</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $stmt->fetch()): ?>
            <tr style ="border: 1px solid black; border-collapse: collapse;">
                <td style ="border: 1px solid black; border-collapse: collapse;">
                    <?php echo htmlspecialchars($row['ID']); ?></td>
                <td style ="border: 1px solid black; border-collapse: collapse;">
                    <?php echo htmlspecialchars($row['phrase']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <br>
    <button onclick="location.href='manage.php';">Open Manager</button>

</body>
</html>