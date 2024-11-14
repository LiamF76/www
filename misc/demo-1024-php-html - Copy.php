<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP and HTML Together</title>
</head>
<body>

    <h1>Welcome to My Web Page</h1>

    <!-- Your PHP code is directly embedded here -->
    <?php
    // PHP code goes here
    // Example: Display the current date and time
    echo "<p>Today’s date is: " . date('Y-m-d H:i:s') . "</p>";
    echo "<h1>hi</h1><br>";

    $counter = 1;
    if ($counter == 1)
        echo "Counter is def 1!<br>";
    for ($i = 0; $i <= 5; $i++){
        echo "Count: " . $i;
        echo "<br>";
    }
    echo "<br><br><h1>This is a new thing, a while loop!</h1>";
    $counter = 0;
    while ($counter <= 10){
        echo "Counter is: " . $counter;
        echo "<br>";
        $counter ++;
    }
    
    ?>

</body>
</html>
