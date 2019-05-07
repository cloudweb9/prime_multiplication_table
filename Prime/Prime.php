<?php
namespace Prime;

class Prime {

    /**
     * get_primenumbers returns n amount of primes
     *
     * @param <integer> quantity of requested prime numbers
     * @return <array> returns an array of size $n with consecutive primes
     */
    final public function get_primenumbers($n) 
    {
        if ($n == 0) {
            return 0;
        }

        $result = Array();
        $i = 2;
        do {
            if ($this->is_prime($i)) {
                $result[] = $i;
                $n--;
            }
            $i++;
        } while ($n > 0);

        return $result;
    }

    /**
     * Verifies if number is a prime.
     *
     * @param $number <integer>
     * @return boolean
     */
    final public function is_prime($num) 
    {
        //1 is not prime. 
        if($num == 1)
            return false;

        //2 is prime (the only even number that is prime)
        if($num == 2)
            return true;

        //if the number is divisible by two, then it's not prime and it's no longer needed to check other even numbers
        if($num % 2 == 0) {
            return false;
        }

        // Checks the odd numbers. If any of them is a factor, then it returns false. The sqrt can be an aproximation, hence just for the sake of security, one rounds it to the next highest integer value.
        
        $ceil = ceil(sqrt($num));
        for($i = 3; $i <= $ceil; $i = $i + 2) {
            if($num % $i == 0)
                return false;
        }

        return true;
    }

}

