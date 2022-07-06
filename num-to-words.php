<!-- accepts 0-999 and two decimals  -->
<!-- used floor iunstead of Math.floor to get the largest integer less than or equal to the number -->
<!-- used remainder operator to get the remainder of the given hundred -->
<!-- used (string) instead of toString to ensure that the given number is string before using the explode() instead of split method to convert it into an array -->
<!-- replace string concatenation from + to . -->
<!-- set the arrays into a  global variable to access inside a function -->
<!-- used .ltrim fucntion to remove leading zero -->


<?php
$ones = ['ZERO', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE'];
$teens = ['TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'];
$tens = ['', '', 'TWENTY', 'THIRTY', 'FORTY', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY'];


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
        return $num % 100 === 0 ? $ones[floor($num / 100)] . " HUNDRED " : $ones[floor($num / 100)] . " HUNDRED AND " . convert_tens($num % 100);
        // if ($num % 100 === 0) {
        //     return $ones[floor($num / 100)] . " HUNDRED ";
        // } else {
        //     return $ones[floor($num / 100)] . " HUNDRED AND " . convert_tens($num % 100);
        // }
    } else {
        return convert_tens($num);
    }
}

function convert_thousands($num)
{
    return $num >= 1000 ?  convert_hundreds(floor($num / 1000)) . " THOUSAND " . convert_hundreds($num % 1000) : convert_hundreds($num);
    // if ($num >= 1000) {
    //     return convert_hundreds(floor($num / 1000)) . " THOUSAND " . convert_hundreds($num % 1000);
    // } else {
    //     return convert_hundreds($num);
    // }
}

function convert_millions($num)
{
    return $num >= 1000000 ? convert_millions(floor($num / 1000000)) . " MILLION " . convert_thousands($num % 1000000) : convert_thousands($num);
    // if ($num >= 1000000) {
    //     return convert_millions(floor($num / 1000000)) . " MILLION " . convert_thousands($num % 1000000);
    // } else {
    //     return convert_thousands($num);
    // }
}

function convert_billions($num)
{
    return $num >= 1000000000 ? (convert_billions(floor($num / 1000000000)) . " Billion " . convert_millions($num % 1000000000)) : convert_millions($num);
    // if ($num >= 1000000000) {
    //     return (convert_billions(floor($num / 1000000000)) . " Billion " . convert_millions($num % 1000000000));
    // } else {
    //     return convert_millions($num);
    // }
}

function convert_num_with_decimal($num)
{
    $nums = explode('.', (string)$num);
    $billions = convert_billions($nums[0]);
    if (count($nums) == 2) {
        if ($nums[1] === "00") {
            return $billions . ' DOLLARS';
        } else {
            $decimal = convert_billions(ltrim($nums[1], "0"));
            return $billions . ' DOLLARS AND ' . $decimal . ' CENTS';
        }
    } else {
        return $billions . ' DOLLARS';
    }
}

var_dump(convert_num_with_decimal('123.45'));
var_dump(convert_num_with_decimal('100.05'));
var_dump(convert_num_with_decimal('100001.01'));
var_dump(convert_num_with_decimal('1789501.25'));
var_dump(convert_num_with_decimal('789481.00'));
var_dump(convert_num_with_decimal('2156175.50'));
var_dump(convert_num_with_decimal('1111111.11'));
var_dump(convert_num_with_decimal('10002005.77'));
