<?php
// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
class NumToWords
{
    function __construct($num)
    {
        $this->num = $num;
    }

    function convert_tens($num)
    {
        global $ones, $teens, $tens;
        if ($num < 10) {
            return $ones[$num];
        } else if ($num >= 10 && $num < 20) {
            return $teens[$num - 10];
        } else {
            return $num % 10 === 0 ?  $tens[floor($num / 10)] : $tens[floor($num / 10)] . " " . $ones[$num % 10];
            // if ($num % 10 === 0) {
            //     return $tens[floor($num / 10)];
            // } else {
            //     return $tens[floor($num / 10)] . " " . $ones[$num % 10];
            // }
        }
    }

    function convert_hundreds($num)
    {
        global $ones;

        if ($num > 99) {
            return $num % 100 === 0 ? $ones[floor($num / 100)] . " HUNDRED " : $ones[floor($num / 100)] . " HUNDRED AND " . $this->convert_tens($num % 100);
            // if ($num % 100 === 0) {
            //     return $ones[floor($num / 100)] . " HUNDRED ";
            // } else {
            //     return $ones[floor($num / 100)] . " HUNDRED AND " . convert_tens($num % 100);
            // }
        } else {
            return $this->convert_tens($num);
        }
    }

    function convert_thousands($num)
    {
        return $num >= 1000 ?  $this->convert_hundreds(floor($num / 1000)) . " THOUSAND " . $this->convert_hundreds($num % 1000) : $this->convert_hundreds($num);
        // if ($num >= 1000) {
        //     return convert_hundreds(floor($num / 1000)) . " THOUSAND " . convert_hundreds($num % 1000);
        // } else {
        //     return convert_hundreds($num);
        // }
    }

    function convert_millions($num)
    {
        return $num >= 1000000 ? $this->convert_millions(floor($num / 1000000)) . " MILLION " . $this->convert_thousands($num % 1000000) : $this->convert_thousands($num);
        // if ($num >= 1000000) {
        //     return convert_millions(floor($num / 1000000)) . " MILLION " . convert_thousands($num % 1000000);
        // } else {
        //     return convert_thousands($num);
        // }
    }

    function convert_billions($num)
    {
        return $num >= 1000000000 ? $this->convert_billions(floor($num / 1000000000)) . " Billion " . $this->convert_millions($num % 1000000000) : $this->convert_millions($num);
        // if ($num >= 1000000000) {
        //     return (convert_billions(floor($num / 1000000000)) . " Billion " . convert_millions($num % 1000000000));
        // } else {
        //     return convert_millions($num);
        // }
    }

    function convert_num_with_decimal()
    {
        $nums = explode('.', (string)$this->num);
        $billions = $this->convert_billions($nums[0]);
        if (count($nums) == 2) {
            if ($nums[1] === "00") {
                return $billions . ' DOLLARS';
            } else {
                $decimal = $this->convert_billions(ltrim($nums[1], "0"));
                return $billions . ' DOLLARS AND ' . $decimal . ' CENTS';
            }
        } else {
            return $billions . ' DOLLARS';
        }
    }
}

$ones = ['ZERO', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE'];
$teens = ['TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'];
$tens = ['', '', 'TWENTY', 'THIRTY', 'FORTY', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY'];

$numInput =  isset($_REQUEST["q"]) ? $_REQUEST["q"] : '';
if ($numInput != '') {
    $num1 = new NumToWords($numInput, $ones, $teens, $tens);
    echo $num1->convert_num_with_decimal();
}

// $num1 = new NumToWords('123.45', $ones, $teens, $tens);
// var_dump($num1->convert_num_with_decimal());
// $num2 = new NumToWords('100.05', $ones, $teens, $tens);
// var_dump($num2->convert_num_with_decimal());
// $num3 = new NumToWords('100001.01', $ones, $teens, $tens);
// var_dump($num3->convert_num_with_decimal());
// $num4 = new NumToWords('1789501.25', $ones, $teens, $tens);
// var_dump($num4->convert_num_with_decimal());
// $num5 = new NumToWords('789481.00', $ones, $teens, $tens);
// var_dump($num5->convert_num_with_decimal());
// $num6 = new NumToWords('2156175.50', $ones, $teens, $tens);
// var_dump($num6->convert_num_with_decimal());
// $num7 = new NumToWords('1111111.11', $ones, $teens, $tens);
// var_dump($num7->convert_num_with_decimal());
// $num8 = new NumToWords('10002005.77', $ones, $teens, $tens);
// var_dump($num8->convert_num_with_decimal());