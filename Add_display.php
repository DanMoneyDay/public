<?php 
    use Maincast\App\Classes\GameButton;
    ini_set('display_errors', 'on');
    error_reporting(E_ALL);
    require __DIR__ . '/../vendor/autoload.php';
    
    $games = GameButton::fetchAll();
    
?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма для добавления имени</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Добавить Турнир</h1>
        <form action="Add_handler.php" method="post" enctype="multipart/form-data" >
            <label for="tourname"> Название турнира:</label>
            <input type="text" id="tourname" name="tourname" required>
            <label for="discription">Описание:</label>
            <input type="text" id="discription" name="discription" required>
            <label for="start_date">Начала турнира:</label>
            <input type="date" name="start_date" required>
            <label for="end_date">Конец турнира:</label>
            <input type="date"  name="end_date" required>
            <label for="prize_pool">Призовой фонд:</label>
            <input type="number" id="prize_pool" name="prize_pool" required>
            <label for="format">Формат турнира:</label>
            <select  id="format"name="format" >
                <option value="Single Elimination">Single Elimination</option>
                <option value="Double Elimination">Double Elimination</option>
                <option value="Round Robin">Round Robin</option>
            </select><br>
            <label for="logo"> Логотип:</label>
            <input type="file" id="logo" name="logo" required>
            <br><br>
            <select  name="gameButton" >
                <?php foreach ($games as $gameButton):  ?>
                <option value="<?php echo $gameButton['id']; ?>"><?php echo $gameButton['name']; ?></option>
                <?php endforeach; ?> 
            </select><br>
            <br/>
            <input type="submit" value="Добавить">
        </form>
    </div>
</body>
</html>