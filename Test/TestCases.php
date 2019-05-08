<?php
namespace Test;

use Prime\PrimeMultiplication as PM;
use Prime\Prime;


interface TestSuite 
{
    public function print_results();
    public function assertion($bool, $name, $desc = "");
    public function pass($method, $append = "");
    public function fail($method, $append = "");
}

class TestCases implements TestSuite 
{

    private $prime = null;
    private $results = array();
    private $passed = 0;
    private $failed = 0;

    public function __construct() 
    {
        $this->prime = new Prime();
    }

    public function test_is_not_prime() 
    {
        $this->assertion(! $this->prime->is_prime(0), __METHOD__, "0 is not a prime number");
        $this->assertion(! $this->prime->is_prime(1), __METHOD__, "1 is not a prime number");
        $this->assertion(! $this->prime->is_prime(6), __METHOD__, "6 is not a prime number");
        $this->assertion(! $this->prime->is_prime(20), __METHOD__, "20 is not a prime number");
        $this->assertion(! $this->prime->is_prime(40), __METHOD__, "40 is not a prime number");
        $this->assertion(! $this->prime->is_prime(60), __METHOD__, "60 is not a prime number");
        $this->assertion(! $this->prime->is_prime(341), __METHOD__, "341 is not a prime number");
        $this->assertion(! $this->prime->is_prime(561), __METHOD__, "561 is not a prime number");
        $this->assertion(! $this->prime->is_prime(1024), __METHOD__, "1024 is not a prime number");
    }

    public function test_is_prime() 
    {
        $this->assertion($this->prime->is_prime(2), __METHOD__, "2 is a prime number");
        $this->assertion($this->prime->is_prime(3), __METHOD__, "3 is a prime number");
        $this->assertion($this->prime->is_prime(7), __METHOD__, "7 is a prime number");
        $this->assertion($this->prime->is_prime(17), __METHOD__, "17 is a prime number");
        $this->assertion($this->prime->is_prime(29), __METHOD__, "29 is a prime number");
        $this->assertion($this->prime->is_prime(31), __METHOD__, "31 is a prime number");
        $this->assertion($this->prime->is_prime(689586) === true, __METHOD__, "689586 is a prime number");
        $this->assertion($this->prime->is_prime(7728829) === true, __METHOD__, "7728829 is a prime number");
        $this->assertion($this->prime->is_prime(89999967) === true, __METHOD__, "89999967 is a prime number");
        $this->assertion($this->prime->is_prime(999999937) === true, __METHOD__, "999999937 is a prime number");
    }

    public function test_prime_multiplication_get_value()
    {
        $table = new PM(10);
        $this->assertion($table->get_value(0, 0) == "", __METHOD__, "[0,0] == blank");
        $this->assertion($table->get_value(0, 1) == 2, __METHOD__, "[0,1] == 2");
        $this->assertion($table->get_value(10, 10) == 841, __METHOD__, "[10,10] == 841");
        $this->assertion($table->get_value(3, 7) == 85, __METHOD__, "[3,7] == 85");
        $this->assertion($table->get_value(10, 1) == 58, __METHOD__, "[10,1] == 58");
    }

    public function assertion($bool, $name, $desc = "")
    {
        if ($bool) {
            $this->pass($name, $desc);
        } else {
            $this->fail($name, $desc);
        }
    }

    public function pass($method, $append = "") 
    {
        $this->results[$method][] = "Pass: $append";
        $this->passed++;
    }

    public function fail($method, $append = "") 
    {
        $this->results[$method][] = "Fail: $append";
        $this->failed++;
    }

    public function print_results() 
    {

        $qty = 0;

        foreach($this->results as $name => $result) {
            $label = explode("::", $name);
            $label = isset($label[1]) ? ucwords(str_replace("_", " ", $label[1])) : $label[0];

            printf("%s:\n", $label);
            foreach($result as $i => $line) {
                printf("\t%d: %s\n", $qty + 1, $line);
                $qty++;
            }
        }

        printf("\nExecuted %d test(s). Failed(%d/%d) Passed(%d/%d)\n\n", 
            $qty,
            $this->failed,
            $qty,
            $this->passed,
            $qty
        );
    }
}
