<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FunctionPerhitungan extends Model
{
    public static function calculateFibonacci($n)
    {
        if ($n <= 0) return [];
        if ($n == 1) return [0];
        if ($n == 2) return [0, 1];

        $fibonacci = [0, 1];
        for ($i = 2; $i < $n; $i++) {
            $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
        }

        return $fibonacci;
    }

    public static function checkOddEven($number)
    {
        return $number % 2 == 0 ? 'Genap' : 'Ganjil';
    }

    public static function checkPrime($number)
    {
        if ($number <= 1) return 'Bukan Prima';
        for ($i = 2; $i <= sqrt($number); $i++) {
            if ($number % $i == 0) return 'Bukan Prima';
        }
        return 'Prima';
    }
}
