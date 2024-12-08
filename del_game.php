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
    
    try{
    
        GameHandler::delById($_GET['id']);
    
    }catch(\Exception $e){
        echo "Помилка:" . $e->getMessage();
        echo "<br><a href='/game_display.php'> HOME </a>";
        exit;
    }
    
    
    header("Location: /game_display.php");
    exit;
    

?>