<?
include 'MyFormulaCalculation.class.php';//класс
//получить данные с файла, вывести в массив до = ключ, после значение
//раcформировать массив в два массива - массив с формулой и массив с переменной 
$filename = __DIR__ . '/file.txt';
$fh_arr = file($filename);//читаем содержимое и выводим в массив
$actions = [ '*' => 1, '/' => 1, '+' => 1, '-' => 1 ];
$arr_value = [];
        
$arr_fn = [];//переменная содержащая функции
$arr_variable = [];//переменная содержащая переменные

foreach($fh_arr as $line) {
    $line_arr = explode("=", $line); //преобразуем в массив , разделив по знаку = 
    if (2 != count($line_arr)) continue; 
               
    if(fnGetLeftAction($line_arr[1])) {
        $arr_fn[$line_arr[0]] = $line_arr[1];
        $arr_obj[] = $line_arr[1];
    } else {
        $arr_variable[$line_arr[0]] = $line_arr[1];
    }
}

echo '<pre>';
print_r($arr_obj);
echo '</pre>';

//Находим самый левый ключ операции или нуль
function fnGetLeftAction(string $variable_or_function_data) {
    $arr = str_split($variable_or_function_data);
    global $actions;
    foreach($arr as $value) {
        if (array_key_exists($value, $actions)) {
            return $value;
        } 
    }
}

/*Объявление публичной фукнкции, которая принимает строку с описаниеформулы и возвращает bool - удалось или нет инициализировать объект*/
$mfc = new MyFormulaCalculation();
$mfc->fnCreate("lalala");

//если объект смог обработать данные, мы засовываем объект в массив
print_r($mfc);
?>
