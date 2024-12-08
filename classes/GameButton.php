<?php 
    namespace Maincast\App\Classes;



    class GameButton
    {
        public static function fetchAll()
        {
            $bd = Database::getInstance();
            $stmt = $bd->getConnection()->prepare("SELECT * FROM gameButtons");
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public static function fetchById($id)
        {
            $bd = Database::getInstance();
            $stmt = $bd->getConnection()->prepare("SELECT * FROM gameButtons WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }


    }
?>