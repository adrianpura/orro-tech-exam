//accepts 0-999 and two decimals 
//used Math.floor to get the largest integer less than or equal to the number
//used remainder operator to get the remainder of the given hundred
//used toString to ensure that the given number is string before using the split method to convert it into an array


let ones = ['ZERO', 'ONE', 'TWO', 'THREE', 'FOOR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE'];
let teens = ['TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'];
let tens = ['', '', 'TWENTY', 'THIRTY', 'FORTY', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY'];

function convert_tens(num) {
    if (num < 10) {
        return ones[num];
    } else if (num >= 10 && num < 20) {
        return teens[num - 10];
    } else {
        return tens[Math.floor(num / 10)] + " " + ones[num % 10];
    }
}

function convert_hundreds(num) {
    if (num > 99) {
        return ones[Math.floor(num / 100)] + " HUNDRED AND " + convert_tens(num % 100);
    } else {
        return convert_tens(num);
    }
}

function convert_num_with_decimal(num) {
    let nums = num.toString().split('.')
    let hundreds = convert_hundreds(nums[0])
    if (nums.length == 2) {
        let decimal = convert_hundreds(nums[1])
        return hundreds + ' DOLLARS AND ' + decimal + ' CENTS';
    } else {
        return hundreds;
    }
}


console.log(convert_num_with_decimal('123.45'))
// ONE HUNDRED AND TWENTY THREE DOLLARS AND FORTY FIVE CENTS