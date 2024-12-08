<?php

use Maincast\App\Classes\GameButton;
use Maincast\App\Classes\GameHandler;


ini_set('display_errors', 1);
error_reporting(E_ALL);
require __DIR__ . '/../vendor/autoload.php';

$tournaments = GameHandler::fetchAll();
$gamesButton = GameButton:: fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ігри</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h1 {
            color: #333;
        }

        a {
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }

        a:hover {
            color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: separate;
            margin: 20px 0;
        }

        th, td {
            border: 1px solid black;
            padding: 12px;
            text-align: left;
            /* border-bottom: 1px solid #ddd; */
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        button {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        img {
            max-width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Турніри</h1>
    <a href="/Add_display.php">Додати турнір</a>
    <br/><br/>

    
    <!-- Кнопки фильтрации -->
    <div>
        <button onclick="filterTable('all')">All</button>
        <button onclick="filterTable('CS2')">CS2</button>
        <button onclick="filterTable('DOTA2')">DOTA2</button>
        <button onclick="filterTable('Valorant')">Valorant</button>
    </div>
    <br/>
    
    <table id="gameButtonsTable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Назва турніру</th>
                <th>Опис</th>
                <th>Дата початку турніру</th>
                <th>Дата закінчення турніру</th>
                <th>Призовий фонд</th>
                <th>Формат</th>
                <th>Гра</th>
                <th>Логотип</th>
                <th>Дата створення</th>
                <th>Дії</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($tournaments as $handler) {
                echo "<tr>";
                echo "<td>{$handler['id']}</td>";
                echo "<td>{$handler['tourname']}</td>";
                echo "<td>{$handler['discription']}</td>";
                echo "<td>{$handler['start_date']}</td>";
                echo "<td>{$handler['end_date']}</td>";
                echo "<td>{$handler['prize_pool']} $ </td>";
                echo "<td>{$handler['format']} </td>";
                echo "<td>{$handler['gameButton_name']}</td>";
                echo "<td><img src='{$handler['logoPath']}' alt='Логотип'></td>";
                echo "<td>{$handler['created_at']}</td>";
                echo "<td><a href='/display.php?id={$handler['id']}'>Переглянути</a></td>";
                echo "</tr>";
            }  
            ?>
        </tbody>
    </table>

    <script>
        function filterTable(gameButton_name) {
            var table, tr, td, i;
            table = document.getElementById("gameButtonsTable");
            tr = table.getElementsByTagName("tr");

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = "none"; // Скрываем все строки
                td = tr[i].getElementsByTagName("td")[7]; // Получаем столбец с названием игры
                if (td) {
                    if (gameButton_name === "all" || td.innerHTML.toUpperCase().indexOf(gameButton_name.toUpperCase()) > -1) {
                        tr[i].style.display = ""; // Показываем строки, соответствующие фильтру
                    }
                }       
            }
        }
    </script>
</body>
</html>






