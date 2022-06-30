<!-- accepts 0-999 and two decimals  -->
<!-- used floor iunstead of Math.floor to get the largest integer less than or equal to the number -->
<!-- used remainder operator to get the remainder of the given hundred -->
<!-- used (string) instead of toString to ensure that the given number is string before using the explode() instead of split method to convert it into an array -->
<!-- replace string concatenation from + to . -->
<!-- set the arrays into a  global variable to access inside a function -->

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
        return $tens[floor($num / 10)] . " " . $ones[$num % 10];
    }
}

function convert_hundreds($num)
{
    global $ones;

    if ($num > 99) {
        return $ones[floor($num / 100)] . " HUNDRED AND " . convert_tens($num % 100);
    } else {
        return convert_tens($num);
    }
}

function convert_num_with_decimal($num)
{
    $nums = explode('.', (string)$num);
    $hundreds = convert_hundreds($nums[0]);
    if (count($nums) == 2) {
        $decimal = convert_hundreds($nums[1]);
        return $hundreds . ' DOLLARS AND ' . $decimal . ' CENTS';
    } else {
        return $hundreds;
    }
}

var_dump(convert_num_with_decimal(123.45));
// string(57) "ONE HUNDRED AND TWENTY THREE DOLLARS AND FORTY FIVE CENTS"