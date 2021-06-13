<?php

// ------------------------------------------------------------------------------------------------

function findSimple(int $a, int $b): array
{
    $arr = []; // создаем пустой массив
	if ($a > 0 && $b > 0){ // проверяем входные переменные, чтобы не было отрицательных значений
	    for ($i = $a; $i <= $b; $i++){ // используя цикл, наполняем массив значениями от a до b
            $del = 0; // записываем сколько раз число поделилось на i
            for ($d = 1; $d <= $b; $d++) {
                if ($i % $d == 0) { // прибавляем 1 к del каждый раз когда i делится на d без остатка.
                    $del++;         // Если делится больше 2 раз, то число составное.
                }                   // А если 2 раза, то число поделилось только на 1 и на само себя и является простым
            }
            if ($del == 2) {        // если число простое, то оно записывается в массив
                $arr[] = $i;
            }
        }
        }
	return $arr; // возвращаем готовый массив из простых чисел
}

// ------------------------------------------------------------------------------------------------

function createTrapeze($a): array
{

    if (min($a) < 0) // Проверяем массив на положительные числа
    {
        throw new Exception("В массиве имеются отрицательные числа"); // выбрасываем исключение
    }

    if (count($a) % 3 == 0) { // Проверяем массив, чтобы он был кратен 3 значениям
        $dvumer = array_chunk($a, 3); // разделяем одномерный массив на двумерные массивы по 3 значения
        $result = array_map(function ($kusok) {
            $kusok = array_combine(['a', 'b', 'c'], $kusok);
            return $kusok;
        }, $dvumer); // методом array_map мы применяем функцию order к каждому куску массива
        return $result; // возвращаем двумерный ассоциативный массив ИСПРАВИЛ: вынес return за предел if(count($a) % 3 == 0)
    }else{
        throw new Exception("В массиве должно быть 3 значения");
    }

}

// ------------------------------------------------------------------------------------------------

function squareTrapeze(array &$a)
{
    foreach ($a as &$kusok) {
        $kusok['s'] = ($kusok['a'] + $kusok['b']) / 2 * $kusok['c'];
    }
}

// ------------------------------------------------------------------------------------------------

function getSizeForLimit($a, $b){
    foreach ($a as $key => $array) {
        foreach ($array as $key2 => $value) {
            if ($key2 == 's' && $value > $b) { // Если площадь будет больше $b
                unset($a[$key]);                // то удаляется весь массив
            }
        }
    }
    return $a;

}

// ------------------------------------------------------------------------------------------------

function getMin($a){
    $min = null;
    foreach ($a as $value) { // циклом foreach проходимся по каждому значению массива $a
        if ($value < $min or $min === null){ // проверяем на условие: "если значение меньше минимального или min равна null"
            $min = $value; // то присваиваем min значение value
        }
    }
    return $min;
}

// ------------------------------------------------------------------------------------------------

function printTrapeze($a){
    ?>
    }
    <table class="city_list">
        <tr><td>Сторона 1</td><td>Сторона 2</td><td>Высота</td><td>Площадь</td></tr>
        <?php foreach ($a as $arr1): ?>
            <tr>
                <?php foreach ($arr1 as $key => $row): ?>
                    <td><?php if ($key == "s" && $row % 2 == 1){
                            echo "<strong>$row</strong>";}
                        else echo $row ?></td>
                    }
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
    </table>

    <style>
        .city_list {
            width: 100%;
        }
        .city_list td {
            width: 25%;
            border: 1px solid #ddd;
            padding: 7px 10px;
        }
    </style>

<?php }

// ------------------------------------------------------------------------------------------------

abstract class BaseMath
{
    public function exp1($a, $b, $c) {
        return $a * ($b ^ $c);
    }

    public function exp2($a, $b, $c) {
        return ($a / $b) ^ $c;
    }

    abstract public function getValue();
}

// ------------------------------------------------------------------------------------------------

class F1 extends BaseMath
{
    public $a;
    public $b;
    public $c;

    public function __construct($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function getValue()
    {
        return $this->exp1($this->a, $this->b, $this->c) + ($this->exp2($this->a, $this->b,
                    $this->c) % 3) ^ min($this->a,
                $this->b, $this->c);

    }

}

// ------------------------------------------------------------------------------------------------

