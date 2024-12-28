<?php
require_once 'SelectAnswer.php';
//викторина
//скрипт должен задавать 1 вопрос и предоставить несколько вариантов ответа и запрашивать ответ
//если ответ не верный, вывести сообщение ошибка и завершить программу
//если ответ был не из перечисленных вариантов, повторить вопрос
//если ответ верный, поздравить и завершить программу

//* сделайте массив вопросов и ответов, и вызывайте их в цикле

$countCorrectAnswers = 0;
$countWrongAnswers = 0;

$questions = [
    ["text" => "What programming language are we learning?",
        "answers" => [
            1 => "Java",
            2 => "Python",
            3 => "PHP"
        ],
        "correctAnswer" => 3
        ],
    ["text" => "Is PHP a strongly typed programming language?",
        "answers" => [
            1 => "Yes",
            2 => "No"
        ],
        "correctAnswer" => 2
        ],
    ["text" => "What operator in the PHP programming language is used to display strings,
     numbers, and other data on the screen?",
        "answers" => [
            1 => "echo",
            2 => "System.Console.WriteLine()",
            3 => "print()"
        ],
        "correctAnswer" => 1
        ]

];

$i = 0;
while ($i < count($questions)) {

    //получеам выбор пользователя
    $userAnswer = SelectAnswer::selectAnswer($questions[$i]['text'],$questions[$i]['answers']);
    if($userAnswer === $questions[$i]['correctAnswer']) {
        echo "Your chosen answer ($userAnswer: " . $questions[$i]['answers'][$userAnswer]
           . ") is correct." . PHP_EOL;
        $countCorrectAnswers += 1;
    }else {
        echo "Your chosen answer ($userAnswer: " . $questions[$i]['answers'][$userAnswer]
           . ") is incorrect." . "The correct answer is (" . $questions[$i]['correctAnswer']
        . ": " . $questions[$i]['answers'][$questions[$i]['correctAnswer']] . ")." . PHP_EOL;
        $countWrongAnswers += 1;
    }
    sleep(2);
    $i++;
}

// итоговая статистика
echo "Quiz finished." . PHP_EOL;
echo "Correct Answer: $countCorrectAnswers" . PHP_EOL;
echo "Wrong Answer: $countWrongAnswers" . PHP_EOL;

