class NumToWords {
    constructor(num, ones = [], teens = [], tens = []) {
        this.num = num
        this.ones = ones
        this.teens = teens
        this.tens = tens
    }
    convert_tens(num) {
        if (num < 10) {
            return ones[num];
        } else if (num >= 10 && num < 20) {
            return teens[num - 10];
        } else {
            return num % 10 === 0 ? tens[Math.floor(num / 10)] : tens[Math.floor(num / 10)] + " " + ones[num % 10];
        }
    }

    convert_hundreds(num) {
        return num > 99 ? num % 100 === 0 ? ones[Math.floor(num / 100)] + " HUNDRED " : ones[Math.floor(num / 100)] + " HUNDRED AND " + this.convert_tens(num % 100) : this.convert_tens(num)
    }

    convert_thousands(num) {
        return num >= 1000 ? this.convert_hundreds(Math.floor(num / 1000)) + " THOUSAND " + this.convert_hundreds(num % 1000) : this.convert_hundreds(num)
    }

    convert_millions(num) {
        return num >= 1000000 ? this.convert_millions(Math.floor(num / 1000000)) + " MILLION " + this.convert_thousands(num % 1000000) : this.convert_thousands(num)
    }

    convert_billions(num) {
        return num >= 1000000000 ? this.convert_billions(Math.floor(num / 1000000000)) + " Billion " + this.convert_millions(num % 1000000000) : this.convert_millions(num)
    }

    convert_num_with_decimal() {
        let nums = this.num.toString().split('.')
        let billions = this.convert_billions(nums[0])
        if (nums.length == 2) {
            let decimal = this.convert_billions(nums[1].replace(/^0+/, ''))
            return nums[1] === '00' ? billions + ' DOLLARS ' : billions + ' DOLLARS AND ' + decimal + ' CENTS'
        } else {
            return billions + ' DOLLARS '
        }
    }

}

const ones = ['ZERO', 'ONE', 'TWO', 'THREE', 'FOUR', 'FIVE', 'SIX', 'SEVEN', 'EIGHT', 'NINE'];
const teens = ['TEN', 'ELEVEN', 'TWELVE', 'THIRTEEN', 'FOURTEEN', 'FIFTEEN', 'SIXTEEN', 'SEVENTEEN', 'EIGHTEEN', 'NINETEEN'];
const tens = ['', '', 'TWENTY', 'THIRTY', 'FORTY', 'FIFTY', 'SIXTY', 'SEVENTY', 'EIGHTY', 'NINETY'];


const numberInputEl = document.querySelector('#num-to-convert')
const wordResultEl = document.querySelector('#words-result')

numberInputEl.addEventListener('input', (e) => {
    const numInput = new NumToWords(e.target.value, ones, teens, tens)
    e.target.value === "" ? wordResultEl.textContent = 'Result' : wordResultEl.textContent = numInput.convert_num_with_decimal()
})


// const num1 = new NumToWords('123.45', ones, teens, tens)
// console.log(num1.convert_num_with_decimal())
// const num2 = new NumToWords('100.05', ones, teens, tens)
// console.log(num2.convert_num_with_decimal())
// const num3 = new NumToWords('100001.01', ones, teens, tens)
// console.log(num3.convert_num_with_decimal())
// const num4 = new NumToWords('1789501.25', ones, teens, tens)
// console.log(num4.convert_num_with_decimal())
// const num5 = new NumToWords('789481.00', ones, teens, tens)
// console.log(num5.convert_num_with_decimal())
// const num6 = new NumToWords('2156175.50', ones, teens, tens)
// console.log(num6.convert_num_with_decimal())
// const num7 = new NumToWords('1111111.11', ones, teens, tens)
// console.log(num7.convert_num_with_decimal())
// const num8 = new NumToWords('10002005.77', ones, teens, tens)
// console.log(num8.convert_num_with_decimal())