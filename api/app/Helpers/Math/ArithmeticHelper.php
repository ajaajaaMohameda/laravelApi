<?php
namespace App\Helpers\Math;

use Hamcrest\Type\IsNumeric;
use PharIo\Manifest\InvalidUrlException;

class ArithmeticHelper 
{
    public static function add(...$args)
    {

        if(sizeof($args)<1) {
            throw new \InvalidArgumentException('must have at least on number');

        }

        $sum = 0;
        foreach ($args as $key => $value) {
            # code...

            if(!self::isNumeric($value)) {
                throw new InvalidUrlException('argument can only be numeric');
            }

            $sum+=$value;
        }

        return $sum;
    }

    public static function isNumeric($value)
    {
        return (is_float($value) || is_int($value));
    }
}