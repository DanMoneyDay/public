<?php 
namespace Maincast\App\Classes;


// class GameHandler extends Game
// {
    

//     public function Exception($tourname, $discription, $start_date, $end_date, $prize_pool , $format)
//     {
//         if (empty($tourname)) {
//             throw new Exception("Назва турніру не вказана.");
//         }
//         if (empty($discription)) {
//             throw new Exception("Опис турніру не вказано.");
//         }
//         if (empty($start_date)) {
//             throw new Exception("Дата початку турніру не вказана.");
//         }
//         if (empty($end_date)) {
//             throw new Exception("Дата закінчення турніру не вказана.");
//         }
//         if (empty($prize_pool)) {
//             throw new Exception("Призовий фонд не вказано.");
//         }
//         if (empty($format)) {
//             throw new Exception("Формат турніру не вказано.");
//         }
//     }

//     public function validateLogo($logo)
//     {
//         $allowed_types = ['image/jpeg', 'image/png'];
//         $max_size = 1024 * 1024 * 5; // 5MB

//         if (!in_array(mime_content_type($logo['tmp_name']), $allowed_types)) {
//             throw new Exception("Дозволені тільки файли з розширенням .jpg або .png");
//         }

//         if ($logo['size'] > $max_size) {
//             throw new Exception("Файл повинен бути менше 5МБ");
//         }

//         if ($logo['error'] !== UPLOAD_ERR_OK) {
//             throw new Exception("Помилка завантаження файлу. Код помилки: " . $logo['error']);
//         }
//     }

//     public function saveLogo($logo)
//     {
//         $logo_dir = "logo";

//         // Создаем директорию, если она не существует
//         if (!file_exists($logo_dir)) {
//             if (!mkdir($logo_dir, 0777, true) && !is_dir($logo_dir)) {
//                 throw new Exception("Помилка створення директорії: " . $logo_dir);
//             }
//         }

//         $logoTmp = $logo['tmp_name'];
//         $logoName = basename($logo['name']); // Используем basename для безопасности
//         $logoPath = $logo_dir . "/" . $logoName;

//         // Перемещаем загруженный файл
//         if (move_uploaded_file($logoTmp, $logoPath)) {
//             $this->uploadedLogo = $logoPath;
//             $this->logoIsSaved = true;
//         } else {
//             throw new Exception("Помилка завантаження файлу");
//         }
//     }

//     private function insertBd()
//     {
//         $bd = Database::getInstance()->getConnection();
//         $stmt = $bd->prepare("INSERT INTO TOURNAMENTS (logoPath, tourname, discription, start_date, end_date, prize_pool, format, gameButton) VALUES (?,?,?,?,?,?,?,?)");
//         if ($stmt === false) {
//             throw new Exception("Помилка при виконанні запитів");
//         }

//         $stmt->bind_param('sssssdsi', $this->uploadedLogo, $this->tourname, $this->discription, $this->start_date, $this->end_date, $this->prize_pool, $this->format, $this->gameButton);
//         if (!$stmt->execute()) {
//             throw new Exception("Ошибка сохранения: " . $stmt->error);
//         }

//         $this->id = $bd->insert_id;
//         if ($this->id === 0) {
//             throw new Exception("Ошибка сохранения: запись не была добавлена.");
//         }
//         $stmt->close();
//     }

//     private function updateBd()
//     {
//         $bd = Database::getInstance()->getConnection();
//         $stmt = $bd->prepare("UPDATE TOURNAMENTS SET logoPath = ?, tourname = ?, discription = ?, start_date = ?, end_date = ?, prize_pool = ?, format = ?, gameButton = ? WHERE id = ?");
//         if ($stmt === false) {
//             throw new Exception("Помилка при виконанні запитів");
//         }
//         $stmt->bind_param('sssssdsii', $this->uploadedLogo, $this->tourname, $this->discription, $this->start_date, $this->end_date, $this->prize_pool, $this->format, $this->gameButton, $this->id);
//         if (!$stmt->execute()) {
//             throw new Exception("Ошибка сохранения: " . $stmt->error);
//         }
//         $stmt->close();
//     }

//     public function saveBd()
//     {
//         if ($this->id === null) {
//             $this->insertBd();
//         } else {
//             $this->updateBd();
//         }
//     }

//     public function saveTournaments($logo)
//     {
//         // Проверяем изображение
//         $this->validateLogo($logo);
//         // Сохраняем изображение
//         $this->saveLogo($logo);
//         // Сохраняем данные в базу
//         $this->saveBd();
//     }

//     public static function fetchById($id)
//     {
//         $bd = Database::getInstance()->getConnection();
//         $stmt = $bd->prepare("SELECT * FROM TOURNAMENTS WHERE id = ?");
//         if ($stmt === false) {
//             throw new Exception("Помилка при виконанні запитів");
//         }
//         $stmt->bind_param('i', $id);
//         if (!$stmt->execute()) {
//             throw new Exception("Помилка при виконанні запитів");
//         }

//         $result = $stmt->get_result();

//         if ($result === false) {
//             throw new Exception("Помилка при виконанні запитів");
//         }
//         $handler = $result->fetch_assoc();
//         if ($handler === false) {
//             throw new Exception("Помилка при виконанні запитів");
//         }

//         // $gameButton = GameButton::fetchById($handler['gameButton']);
//         // $handler['gameButton_name'] = !empty($gameButton) ? $gameButton['name'] : null;

//         // return $handler;

//         $gameButton = GameButton::fetchById($handler['gameButton']);
//         if (!empty($gameButton) && array_key_exists('name', $gameButton)) {
//             $handler['gameButton_name'] = $gameButton['name'];
//         } else {
//             $handler['gameButton_name'] = null;
//         }

//         // Закрываем выражение
//         $stmt->close();

//         return $handler;
//     }

//     public static function fetchAll()
//     {
//         $bd= Database::getInstance()->getConnection();

//         $stmt = $bd ->prepare("SELECT * FROM TOURNAMENTS ORDER BY created_at DESC");
//         $stmt->execute();

//         $result= $stmt->get_result();
//         if($result === false)
//         {
//             throw new \Exception("Помилка при виконанні запитів");
//         }

//         $GAME= $result->fetch_all(MYSQLI_ASSOC);

//         foreach($GAME as $handler)
//         {
//             $gameButton = GameButton::fetchById($handler['gameButton']);
//             $handler['gameButton_name'] = !empty($gameButton) ? $gameButton['name'] : null;
//         }
//     }

//     public static function delById($id)
//     {
//         $handler= self::fetchById($id);

//         $bd = Database:: getInstance()->getConnection();
//         $stmt = $bd->prepare("DELETE FROM TOURNAMENTS WHERE id = ?");

//         if($stmt === false)
//         {
//             throw new \Exception("Помилка видалення оголошення з БД");
//         }

//         $stmt->bind_param('i', $id);
//         if($stmt->execute() === false)
//         {
//             throw new \Exception("Помилка видалення");
//         }
//         $stmt->close();

//         if(file_exists($handler['logo']))
//         {
//             unlink($handler['logo']);
//         }

//         return $handler;
//     }
// }



namespace Maincast\App\Classes;

use Maincast\App\Classes\Game;


class GameHandler extends Game
{

    public function validateInput(){
        
        // if (empty($_POST['description']) || empty($_POST['prize_pool'])) {
        //     throw new \Exception("Будь ласка, заповніть всі обов'язкові поля.");
        //  }
        
         $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array(mime_content_type($_FILES['logo']['tmp_name']), $allowed_types)) {
            throw new \Exception("Файл повинен бути у форматі JPG або PNG.");
         }
          if ($_FILES['logo']['size'] > 5000000) {
            throw new \Exception("Розмір файлу перевищує допустимий ліміт у 5 МБ.");
          }
        
    }
    
    public function saveLogo() {
        
        if (empty($this->logo)) {
            return;
        }
        $uploads_dir = 'logo';
        if (!file_exists($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }
        if (isset($this->logo['error']) && isset($this->logo['tmp_name'])) {
            if ($this->logo['error'] == 0) {
                $tmp_name = $this->logo['tmp_name'];
                $name = $this->logo['name'];
                $logoPath = $uploads_dir . "/" . $name;
                if (move_uploaded_file($tmp_name, $logoPath)) {
                    $this->uploadedLogo = $logoPath;
                    $this->logoIsSaved = true;
      
                }
            } else {
                throw new \Exception("Помилка завантаження файлу");
            }
        } else {
            throw new \Exception("Файл не передан або відсутні необхідні ключі.");
        }
    }
    // Сохраняем данные в БД
    public function saveDb()
    {
        if($this->id === null) {
            $this->insertDb();
        } else {
            $this->updateDb();
        }
    }

    //Метод для вставки нового турнира в базу данных
     private function insertDb() { 
        $bd = Database::getInstance()->getConnection(); 
        $stmt = $bd->prepare("INSERT INTO TOURNAMENTS (logoPath, tourname, discription, start_date, end_date, prize_pool, format, gameButton) VALUES (?,?,?,?,?,?,?,?)"); 
        if ($stmt === false) { 
            throw new \Exception('Ошибка при подготовке запроса'); 
        } 
           // Раскомментировать для прохождения теста  testSaveDb
         //$this->uploadedLogoPath = $this->logo['name'];

        $stmt->bind_param('sssssssi', $this->uploadedLogo, $this->tourname, $this->discription, $this->start_date, $this->end_date, $this->prize_pool, $this->format, $this->gameButton); 
        if (!$stmt->execute()) { 
            throw new \Exception('Ошибка выполнения запроса: ' . $stmt->error); 
        } 
        $this->id = $bd->insert_id; 
        $stmt->close();
    }

    //Метод для обновления существующего турнира в базе данных
    private function updateDb() {
        $bd = Database::getInstance()->getConnection();
        $stmt = $bd->prepare("UPDATE TOURNAMENTS SET logoPath = ?, tourname = ?, discription = ?, start_date = ?, end_date = ?, prize_pool = ?, format = ?, gameButton = ? WHERE id = ?");
        if ($stmt === false) {
            throw new \Exception("Помилка підготовки запиту");
        }
        
        $stmt->bind_param("sssssssii", $this->uploadedLogo, $this->tourname, $this->discription, $this->start_date, $this->end_date, $this->prize_pool, $this->format, $this->gameButton, $this->id);
        if ($stmt->execute() === false) {
            throw new \Exception("Помилка оновлення гри в базі даних");
        }
        $stmt->close();
    }

    
    public function saveAll(){
       
        $this->saveLogo();
        $this->saveDb();
    }

    //Метод для поиска турнира по id
    public static function fetchById($id) {
        
        $bd = Database::getInstance()->getConnection();
    
        // Подготавливаем запрос
        $stmt = $bd->prepare("SELECT * FROM TOURNAMENTS WHERE id = ?");
        if ($stmt === false) {
            throw new \Exception("Помилка підготовкі запиту");
        }
    
        // Привязываем параметр
        $stmt->bind_param("i", $id);
        if (!$stmt->execute()) {
            throw new \Exception("Помилка виконання запиту");
        }
    
        // Получаем результат запроса
        $result = $stmt->get_result();
        if ($result === false) {
            throw new \Exception("Помилка отримання гри з бази даних");
        }
    
        $handler = $result->fetch_assoc();
        if ($handler === null) {
            throw new \Exception("Гра за id = {$id} не знайдена");
        }

        //Получаем имя игры
        $gameButton = GameButton::fetchById($handler['gameButton']);
        if (!empty($gameButton) && array_key_exists('name', $gameButton)) {
            $handler['gameButton_name'] = $gameButton['name'];
        } else {
            $handler['gameButton_name'] = null;
        }
        
        // Закрываем выражение
        $stmt->close();
    
        return $handler;
    
    
    }

    //Метод для получения всех игр
    // Сортировка по дате добавления
     public static function fetchAll() {
        
        $bd = Database::getInstance()->getConnection();
        $stmt = $bd->prepare("SELECT * FROM TOURNAMENTS ORDER BY created_at DESC");
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result === false) {
            throw new \Exception("Помилка отримання игры з бази даних");
        }
        $tournaments= $result->fetch_all(MYSQLI_ASSOC);
        foreach ($tournaments as &$handler) {
            $gameButton = GameButton::fetchById($handler["gameButton"]);
            $handler['gameButton_name'] = !empty($gameButton) ? $gameButton['name'] : null;
        }
        return $tournaments;
       
    }

    // Метод удаления по id
    public static function delById($id) {
        
        $handler = self::fetchById($id);
        $bd = Database::getInstance()->getConnection();
        // Проверка, существует ли запись
        $checkStmt = $bd->prepare("SELECT id FROM TOURNAMENTS WHERE id = ?");
        if ($checkStmt === false) {
            throw new \Exception("Ошибка при подготовке запроса проверки существования записи");
        }
        
        $checkStmt->bind_param('i', $id);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        
        if ($checkResult->num_rows === 0) {
            throw new \Exception("Запись с id $id не найдена");
        }
        
        // Закрываем выражение проверки
        $checkStmt->close();
        
        // Подготавливаем выражение для удаления записи
        $stmt = $bd->prepare("DELETE FROM TOURNAMENTS WHERE id = ?");
        if ($stmt === false) {
            throw new \Exception("Ошибка при подготовке запроса удаления");
        }
        
        // Привязываем параметр id
        $stmt->bind_param('i', $id);
        if ($stmt->execute() === false) {
            throw new \Exception("Ошибка выполнения запроса удаления: " . $stmt->error);
        }
        
        // Закрываем выражение
        $stmt->close();
        
        if (file_exists($handler['logoPath'])) {
            unlink($handler['logoPath']); 
        }
    }




}