<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form fields are empty or if the email is invalid
    if (empty($_POST['name']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        // If any field is invalid, return an error response
        http_response_code(400);
        echo "Please fill all the fields correctly.";
        exit();
    }

    // Sanitize and validate the form data
    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message = strip_tags(htmlspecialchars($_POST['message']));

    // Set the recipient email address (your email)
    $to = "aakushinde510.as@gmail.com";  // Change to your own email address

    // Set the email subject
    $email_subject = "$subject: $name";

    // Prepare the email body content
    $email_body = "You have received a new message from your website contact form.\n\n".
                  "Here are the details:\n\n".
                  "Name: $name\n\n".
                  "Email: $email\n\n".
                  "Subject: $subject\n\n".
                  "Message:\n$message";

    // Set the headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email and check if it was successful
    if (mail($to, $email_subject, $email_body, $headers)) {
        echo "Message sent successfully!";
    } else {
        // If sending fails, return an error response
        http_response_code(500);
        echo "Oops! Something went wrong and we couldn't send your message.";
    }
}
?>
