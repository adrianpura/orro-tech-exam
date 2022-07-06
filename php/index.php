<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Number to Word - PHP</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous" />
    <?php
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    ?>
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <script>
        function showWords(str) {
            if (str.length == 0) {
                document.getElementById("words-result").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("words-result").innerHTML = this.responseText;
                    }
                }
                xmlhttp.open("GET", "num-to-words-oop.php?q=" + str, true);
                xmlhttp.send();
            }
        }
    </script>
</head>

<body>
    <?php
    include('num-to-words-oop.php');
    ?>
    <header class="py-3 mb-4 border-bottom">
        <div class="container d-flex flex-wrap justify-content-center">
            <a href="/" class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <svg class="bi me-2" width="40" height="32">
                    <use xlink:href="#bootstrap"></use>
                </svg>
                <span class="fs-4">Number to Words</span>
            </a>
            <form class="col-12 col-lg-auto mb-3 mb-lg-0" role="search"></form>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col-6">
                <form action="num-to-words-oop.php" method="get">
                    <div class="form-group">
                        <label for="numberInput">Please input number:</label>
                        <input type="number" class="form-control" id="num-to-convert" name="num-to-convert" onkeyup="showWords(this.value)">
                    </div>
                    <div class="form-group">
                        <span id="words-result">Result</span>
                    </div>
                </form>
            </div>
            <div class="col">
            </div>
        </div>
    </div>
</body>

</html>