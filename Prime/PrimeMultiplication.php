<?php
namespace Prime;

class PrimeMultiplication extends Prime 
{
    /* @var <number> $length and height of multiplication table */
    private $length = 0;

    /* @var <array> $primes collection of N primes */
    private $primes = array();

    public function __construct($n) 
    {
        /* increment for display of primes */
        $this->length = $n + 1;
        $this->primes = $this->get_primenumbers($n);
    }


    public function get_value($i, $j)
    {
        if ($j < $i) {
            return $this->get_value($j, $i);
        } else {
            if ($i == 0) {
                return $j == 0 ? null : $this->primes[$j - 1];
            } else {
                return $this->primes[$i - 1] * $this->primes[$j - 1];
            }
        }
    }


    public function preview()
    {
        /* Add some padding for readability */
        $padding = strlen($this->get_value($this->length - 1, $this->length - 1)) + 4;

        for($i = 0; $i < $this->length; $i++) {

            $this->lines($padding);
            print("\n");
            for($j = 0; $j < $this->length; $j++) {
                /* base case: blank will be converted to zero */
                if ($j == 0 && $i == 0) {
                    print(sprintf("%' " . $padding . "s", ""));
                } else {
                    print(sprintf("%' " . $padding . "d", $this->get_value($i, $j)));
                }
            }
            print("\n");
        }
        $this->lines($padding);
    }

    public function skip_primes()
    {
        foreach($this->primes as $prime) {
            print(sprintf("%s\t", $prime));
        }
        print("\n");
    }


    private function lines($padding)
    {
        for($j = 0; $j < $this->length; $j++) {
            print(sprintf("%'_" . $padding . "s", "_"));
        }
        print(sprintf("%'_" . $padding . "s", "_"));
        print("\n");
    }

    public function __get($key)
    {
        $allow = [
            'primes',
            'length'
        ];
        if (isset($this->{$key}) && in_array($key, $allow)) {
            return $this->{$key};
        }
    }
}
