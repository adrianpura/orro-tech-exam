//accepts 0 to billions and two decimals 
//used Math.floor to get the largest integer less than or equal to the number
//used remainder operator to get the remainder of the given hundred
//used toString to ensure that the given number is string before using the split method to convert it into an array
// used .replace fucntion to replace zero on decimals before whole number

const ones = ['ZERO', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE'];
const teens = ['TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'];
const tens = ['', '', 'TWENTY', 'THIRTY', 'FORTY', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY'];

function convert_tens(num) {
    if (num < 10) {
        return ones[num];
    } else if (num >= 10 && num < 20) {
        return teens[num - 10];
    } else {
        return num % 10 === 0 ? tens[Math.floor(num / 10)] : tens[Math.floor(num / 10)] + " " + ones[num % 10];
    }
}

function convert_hundreds(num) {
    return num > 99 ? num % 100 === 0 ? ones[Math.floor(num / 100)] + " HUNDRED " : ones[Math.floor(num / 100)] + " HUNDRED AND " + convert_tens(num % 100) : convert_tens(num)
}

function convert_thousands(num) {
    return num >= 1000 ? convert_hundreds(Math.floor(num / 1000)) + " THOUSAND " + convert_hundreds(num % 1000) : convert_hundreds(num)
}

function convert_millions(num) {
    return num >= 1000000 ? convert_millions(Math.floor(num / 1000000)) + " MILLION " + convert_thousands(num % 1000000) : convert_thousands(num)
}

function convert_billions(num) {
    return num >= 1000000000 ? (convert_billions(Math.floor(num / 1000000000)) + " Billion " + convert_millions(num % 1000000000)) : convert_millions(num)
}

function convert_num_with_decimal(num) {
    let nums = num.toString().split('.')
    let billions = convert_billions(nums[0])
    if (nums.length == 2) {
        let decimal = convert_billions(nums[1].replace(/^0+/, ''))
        return nums[1] === '00' ? billions + ' DOLLARS ' : billions + ' DOLLARS AND ' + decimal + ' CENTS'
    } else {
        return billions
    }
}

console.log(convert_num_with_decimal('123.45'))
console.log(convert_num_with_decimal('100.05'))
console.log(convert_num_with_decimal('100001.01'))
console.log(convert_num_with_decimal('1789501.25'))
console.log(convert_num_with_decimal('789481.00'))
console.log(convert_num_with_decimal('2156175.50'))
console.log(convert_num_with_decimal('1111111.11'))
console.log(convert_num_with_decimal('10002005.77'))