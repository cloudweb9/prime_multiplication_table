<?php 

use Prime\PrimeMultiplication as PM;

function __autoload( $class ) 
{
    $file = str_replace("\\", "/", trim($class, "\\"));

    if (is_file(__DIR__ . "/$file.php" )) {
        require_once(__DIR__ . "/$file.php");
    }
}

$opt = 10;
$primes_only = false;
if (!empty($argv) && count($argv) > 1) {
    $opt = $argv[1];
    $primes_only = isset($argv[2]) && strtolower($argv[2]) == "notable";
}

$start = microtime(true);
if (!$primes_only) {
    $primeMultiplication = new PM($opt);
    $primeMultiplication->preview();
} else {
    $primeMultiplication = new PM($opt);
    $primeMultiplication->skip_primes();
}
 


?>
