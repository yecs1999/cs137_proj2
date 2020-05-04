<?php
// getTaxRate.php


$filename = "tax_rates.csv";
$taxrate = [];


if (($csv = fopen("{$filename}", "r")) !== FALSE)
{
  while (($line = fgetcsv($csv, 1000, ",")) !== FALSE)
  {
    $temp = $line[3]; //put into tax_rate
    $taxrate[$line[1]] = $temp;
  }

  fclose($csv);
}

$zip = $_GET["zip"];

if (array_key_exists($zip, $taxrate))
    print $taxrate[$zip];
else
    print 0;
?>
