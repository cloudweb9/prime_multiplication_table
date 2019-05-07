<?php 

use Prime\PrimeMultiplication as PM;

function __autoload( $class ) 
{
    $file = str_replace("\\", "/", trim($class, "\\"));

    if (is_file(__DIR__ . "/$file.php" )) {
        require_once(__DIR__ . "/$file.php");
    }
}

$opt = 10; // This represents first 10 prime numbers multiplication table
$primeMultiplication = new PM($opt);
$primeMultiplication->preview();

?>
