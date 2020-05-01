<?php

    //run mysqladmin -u root password password in the terminal for XAMPP before this line, or set password to whatever you want and change password below
    $dbcon = new PDO("mysql:host=localhost;dbname=cars", 'root', 'password');
    //$cars = "select * from cardata";
    $cats = "select * from carcategories group by category order by category";
    //$carstmt = $dbcon->prepare($cars);
    $catstmt = $dbcon->prepare($cats);
    //$carstmt->execute();
    $catstmt->execute();
    //$rs_cars = $carstmt->fetchAll();
    $rs_cats = $catstmt->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Vending Cars - Car Buying Made Simple</title>
        <link rel="stylesheet" href="index.css">
    </head>
    <body>
        <div class="banner">
            <h1>Vending Cars</h1>
            <div class="slogan">
                The lowest priced cars anywhere
            </div>
        </div>
        <div class="sidebar"> 
            <div class="info">
                <h2>About</h2>
                <p>Here at Vending Cars we are committed to streamlining your car buying experience by making shopping for one as easy as a single click!
                    No more haggling with third party sellers or shady dealerships, we guarantee the lowest buy it now prices anywhere on the web. All our vehicles are certified pre-owned
                    And come with a 1 Year warranty so you can drive at ease knowing you got the best deal</p>
            </div>
            <div class="links">
                <h2>Links</h2>
                <ul>
                    <li><a href="https://www.cars.com">cars.com</a></li>
                    <li><a href="https://www.cargurus.com">cargurus.com</a></li>
                    <li><a href="https://www.carmax.com">carmax.com</a></li>
                </ul>
            </div>
            <div class="contact">
                <h2>Contact info</h2>
                <p>
                    Donald Bren Hall, 6210, Irvine, CA 92697 <br>
                    Phone#: (949)-824-7427 <br>
                    Christopher Ye: Student# 93031221 <br>
                    Zhen Li: Student# 84257555 <br>
                    Emerson Chow: Student# 29527073 <br>
                    Luke Falcone: Student# 26133003 <br>
                </p>
            </div>
        </div>
        <script src="car_info.js" type="text/javascript"></script>
        <div class="categories">
            <table id="car_table">
                <thead><tr><th>Hatch</th><th>Minivan</th><th>Sedan</th><th>Sports</th><th>SUV</th></tr></thead>
                <tbody>
                    <?php
                    for ($j = 0; $j < 2; $j++){  
                        ?> <tr> 
                        <?php
                        for ($i = 0; $i < sizeof($rs_cats); $i++){
                            $category = $rs_cats[$i]['category'];
                            $carRowQuery = "Select cardata.*, carimages.main_img from cardata left join carimages on carimages.pid = cardata.pid 
                            where category = :category limit 1 offset :pos ";
                            $carstmt = $dbcon->prepare($carRowQuery);
                            $carstmt->bindParam(':category', $category);
                            $carstmt->bindParam(':pos', $j, PDO::PARAM_INT);
                            $carstmt->execute();
                            $rs_car = $carstmt->fetchAll()[0];
                            ?> <td><a href=car_info.html?pid=<?=$rs_car['pid']?>><img src=<?=$rs_car['main_img']?> width=250 height=250></a>
                            <b><?=$rs_car['make'], $rs_car['model'], $rs_car['year']?><br>$ <?=$rs_car['price']?></b></td>
                            <?php
                        } ?> </tr>  <?php
                    } ?> </tbody>
            </table>
        </div>
    </body>

</html>
<?php
$dbcon = null;
?>