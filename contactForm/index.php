<?php
// php code for form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming validation or form submission success check
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    if (empty($name) || empty($email) || empty($message)) {
        echo "<div class='error-message'>All fields are required!</div>";
    } else {
        // Send the email (dummy example)
        $to = "madeUpEmail@outlook.com";
        $subject = "New Contact Form Submission";
        $body = "Name: $name\nEmail: $email\nMessage: $message";
        $headers = "From: $email";
        
        if (mail($to, $subject, $body, $headers)) {
            echo "<div class='success-message'>Your message has been successfully sent!</div>";
        } else {
            echo "<div class='error-message'>There was an error sending your message. Please try again.</div>";
        }
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
