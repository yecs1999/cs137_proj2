<?php
// getCityState.php
//  Gets the form value from the "zip" widget, looks up the
//  city and state for that zip code, and prints it for the
//  form


$filename = "zip_codes.csv";
$cityState = [];


if (($csv = fopen("{$filename}", "r")) !== FALSE) 
{
  while (($line = fgetcsv($csv, 1000, ",")) !== FALSE) 
  {
    //Not sure if php supports array slicing, this is a workaround
    //$csv should be in form [zip,state, city]
    $temp = $line[2].", ".$line[1]; //put into city, state
    $cityState[$line[0]] = $temp;		
  }

  fclose($csv);
}

$zip = $_GET["zip"];



    if (array_key_exists($zip, $cityState))
        print $cityState[$zip];
    else
        print " , ";
?>
