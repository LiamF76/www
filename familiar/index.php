<?php
  $host = 'localhost'; 
  $data = 'villagers'; 
  $user = 'liam'; 
  $pass = 'liam';
  $chrs = 'utf8mb4';
  $attr = "mysql:host=$host;dbname=$data;charset=$chrs";
  $opts =
  [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
  ];

  try {
    $pdo = new PDO($attr, $user, $pass, $opts);
  }
  catch (PDOException $e) {
    throw new PDOException($e->getMessage(), (int)$e->getCode());
  }

  if (isset($_POST['delete']) && isset($_POST['vname'])) {
    $vname   = $pdo->quote($_POST['vname']);
    $query  = "DELETE FROM vdata WHERE vname=$vname";
    $result = $pdo->query($query);
  }
  if (isset($_POST['vname'])   &&
      isset($_POST['species']) &&
      isset($_POST['month']) &&
      isset($_POST['day']) &&
      isset($_POST['diet'])) {
    $vname     = $pdo->quote($_POST['vname']);
    $species   = $pdo->quote($_POST['species']);
    $month     = $pdo->quote($_POST['month']);
    $day       = $pdo->quote($_POST['day']);
    $diet     = $pdo->quote($_POST['diet']);
    
    $query    = "INSERT INTO vdata VALUES" .
      "($vname, $species, $month, $day, $diet)";
    $result = $pdo->query($query);
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Montgomery Valentine's Familiar Manager</title>
    <style>
        body {
            background-color: #ccc2ff;
            font-family: Arial, sans-serif;
        }
        .container {
            width: 500px;
            margin: 0 auto;
        }
        fieldset {
            margin: 20px 0;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center">Valentine's D&D 5e</h1>
        <h2 style="text-align: center">Familiar Management System</h2>
        <h4 style="text-align: center">Version 1.1</h4>

        <form action="index.php" method="post" autocomplete="off">
            <fieldset>
                <legend>Add New Familiar</legend>
                <pre>
        Name <input type="text" name="vname" required>

     Species<input type="radio" name="species" value="Wolf" required>Snake<input type="radio" name="species" value="Cat">Spider<input type="radio" name="species" value="Kangaroo">Pseudodragon
            <input type="radio" name="species" value="Elephant">Dog <input type="radio" name="species" value="Alligator">Owl <input type="radio" name="species" value="Dog">Cat

    Birthday <select name="month">
            <option value="Jan">Jan</option>
            <option value="Feb">Feb</option>
            <option value="Mar">Mar</option>
            </select>

            <select name="day">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            </select>

        Flies? <input type="hidden" name="diet" value="No"><input type="checkbox" name="diet" value="Yes">Fly Speed?

             <input type="submit" value="Familar has joined the party!">
                </pre>
            </fieldset>
        </form>

        <fieldset>
            <legend>Familiar Team:</legend>
            <?php
            $query  = "SELECT * FROM vdata";
            $result = $pdo->query($query);

            while ($row = $result->fetch()) {
                $r0 = htmlspecialchars($row['vname']);
                $r1 = htmlspecialchars($row['species']);
                $r2 = htmlspecialchars($row['month']);
                $r3 = htmlspecialchars($row['day']);
                $r4 = htmlspecialchars($row['diet']);
                
                echo <<<_END
                <pre><table><tr><td width="225"><table><tr><td width="125">Name:</td><td width="100">$r0</td></tr>
                <tr><td>Species:</td><td>$r1</td></tr>
                <tr><td>Birthday:</td><td>$r2 $r3</td></tr>
                <tr><td>Flying Speed: </td><td>$r4</td></tr></table>
                
                <td width=100"><br><br><form action='index.php' method='post'>
                <input type='hidden' name='delete' value='yes'>
                <input type='hidden' name='vname' value='$r0'>
                <input type='submit' value='Familiar released to the Abyss'></td></tr></table></pre></form>
                _END;
            }
            ?>
        </fieldset>
    </div>
</body>
</html>