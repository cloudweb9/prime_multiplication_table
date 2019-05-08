<?php 

use Prime\PrimeMultiplication as PM;
use Test\TestCases as Test;

function __autoload( $class ) 
{
    $file = str_replace("\\", "/", trim($class, "\\"));

    if (is_file(__DIR__ . "/$file.php" )) {
        require_once(__DIR__ . "/$file.php");
    }
}

$opt = "testcases"; // $opt = 10;

if (is_numeric($opt)) {    
    $primeMultiplication = new PM($opt);
    $primeMultiplication->preview();    
} else if (strtolower($opt) == "testcases") {
    $test = new Test();
    // ReflectionClass class reports information about a class.
    $reflector = new ReflectionClass(get_class($test)); 
    $functions =  $reflector->getMethods();

    foreach($functions as $v) {
        if ($v->class === get_class($test) && strpos($v->name, "test_") === 0) {
            $test->{$v->name}();
        }
    }
    $test->print_results();
} else {
    print("checking...");
} 

?>
