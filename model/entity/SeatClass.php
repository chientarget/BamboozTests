<?php
    class SeatClass {
        public $id;
        public $seatClass;
        public $amount;

        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function __destruct() {

        }

        public function getId() {
            return $this->id;
        }
    
        public function setId($id) {
            $this->id = $id;
        }
    
        public function getSeatClazz() {
            return $this->seatClass;
        }
    
        public function setSeatClazz($seatClass) {
            $this->seatClass = $seatClass;
        }
    
        public function getAmount() {
            return $this->amount;
        }
    
        public function setAmount($amount) {
            $this->amount = $amount;
        }

        public static function readAll($from_record_num, $records_per_page){
            $conn= Database::Connect();
            $query = "SELECT
                s.id,
                s.seat_clazz,
                s.amount
            FROM
                SeatClass s";
                $stmt = $conn->prepare($query);
                $stmt->execute();
                return $stmt;
        }

        public static function getSeatClassById($seat_class_id) {
            $conn = Database::Connect();
            $query = "SELECT
                        id,
                        seat_clazz,
                        amount
                    FROM
                        SeatClass
                    WHERE
                        id = ?
                    LIMIT
                        0,1";
            
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $seat_class_id, PDO::PARAM_INT); // Truyền giá trị id của SeatClass vào truy vấn
            $stmt->execute();

            return $stmt;
        }

        public static function getAllSeatClasses() {
            $conn = Database::Connect();
            $query = "SELECT id, seat_clazz, amount FROM SeatClass";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }
    }
?>