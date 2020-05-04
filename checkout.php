<?php
    include 'database.php';
    $pid = $_GET['pid'];
    $car = "SELECT * FROM cardata WHERE cardata.pid = :id ";
    $carstmt = $dbcon->prepare($car);
    $carstmt->bindParam(':id', $pid, PDO::PARAM_INT);
    $carstmt->execute();
    $rs_car = $carstmt->fetchAll()[0];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vending Cars - Car Buying Made Simple</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body onload="setupCheckout()">
        <div class="banner">
            <h1>Vending Cars</h1>
            <div class="slogan">
                The lowest priced cars anywhere
            </div>
        </div>
        <div class="checkout">
            <br/>
            <h2 id="product">ORDER FOR: <?=$rs_car['make']?> <?=$rs_car['model']?> <?=$rs_car['trim']?></h2>
            <div style="text-align: center;">
            <form id="checkoutForm" action="send.php" method="POST">
                <input type="hidden" id="carname" name="model">
                <strong>Name:</strong> First:
                <input type="text" name="firstname" value="" size=15>
                Last:
                <input type="text" name="lastname" id="lastname" value="" size=15>
                <br/>
                <strong>Phone:</strong> Intl. Code:
                <input type="text" name="code" id="code" value="+" size=3 maxlength="7" oninput="conformIntlCode(this.value)" onkeypress="return isDigit(event, 'Phone Number')">
                Number:
                <input type="text" name="phone" id="phone" value="" size=10 oninput="conformPhoneNumber(this.value)" onkeypress="return isDigit(event, 'Phone Number')">
                <br/>
                <strong>E-mail Address:</strong>
                <input type="text" name="email" id="email" value="" size=20>
                <br/>
                <strong>Shipping Method:</strong>
                <select name="method" id="method" onchange="enableAddress()">
                    <option value="standard" selected="selected">Standard (7 days)</option>
                    <option value="fast">Fast (4 days)</option>
                    <option value="pickup">Pickup</option>
                </select>
                <br/>
                <strong>Shipping Address:</strong>
                <br/>
                Street Address:
                <input type="text" name="address" id="address" value="" size=30>
                <br/>
                Postal Code:
                <input type="text" name="zip" id="zip" value="" size=6 onblur="getPlace(this.value)">
                <br/>
                Country:
                <input type="text" name="country" id="country" value="" size=20>
                <br/>
                City:
                <input type="text" name="city" id="city" value="" size=10>
                State/Province:
                <input type="text" name="state" id="state" value="" size=6>
                <br/>
                <strong>Payment Info:</strong> Card Number:
                <input type="text" name="card" id="card" value="" size=16 onkeypress="return isDigit(event, 'Payment Info')">
                CVV:
                <input type="text" name="cvv" id="cvv" value="" size=2 onkeypress="return isDigit(event, 'Payment Info')">
                <br/><br/>
                <strong>TOTAL COST:</strong> <bdi id="totalCost">NULL</bdi>
                <br/><br/>
                <button onclick="document.getElementById('carname').value = productToString()">PURCHASE</button>
            </form>
            </div>
        </div>
        <script type="text/javascript">var make="<?=$rs_car['make']?>"; var model="<?=$rs_car['model']?>"; var trim="<?=$rs_car['trim']?>"; var price=<?=$rs_car['price']?>;</script>
        <script type="text/javascript" src="checkout.js"></script>
        <script type = "text/javascript" src = "zip_code_autofill.js"></script>
    </body>

</html>
<?php
    $carstmt->closeCursor();
?>
