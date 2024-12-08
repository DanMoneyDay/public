<?php  
    namespace Maincast\App\Classes;


    class Game{
        
        protected $id;
        protected $logo;
        

        protected $tourname;
        protected $discription;
        protected $start_date;
        protected $end_date;
        protected $prize_pool;
        protected $format;
        protected $gameButton;

        protected $uploadedLogo;
        protected $logoIsSaved = false;





        public function __construct($logo, $tourname, $discription, $start_date, $end_date, $prize_pool, $format, $gameButton, $id = null){
            
            $this->logo = $logo;
            $this->tourname = $tourname;
            $this->discription = $discription;
            $this->start_date = $start_date;
            $this->end_date = $end_date;
            $this->prize_pool = $prize_pool;
            $this->format = $format;
            $this->gameButton = $gameButton;

            $this->id = $id;

        }

        public function getId()
        {
            return $this->id;
        }
        public function getLogoName()
        {
            return $this->logo['name'];
        }
        public function getTourname()
        {
            return $this->tourname;
        }
        public function getDiscription()
        {
            return $this->discription;
        }
        public function getStartdate()
        {
            return $this->start_date;
        }
        public function getEnddate()
        {
            return $this->end_date;
        }
        public function getPrize_pool()
        {
            return $this->prize_pool;
        }
        public function getFormat()
        {
            return $this->format;
        }
        public function getGame()
        {
            return $this->gameButton;
        }
    }

?>