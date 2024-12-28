<?php

class SelectAnswer
{
    public static function  selectAnswer($question, $answers)
    {
        $selected = 1;
        while(true) {
            //чистим экран
            echo "\033[H\033[J";

            //печатаем вопрос и подсвечиваем ответы
            echo $question . PHP_EOL . PHP_EOL;

            foreach ($answers as $index => $answer) {
                if($index == $selected) {
                    //подсвечиваем текущий ответ
                    echo " > \033[32m$answer\033[0m" . PHP_EOL;
                } else {
                    echo "   $answer" . PHP_EOL;
                }
            }

            //ожидаем ввода клавиши
            $key = self::readKey();

            // обработка клавиш
            if($key == "up") {
                $selected = ($selected > 1) ? $selected - 1 : count($answers);
            } elseif ($key == "down") {
                $selected = ($selected < count($answers)) ? $selected + 1 : 1;
            } elseif ($key == "enter") {
                return $selected;
            }
        }
    }

    private static function readKey()
    {
        // Включаем режим ввода без необходимости нажимать Enter
        shell_exec('stty -icanon -echo');
        $key = fread(STDIN, 1); // Читаем один символ
        shell_exec('stty icanon echo');

        // Определяем клавишу
        if (ord($key) === 27) { // Escape последовательности
            fread(STDIN, 1); // Пропускаем [
            $arrow = fread(STDIN, 1);
            if ($arrow === "A") {
                return "up";
            } elseif ($arrow === "B") {
                return "down";
            }
        } elseif (ord($key) === 10) { // Нажатие Enter
            return "enter";
        }
        return null;
    }
}