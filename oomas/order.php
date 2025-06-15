<?php

    //start session 
    session_start();

    //initialize variables for error messages in sessions
    $fnameErr = isset($_SESSION["fnameErr"]) ? $_SESSION["fnameErr"] : "";
    $lnameErr = isset($_SESSION["lnameErr"]) ? $_SESSION["lnameErr"] : "";
    $orderErr = isset($_SESSION["orderErr"]) ? $_SESSION["orderErr"] : "";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Orders</title>
    </head>
<body>
    <div class="header">
        <header>
            <h1>Oomas Jamaican Goodies</h1>
            <p>Yummy Jamaican Goodies! Made by Ooma with love. 🇯🇲</p>
        </header>

        <nav>
            <a href="about.html">About</a>
            <a href="contact.html">Contact</a>
            <a href="order.php">Order Here</a>
        </nav>
    </div>

    <section class="form">
        <form>
            <h2>Place your order here! </h2>

            <label for="fname">First Name</label>
            <input type="text" id="fname" placeholder="First Name" required>
            <span class="error"><?php echo htmlspecialchars($fnameErr);?></span>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" placeholder="Last Name" required>
            <span class="error"><?php echo htmlspecialchars($lnameErr);?></span>

            <label for="order">Order Description</label>
            <textarea id="order" placeholder="3 banana breads" required>
            <span class="error"><?php echo htmlspecialchars($orderErr);?></span>

            <button type="submit">Submit</button>
            <button type="reset">Reset</button>
        </form>
    </section>


</body>
</html>