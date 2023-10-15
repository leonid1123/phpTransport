<?php
$names = array("Города", "Москва", "Питер", "Казань", "Ростов", "Новороссийск");
$places = array(
    array($names[1], 0, 650, 790, 1200, 1440),
    array($names[2], 650, 0, 1500, 1850, 2090),
    array($names[3], 790, 1500, 0, 2130, 2270),
    array($names[4], 1200, 1850, 2130, 0, 520),
    array($names[5], 1440, 2090, 2270, 520, 0)
);
# переделать на использование только массива cars1 и carNames
$cars = array(
    array("ВАЗ 21099", 9, 57.4),
    array("ВАЗ 22087", 8.5, 59),
    array("Форд Фокус", 10.4, 58),
);
# после массива carNames создавать массив с расходом и ценой топлива
$carNames = array("ВАЗ 21099", "ВАЗ 22087", "Форд Фокус");
$cars1 = array(
    $carNames[0] => array(9, 57.4),
    $carNames[1] => array(8.5, 59),
    $carNames[2] => array(10.4, 58)
);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Расход топлива</h2>
    <h3>Таблица точек поставки. Расстояние в км.</h3>
    <table>
        <?php
        echo "<tr>";
        for ($i = 0; $i < 6; $i++) {
            echo "<td>" . $names[$i] . "</td>";
        }
        echo "</tr>";
        for ($i = 0; $i < 5; $i++) {
            echo "<tr>";
            for ($j = 0; $j < 6; $j++) {
                echo "<td>" . $places[$i][$j] . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    <div class="row">
        <h3>Таблица автомобилей</h3>
        <button onclick="hideCars(this)">&#8744;</button>
    </div>
    <table id="carsTable">
        <tr>
            <td>Марка</td>
            <td>Расход на 100км.</td>
            <td>Стоимость 1 л. в руб.</td>
        </tr>
        <?php
        foreach ($cars as $key => $value) {
            echo "<tr>";
            foreach ($value as $key => $value) {
                echo "<td>" . $value . "</td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
    <h3>Стоимость топлива</h3>
    <!-- переделать на безопасный метод -->
    <form method="post" action="index.php">
        <label for="car-select">Укажите автомобиль:</label>
        <select name="car" id="car-select">
            <option value="">--Укажите автомобиль--</option>
            <?php
            for ($i = 0; $i < 3; $i++) {
                echo "<option value='" . $carNames[$i] . "'>" . $carNames[$i] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Расчитать" name="go">
    </form>
    <table>
        <?php
        if (!is_null($_POST["go"])) {
            echo "<p>" . $_POST["car"] . "</p>";
            [$rashod, $fuelPrice] = $cars1[$_POST["car"]];
            # echo "<p>" . $rashod . "</p>";
            # echo "<p>" . $fuelPrice . "</p>";
            echo "<tr>";
            for ($i = 0; $i < 6; $i++) {
                echo "<td>" . $names[$i] . "</td>";
            }
            echo "</tr>";
            for ($i = 0; $i < 5; $i++) {
                echo "<tr>";
                for ($j = 0; $j < 6; $j++) {
                    if ($j == 0) {
                        echo "<td>" . $places[$i][$j] . "</td>";
                    } else {
                        echo "<td>" . $places[$i][$j] / 100 * $rashod * $fuelPrice . "руб.</td>";
                    }
                }
                echo "</tr>";
            }
        }
        ?>
    </table>
    <script>
        let a = document.getElementById("carsTable")
        let cl = true;

        function hideCars(_button) {
            if (cl) {
                _button.innerHTML = "&#8743";
                cl = !cl;
                a.style.display = "none"

            } else {
                _button.innerHTML="&#8744;";
                cl = !cl
                a.style.display = "table"
            }
        }
    </script>
</body>

</html>