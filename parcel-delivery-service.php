<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">	
	<title>Apples</title>	
<link rel="stylesheet" href="ptask-style.css">
</head>
<body>
<a href="https://icsprogramming.ca/2019-2020/tarnovskib44ae/"><img src="images/homebutton.png" align="left" valign="top" width="50"></a>
<div class="text" align="center">
    <h1>Apples</h1>
    <h3>Your local apple supplier!</h3>
    <img src="images/apples.jfif" height="200">
    <p>
        Using the following form please fill out your order
    </p>
	<form method="post" class="input">
        <h3>Contact Information</h3>
            Your Name: <input type="text" name="clientname" required></input><br />
            Your Email: <input type="email" name="email" required></input><br />
            Your Phone Number: <input type="text" name="phone" required></input>
        <h3>Package Information</h3>
            Height (cm): <input type="number" name="height" min="0.5" max="200" step="0.5" required></input><br />
            Width (cm): <input type="number" name="width" min="0.5" max="200" step="0.5" required></input><br />
            Length (cm): <input type="number" name="length" min="0.5" max="200" step="0.5" required></input><br />
            Weight (kg): <input type="number" name="weight" min="0.1" max="50" step="0.1" required></input>
        <h3>Shipping Information</h3>
            Distance (km): <input type="number" name="distance" min="0" max="100" step="0.1" required>
        <h3>Special Comments</h3>
            <input type="text" name="comments"></input><br />
        <input type="submit" name="submitbtn" class="submit"></input>
    </form>
</div>
<?php
    if ($_POST['submitbtn']){
        $clientname = $_POST['clientname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $distance = $_POST['distance'];
        $height = $_POST['height'];
        $width = $_POST['width'];
        $length = $_POST['length'];
        $weight = $_POST['weight'];
        $comment = $_POST['comment'];

        $volume = $height * $width * $length;
        $volumecost = $volume * 0.00025;
//volume cost
        if ($volumecost < 15){
            $volumecost = 15;
        }
//mass cost
        if ($mass <= 2){
            $masscost = 2;
        }
        else if ($mass > 2 AND $mass <= 5){
            $masscost = 5;
        }
        else if ($mass > 5 AND $mass <= 10){
            $masscost = 10;
        }
        else if ($mass > 10){
            $masscost = 1.5 * $weight;
        }
//distance cost
        if ($distance <= 10){
            $distancecost = 5;
        }
        else if ($distance > 10 AND $distance <= 50){
            $distancecost = 15;
        }
        else if ($distance > 50 AND $distance <= 100){
            $distancecost = 30;
        }

        $subtotal = $volumecost + $masscost + $distancecost;
        $finalcost = $subtotal * 1.13;

//client message
        echo "<div align=\"center\" class =\"text\">
                Hi $clientname, thank you for ordering. A confirmation message has been sent to $email and $phone.
                <br />
                Your order has the following information: <br />
                Height (cm): $height <br />
                Width (cm): $width <br />
                Length (cm): $length <br />
                Weight (kg): $weight <br /> 
                Distance (km): $distance <br />
                Special Comments: $comment <br /><br />
                The total cost is: $$finalcost
            </div>
        ";
//email
        $separator = md5(time());
        $eol = PHP_EOL;    

        $to = "1tarnovskivi@hdsb.ca";
        $from = "inquiries@apples.ca";
        $subject = "inquiry";

        $headers  = "From: ".$from.$eol;
        $headers .= "MIME-Version: 1.0".$eol; 
        $headers .= "Content-Type: multipart/mixed; boundary=\"".$separator."\"".$eol; 
        $headers .= "Content-Transfer-Encoding: 7bit".$eol;
        $headers .= "Inquiry".$eol;

        $body = "--".$separator.$eol;
        $body .= "Content-Type: text/html; charset=\"iso-8859-1\"".$eol;
        $body .= "Content-Transfer-Encoding: 8bit".$eol.$eol;
        $body .= $message.$eol;

        $body = "$clientname inquired about a box with attributes 
                Height (cm): $height 
                Width (cm): $width 
                Length (cm): $length 
                Weight (kg): $weight  
                Distance (km): $distance 
                Cost: $$finalcost 

                Customer information: 
                Name: $clientname 
                Email: $email 
                Phone: $phone 
                Special Comments: $comment
            ";

        mail($to, $subject,$body,$headers);
    }
?>
</body>
</html>