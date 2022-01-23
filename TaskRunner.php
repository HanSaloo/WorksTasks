<?php
/*
Дано: функція яка приймає масив чисел або стрічок.
Результат: вивести у консоль масив унікальних значень початкового масиву
Приклад: [2, 3, 1, 3, 3, 7] => [2,3,1,7]

Дано: функція яка приймає масив чисел
Результат: вивести у консоль "YES" якщо усі числа у масив парні та "NO" в іншому випадку
Приклад:
[1, 2, 3, 9] => “NO”
[2, 4, 6] => “YES”

Дано: функція яка приймає масив елементів будь-яких типів
Результат: вивести у консоль масив який містить лише стрічки початкового масиву
Приклад:
[2, “string”, 3, , , ”test”] => [“string”, “test”]

Дано: Функція приймає масив типу [[name]: [age: number, city: string]]
Результат: Вивести у консоль масив із іменами людей які із міста "London" та старше 18 років
Приклад:
[Max: [age: 23, city: “London”], Mike: [age: 20: city: “NY”]] => [“Max”]

Дано: Функція приймає три параметри: масив масивів [[], []], назву поля масиву (string), значення (string)
Результат: Вивести у консоль новий масив з якого видалені усі обєкти в яких keyName буде дорівнювати value
Приклад:
removeObj([[age: 1],[age: 2], [age: 2], [year: 2]], "age", 2) => [ [ age: 1 ], [ year: 2 ] ]
*/

class TaskRunner
{
    public function Runner($i)
    {

        switch ($i) {
            case 1:
                $numbArr = [];
                for ($i = 0; $i < 50; $i++) {
                    $numbArr[$i] = rand(-10, 10);
                }
                $clearArr = array_unique($numbArr);
                print_r($numbArr);
                print_r($clearArr);

                break;
            case 2:
                $numbArrIn = [];

                for ($i = 0; $i < 5; $i++) {
                    $numbArrIn[] = readline();
                }
                for ($i = 0; $i < count($numbArrIn); $i++) {
                    if ($numbArrIn[$i] & 1) {
                        echo "число " . $numbArrIn[$i] . " не парне!\n";
                        echo "ну або NO~\n";
                    } elseif (!($numbArrIn[$i] & 1)) {
                        echo "число " . $numbArrIn[$i] . " парне!\n";
                        echo "ну або YES~\n";
                    }
                }
                break;
            case 3:
                $valArrIn = ["SAK-Sak", 34, "Hayrule", 23, 5, 23, "Zelda", 42, 3, 5, 2, 3, 2, 2, 3, 5, 23, 5, 23, 52, 35, 2, 35, "Link!", 23, 5, 23, 5, 23];
                print_r("before" . $valArrIn);
                foreach ($valArrIn as $key => $value) {
                    if (gettype($value) != "string") {
                        unset($valArrIn[$key]);
                    }
                }
                print_r("after" . $valArrIn);
                break;
            case 4:
                $tinderArr = ["Vadim" => ["age" => 17, "city" => "Bobruisk"],
                    "Terentiy" => ["age" => 90, "city" => "Sibir"],
                    "Ivan" => ["age" => 22, "city" => "Archem"],
                    "Bebey" => ["age" => 23, "city" => "!Archem"],
                    "Oubed" => ["age" => 69, "city" => "Insmoot"],
                    "Velind" => ["age" => 47, "city" => "Archem"],
                    "Howard" => ["age" => 20, "city" => "Archem"],
                    "Pedro" => ["age" => 17, "city" => "Bobruisk"],
                    "Rick" => ["age" => 33, "city" => "Bobruisk"],
                    "Morty" => ["age" => 18, "city" => "Bobruisk"],
                    "♂Van♂" => ["age" => 54, "city" => "Bobruisk"],
                    "Herobrine" => ["age" => 21, "city" => "Archem"],
                    "Nafan'ya" => ["age" => 22, "city" => "Archem"],
                ];
                echo "Above 18 y.o and from Archem \n\n";//because Archem is better than London!
                echo "Choose your partner: \n";
                foreach ($tinderArr as $key => $arr) {
                    if ($arr['age'] >= 18 && $arr['city'] = 'Archem') {
                        echo $key . ". He's " . $arr['age'] . " y.o. and from " . $arr['city'] . ".\n";
                    }
                }
                break;
            case 5:

                $killerArrIn = [
                  ["day"=> 31, "month"=> 12, "year"=> 1, "minute"=> 60,"second"=> 60,"season"=> 4,"sentury"=> 15],
                  ["day"=> 20, "month"=> 33, "year"=> 1, "minute"=> 60,"second"=> 60,"season"=> 4,"sentury"=> 15]
                ];
                $faceControl = readline();
                echo "Array before: \n";
                print_r($killerArrIn);

                foreach ($killerArrIn as $key => $arr){
                    foreach ($arr as $item => $val) {
                        if ($faceControl == $item){
                            unset($killerArrIn[$key][$item]);
                        }
                    }
                }
                echo "Array after: \n";

print_r($killerArrIn);
                break;

            default:
                if (gettype($i) == "string") {
                    echo "Ага, ага... Сам ти " . $i . "\n";
                }
        }
    }
}