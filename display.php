<?php 
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
    
    
    
    use Maincast\App\Classes\GameHandler;

    require __DIR__  . '/../vendor/autoload.php';
    
    
    
    if(!isset($_GET['id']))
    {
        header("Location: index.php");
        exit;
    }
    
    $handler = GameHandler::fetchById($_GET['id']);
    
    if($handler===null){
        echo "Турнир не знайдена БЛЄТ";
    }


    echo "<h1> Ваш книга</h1>";
    echo "<a href='/del_game.php?id=". $handler['id']."'>Очистити</a><br>";
    echo "<a href='/game_display.php'>HOME</a><br>";
    echo "<a href='/redaktor.php?id=". $handler['id']."'>Редагувати</a><br>";
    echo "Назва  турнира:". $handler['tourname'] . "<br>";
    echo "Описание:". $handler['discription']. "<br>";
    echo "начало турнира". $handler['start_date']. "<br>";
    echo "Конец турнира". $handler['end_date']. "<br>";
    echo "Призовой фонд : " .  $handler['prize_pool'] . "<br>";
    echo "Формат:". $handler['format']. "<br>";
    echo "Игра: " . $handler['gameButton_name']. "<br>";



    echo "Зображення обкладинки:<br> <img src='" . $handler['logoPath'] . "'/><br>";


?>