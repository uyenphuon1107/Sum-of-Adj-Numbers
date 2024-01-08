<!DOCTYPE html>
<html>
<head>
    <title>Number Sum and Factorial</title>
</head>
<body>
    <h1>Find Sum of 5 Adjacent Numbers and Factorial Sum</h1>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".txt">
        <input type="submit" name="upload" value="Upload">
    </form>
    <?php

    function findMaxSumAndFactorialSum($numbersString) {
        // Remove any non-digit characters and whitespace
        $numbersString = preg_replace("/[^0-9]/", "", $numbersString);

        // Check if the input contains exactly 1000 numbers
        if (strlen($numbersString) != 1000) {
            return "File does not contain 1000 numbers.";
        }

        $maxSum = 0;

        for ($i = 0; $i <= (strlen($numbersString) - 5); $i++) {
            // Find the sum of 5 adjacent numbers
            $currentSum = 0;
            for ($j = 0; $j < 5; $j++) {
                $currentSum += $numbersString[$i + $j];
            }

            if ($currentSum > $maxSum) {
                $maxSum = $currentSum;
            }
        }

        // Calculate the factorial sum of the max sum
        $factorialSum = 0;
        $maxSumDigits = str_split($maxSum);
        foreach ($maxSumDigits as $digit) {
            $factorialSum += factorial((int)$digit);
        }

        return $factorialSum;
    }

    function factorial($n) {
        if ($n <= 1) {
            return 1;
        } else {
            return $n * factorial($n - 1);
        }
    }

    if (isset($_POST['upload'])) {
        if ($_FILES['file']['error'] === 0) {
            $fileContent = file_get_contents($_FILES['file']['tmp_name']);
            $result = findMaxSumAndFactorialSum($fileContent);
            if (is_numeric($result)) {
                echo "<p>Sum of Factorials: $result</p>";
            } else {
                echo "<p>$result</p>";
            }
        } else {
            echo "<p>Error uploading the file.</p>";
        }
    }
    ?>

</body>
</html>
