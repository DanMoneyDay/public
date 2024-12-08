<?php
use Maincast\App\Classes\GameHandler;

ini_set('display_errors', 'on');
error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        $id = $_POST["id"] ?? null;
        $logo = $_FILES["logo"] ?? null;
        $tourname = $_POST["tourname"] ?? null;
        $discription = $_POST["discription"] ?? null;
        $start_date = $_POST["start_date"] ?? null;
        $end_date = $_POST["end_date"] ?? null;
        $prize_pool = $_POST["prize_pool"] ?? null;
        $format = $_POST["format"] ?? null;
        $gameButton = $_POST["gameButton"] ?? null;

    try {
        // Проверяем обязательные полz
        $handler = new GameHandler($logo, $tourname, $discription, $start_date, $end_date, $prize_pool, $format, $gameButton, $id);
        $handler->validateInput();
        $handler->saveAll();
        
            
        

            
            header("Location: /display.php?id=" . $handler->getId());
            exit;
        } catch (Exception $e) {
        echo "Помилка: " . $e->getMessage();
    }
