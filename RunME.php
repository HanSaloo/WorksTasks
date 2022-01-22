<?php

include_once 'TaskRunner.php';

$get = new TaskRunner();

echo "Task 1 - Унікальні числа\n";
echo "Task 2 - Парні !парні(дєвачкі)\n";
echo "Task 3 - Числа вийшли з чату(прям всі =( )\n";
echo "Task 4 - Пошук в тіндері\n";
echo "Task 5 - Вибіркова різня!\n"; // не готово

echo "\n";
echo "Enter a task number: \n";
$i = readline();

echo $get -> Runner($i);
//C:\Users\Asd\Desktop\WorksTasks-main