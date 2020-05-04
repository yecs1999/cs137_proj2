<?php
    include 'database.php';
    $pid = $_GET['pid'];
    $car = "Select * from cardata left join carimages on carimages.pid = cardata.pid where cardata.pid = :id ";
    $carstmt = $dbcon->prepare($car);
    $carstmt->bindParam(':id', $pid, PDO::PARAM_INT);
    $carstmt->execute();
    $rs_car = $carstmt->fetchAll()[0];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Vending Cars - Car Buying Made Simple</title>
        <link rel="stylesheet" href="car_info.css">
        <!--<script src = "./car_info.js"></script>-->
    </head>
    <body>
        <div class="banner">
            <h1>Vending Cars</h1>
            <div class="slogan">
                The lowest priced cars anywhere
            </div>
        </div>
        <div class="images">
            <img src=<?=$rs_car['main_img']?> width=350 height=350>
            <img src=<?=$rs_car['sub_img']?> width=350 height=350>
            <img src=<?=$rs_car['int_img']?> width=350 height=350>
        </div>
        <div class="description">
            <table id="description_table">
                <thead><tr><th colspan=2>Specifications</th></tr></thead>
                <tbody>
                    <tr><td>Category</td><td><?=$rs_car['category']?></td></tr>
                    <tr><td>Make</td><td><?=$rs_car['make']?></td></tr>
                    <tr><td>Model</td><td><?=$rs_car['model']?></td></tr>
                    <tr><td>Trim</td><td><?=$rs_car['trim']?></td></tr>
                    <tr><td>Color</td><td><?=$rs_car['color']?></td></tr>
                    <tr><td>Year</td><td><?=$rs_car['year']?></td></tr>
                    <tr><td>Odo</td><td><?=$rs_car['odo']?></td></tr>
                    <tr><td>Gearbox</td><td><?=$rs_car['gearbox']?></td></tr>
                    <tr><td>Engine</td><td><?=$rs_car['engine']?></td></tr>
                    <tr><td>Price</td><td><?=$rs_car['price']?></td></tr>
                    <tr><td>Location</td><td><?=$rs_car['location']?></td></tr>
                    <tr><td>Description</td><td><?=$rs_car['description']?></td></tr>
                </tbody>
            </table>
        </div>
        <script>
            function orderNowOnClick(){
                window.open("./checkout.php?pid=<?=$rs_car['pid']?>");
            }
        </script>
        <div class="buttonDiv">
            <button type="button" id="orderButton" onclick="orderNowOnClick()">
                Order Now
            </button>
        </div>
    </body>
</html>
<?php
    $carstmt->closeCursor();
?>
