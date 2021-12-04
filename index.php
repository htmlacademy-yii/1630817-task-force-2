<?php

use myorg\Csv\CsvLoader;

require_once 'vendor/autoload.php';


$loader = new CsvLoader('addresses.csv', ['Index', 'Eruption', 'Eruption2']);

try {

    $loader->import();
    $loader->writeToSql('test', 'table', '');

} catch (Exception $exception) {
    echo $exception;
}


