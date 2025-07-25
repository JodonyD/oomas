<?php
// Enable error reporting for debugging (***REMOVE IN PRODUCTION!***)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve and sanitize input from the order form
    $fname = htmlspecialchars(trim($_POST["fname"]));
    $lname = htmlspecialchars(trim($_POST["lname"]));
    $order_description = htmlspecialchars(trim($_POST["order_description"]));

    // Combine first and last name for easier use in email
    $customer_full_name = $fname . " " . $lname;

    // Basic Input Validation: Check if fields are empty
    if (empty($fname) || empty($lname) || empty($order_description)) {
        // Render an HTML error page for empty fields
        echo "<!DOCTYPE html>
              <html lang='en'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <title>Order Error - Oomas Jamaican Goodies</title>
                  <link rel='stylesheet' href='style.css'>
              </head>
              <body>
                  <div class='header'>
                      <header>
                          <img src='images/oomaslogo.jpg' alt='Oomas Jamaican Goodies Logo' class='logo'>
                          <h1>Oomas Jamaican Goodies</h1>
                          <p>Authentic homemade baked treats made with love since 2021.</p>
                          <p>Yummy Jamaican Goodies! Made by Ooma with love. 🇯🇲</p>
                      </header>
                      <nav>
                          <a href='index.html'>Home</a>
                          <a href='about.html'>About</a>
                          <a href='products.html'>Products</a>
                          <a href='contact.html'>Contact</a>
                          <a href='order.html'>Order Here</a>
                      </nav>
                  </div>
                  <div class='error-message'>
                      <h2>Order Submission Failed</h2>
                      <p>Please fill in all required fields.</p>
                      <a href='order.html'>Go back to Order Page</a>
                  </div>
                  <footer class='foot'>
                    <hr />
                    <p>&copy; 2025 Oomas Jamaican Goodies. All rights reserved</p>
                  </footer>
              </body>
              </html>";
        exit(); // Stop script execution
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings for Gmail SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jodonydunn@gmail.com';
        $mail->Password   = 'vylq vidk tgth cymh'; //app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Use ENCRYPTION_SMTPS for port 465 if you prefer
        $mail->Port       = 587; // Or 465 for SMTPS

        $mail->setFrom('jodonydunn@gmail.com', 'Oomas Jamaican Goodies Website');
        $mail->addAddress('dunnalice9@gmail.com'); //

        // Content
        $mail->isHTML(false); // Set to true if you want to send HTML emails
        $mail->Subject = "NEW ORDER from " . $customer_full_name;
        $mail->Body    = "Hello Ooma,\n\nYou have a new order from your website!\n\n"
                       . "Customer Name: " . $customer_full_name . "\n"
                       . "Order Details:\n" . $order_description . "\n\n"
                       . "Please contact the customer to confirm the order.\n"
                       . "Thank you!";

        $mail->send();

        // Render success message page
        echo "<!DOCTYPE html>
              <html lang='en'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <title>Order Confirmation - Oomas Jamaican Goodies</title>
                  <link rel='stylesheet' href='style.css'>
              </head>
              <body>
                  <div class='header'>
                      <header>
                          <img src='images/oomaslogo.jpg' alt='Oomas Jamaican Goodies Logo' class='logo'>
                          <h1>Oomas Jamaican Goodies</h1>
                          <p>Authentic homemade baked treats made with love since 2021.</p>
                          <p>Yummy Jamaican Goodies! Made by Ooma with love. 🇯🇲</p>
                      </header>
                      <nav>
                          <a href='index.html'>Home</a>
                          <a href='about.html'>About</a>
                          <a href='products.html'>Products</a>
                          <a href='contact.html'>Contact</a>
                          <a href='order.html'>Order Here</a>
                      </nav>
                  </div>
                  <div class='confirmation-message'>
                      <h2>Order Placed Successfully!</h2>
                      <p>Thank you, " . htmlspecialchars($fname) . "! Your order details have been sent to Ooma via email. You will be contacted shortly.</p>
                      <a href='index.html'>Go to Home Page</a>
                  </div>
                  <footer class='foot'>
                    <hr />
                    <p>&copy; 2025 Oomas Jamaican Goodies. All rights reserved</p>
                  </footer>
              </body>
              </html>";

    } catch (Exception $e) {
        // Email sending failed
        error_log("PHPMailer Error for order from " . $customer_full_name . ": {$mail->ErrorInfo}"); // Log this error for debugging
        // Render an error message page
        echo "<!DOCTYPE html>
              <html lang='en'>
              <head>
                  <meta charset='UTF-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                  <title>Order Error - Oomas Jamaican Goodies</title>
                  <link rel='stylesheet' href='style.css'>
              </head>
              <body>
                  <div class='header'>
                      <header>
                          <img src='images/oomaslogo.jpg' alt='Oomas Jamaican Goodies Logo' class='logo'>
                          <h1>Oomas Jamaican Goodies</h1>
                          <p>Authentic homemade baked treats made with love since 2021.</p>
                          <p>Yummy Jamaican Goodies! Made by Ooma with love. 🇯🇲</p>
                      </header>
                      <nav>
                          <a href='index.html'>Home</a>
                          <a href='about.html'>About</a>
                          <a href='products.html'>Products</a>
                          <a href='contact.html'>Contact</a>
                          <a href='order.html'>Order Here</a>
                      </nav>
                  </div>
                  <div class='error-message'>
                      <h2>Order Submission Failed</h2>
                      <p>There was an error sending your order via email. Please try again or message us on WhatsApp.</p>
                      <p style='font-size: 0.9em; color: #888;'>Technical details: " . htmlspecialchars($mail->ErrorInfo) . "</p>
                      <a href='order.html'>Go back to Order Page</a>
                  </div>
                  <footer class='foot'>
                    <hr />
                    <p>&copy; 2025 Oomas Jamaican Goodies. All rights reserved</p>
                  </footer>
              </body>
              </html>";
    }

} else {
    // If someone tries to access submitorder.php directly without submitting the form
    header("Location: order.html");
    exit();
}
?>