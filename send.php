<?php
    include 'database.php';
    $result = $_POST;
    $carname = $result['model'];
    $send = "INSERT INTO orders(model, order_id, fullname, phone, email, method, country, address, card, cvv)
    VALUES (:model,order_id,:fullname,:phone,:email,:method,:country,:address,:card,:cvv)";
    $sendstmt = $dbcon->prepare($send);
    $model = $carname;
    $fullname = $result['firstname'] . " " . $result['lastname'];
    $phone = $result['code'] . "-" . $result['phone'];
    $email = $result['email'];
    $method = $result['method'];
    $sendstmt->bindValue(':country', null, PDO::PARAM_INT);
    $sendstmt->bindValue(':address', null, PDO::PARAM_INT);
    if ($method != 'pickup'){
        $country = $result['country'];
        $address = $result['address'] . ", " . $result['city'] . ", " . $result['state'] . " " . $result['zip'];
        $sendstmt->bindParam(':country', $country);
        $sendstmt->bindParam(':address', $address); 
    }
    $card = $result['card'];
    $cvv = $result['cvv'];
    $sendstmt->bindParam(':model', $model);
    $sendstmt->bindParam(':fullname', $fullname);
    $sendstmt->bindParam(':phone', $phone);
    $sendstmt->bindParam(':email', $email);
    $sendstmt->bindParam(':method', $method);
    $sendstmt->bindParam(':card', $card, PDO::PARAM_INT);
    $sendstmt->bindParam(':cvv', $cvv, PDO::PARAM_INT);
    $sendstmt->execute();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Your order has been processed</title>
    </head>
    <body>
        <h1>Your Order Summary</h1>
        <div>
            Car Model: <?=$carname?> <br>
            Name: <?=$fullname?> <br>
            Phone: <?=$phone?> <br>
            Email: <?=$email?> <br>
            Shipping Method: <?=$method?> <br>
            <?php if ($method != 'pickup'){ ?>
            Country: <?=$country?> <br>
            Shipping Address: <?=$address?> <br>
            <?php } ?>
            Card Number: <?=$card?> CVV: <?=$cvv?>
        </div>
        <form action="index.php">
            <input type="submit" value="Go back to index" />
        </form>
    </body>