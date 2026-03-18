<?php
// 1
echo "<h3>Завдання 1</h3>";
echo "Hello, World!<br>";

// 2
echo "<h3>Завдання 2</h3>";

$strVar = "Тестовий рядок"; // string
$intVar = 21;               // integer
$floatVar = 70.5;           // float
$boolVar = true;            // boolean

echo "Значення змінних:<br>";
echo "Рядок: $strVar <br>";
echo "Ціле число: $intVar <br>";
echo "Число з комою: $floatVar <br>";
echo "Булеве: " . ($boolVar ? 'true' : 'false') . "<br><br>";

echo "Типи змінних (var_dump):<br>";
var_dump($strVar);
echo "<br>";
var_dump($intVar);
echo "<br>";
var_dump($floatVar);
echo "<br>";
var_dump($boolVar);
echo "<br>";

// 3
echo "<h3>Завдання 3</h3>";

$word1 = "Coding on ";
$word2 = "PHP";
$resultString = $word1 . $word2;
echo $resultString . "<br>";

// 4
echo "<h3>Завдання 4</h3>";

$number = 15;

if ($number % 2 === 0) {
  echo "Число $number є парним.<br>";
} else {
  echo "Число $number є непарним.<br>";
}

// 5
echo "<h3>Завдання 5</h3>";

echo "Цикл for (від 1 до 10):<br>";
for ($i = 1; $i <= 10; $i++) {
  echo $i . " ";
}
echo "<br><br>";

echo "Цикл while (від 10 до 1):<br>";
$j = 10;
while ($j >= 1) {
  echo $j . " ";
  $j--;
}
echo "<br>";

// 6
echo "<h3>Завдання 6</h3>";

$student = [
  "Ім'я" => "Арсеній",
  "Прізвище" => "Зарецький",
  "Вік" => 21,
  "Спеціальність" => "бла бла бла"
];

echo "Інформація про студента:<br>";
foreach ($student as $key => $value) {
  echo "<b>$key:</b> $value <br>";
}

$student["Середній бал"] = 4.8;

echo "<br>Оновлений масив:<br>";
echo "<pre>";
print_r($student);
echo "</pre>";
?>