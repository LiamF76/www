<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Email details
    $to = "fogartyl27@mycu.concord.edu";  // Change to the actual email address
    $subject = "Contact Form Message from " . $name;
    $body = "Name: " . $name . "\n" .
            "Email: " . $email . "\n\n" .
            "Message:\n" . $message;
    $headers = "From: " . $email;

    // Send the email
    if (mail($to, $subject, $body, $headers)) {
        $confirmation = "Your message has been sent successfully!";
    } else {
        $confirmation = "There was an error sending your message.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Contact Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Linking the external CSS file -->
</head>
<body>
    <header>
        <h1>Contact Us</h1>
    </header>

    <main>
        <p>Fill out the form below to send us a message.</p>

        <?php
        if (isset($confirmation)) {
            echo "<p class='confirmation-message'>$confirmation</p>";
        }
        ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Your Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit">Send Message</button>
        </form>
    </main>

    <footer>
        <p>© <?php echo date("Y"); ?> Your Website. All rights reserved.</p>
    </footer>
</body>
</html>
