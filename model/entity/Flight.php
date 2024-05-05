<?php

include_once __DIR__ . '/../../connect/Database.php';

class Flight
{
    public $id;
    public $arrivalAddressId;
    public $departureAddressId;
    public $flightTime;
    public $departureTime;
    public $arrivalTime;
    public $availableSeats;
    public $totalSeats;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __destruct()
    {

    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getArrivalAddressId()
    {
        return $this->arrivalAddressId;
    }

    public function setArrivalAddressId($arrivalAddressId)
    {
        $this->arrivalAddressId = $arrivalAddressId;
    }

    public function getFlightTime()
    {
        return $this->flightTime;
    }

    public function setFlightTime($flightTime)
    {
        $this->flightTime = $flightTime;
    }

    public function getDepartureTime()
    {
        return $this->departureTime;
    }

    public function setDepartureTime($departureTime)
    {
        $this->departureTime = $departureTime;
    }

    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;
    }

    public function getAvailableSeats()
    {
        return $this->availableSeats;
    }

    public function setAvailableSeats($availableSeats)
    {
        $this->availableSeats = $availableSeats;
    }

    public function getTotalSeats()
    {
        return $this->totalSeats;
    }

    public function setTotalSeats($totalSeats)
    {
        $this->totalSeats = $totalSeats;
    }


    public static function readAll($from_record_num, $records_per_page)
    {
        $conn = Database::Connect();
        $query = "SELECT
            f.id AS flight_id,
            f.flightTime,
            f.departureTime,
            f.arrivalAddressId,
            f.departureAddressId,
            f.arrivalTime,
            f.availableSeats,
            f.totalSeats,
            da.id AS departure_address_id,
            da.city AS departure_city,
            da.country AS departure_country,
            da.airfield AS departure_airfield,
            aa.id AS arrival_address_id,
            aa.city AS arrival_city,
            aa.country AS arrival_country,
            aa.airfield AS arrival_airfield
        FROM
            Flight f
        JOIN
            Address da ON f.departureAddressID = da.id
        JOIN
            Address aa ON f.arrivalAddressID = aa.id
        LIMIT
            {$from_record_num}, {$records_per_page}";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }


    // used for paging products
    public function countAll()
    {
        $conn = Database::Connect();
        $query = "SELECT id FROM Flight";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    // delete the product
    public function delete($id){
        $conn= Database::Connect();
    
        // Start a transaction
        $conn->beginTransaction();
    
        try {
            // Set the visaCreated attribute of all customers associated with the flight to false
            $query = "UPDATE Customer SET visaCreated = 0 WHERE id IN (SELECT customer_id FROM booking WHERE flight_id = ?)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
    
            $query = "DELETE FROM invoice WHERE booking_id IN (SELECT id FROM booking WHERE flight_id = :flight_id)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':flight_id', $id);
            $stmt->execute();
            // Delete all bookings associated with the flight
            $query = "DELETE FROM booking WHERE flight_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
    
            // Delete the flight
            $query = "DELETE FROM Flight WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
    
            // Commit the transaction
            $conn->commit();
    
            return true;
        } catch (Exception $e) {
            // An error occurred, rollback the transaction
            $conn->rollback();
    
            // Return the error message
            return $e->getMessage();
        }
    }

    function readOne()
    {

        $conn = Database::Connect();
        $query = "SELECT
                f.id,
                f.arrivalAddressId,
                f.departureAddressID as departureAddressId,
                f.flightTime,
                f.departureTime,
                f.arrivalTime,
                f.availableSeats,
                f.totalSeats,
                da.city AS departureCity,
                da.country AS departureCountry,
                da.airfield AS departureAirfield,
                aa.city AS arrivalCity,
                aa.country AS arrivalCountry,
                aa.airfield AS arrivalAirfield
            FROM
                Flight f
            JOIN
                Address da ON f.departureAddressID = da.id
            JOIN
                Address aa ON f.arrivalAddressId = aa.id
            WHERE
                f.id = ?
            LIMIT
                0,1";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->arrivalAddressId = $row['arrivalAddressId'];
        $this->departureAddressId = $row['departureAddressId'];
        $this->flightTime = $row['flightTime'];
        $this->departureTime = $row['departureTime'];
        $this->arrivalTime = $row['arrivalTime'];
        $this->availableSeats = $row['availableSeats'];
        $this->totalSeats = $row['totalSeats'];
    }

    function update()
    {
        $conn = Database::Connect();

        // Query cập nhật thông tin của chuyến bay
        $query = "UPDATE
                    Flight
                SET
                    arrivalAddressId = :arrivalAddressId,
                    departureAddressID = :departureAddressId,             
                    flightTime = :flightTime,
                    departureTime = :departureTime,
                    arrivalTime = :arrivalTime,
                    availableSeats = :availableSeats,
                    totalSeats = :totalSeats
                WHERE
                    id = :id";

        $stmt = $conn->prepare($query);

        // Bind các tham số
        $stmt->bindParam(':arrivalAddressId', $this->arrivalAddressId);
        $stmt->bindParam(':departureAddressId', $this->departureAddressId);
        $stmt->bindParam(':flightTime', $this->flightTime);
        $stmt->bindParam(':departureTime', $this->departureTime);
        $stmt->bindParam(':arrivalTime', $this->arrivalTime);
        $stmt->bindParam(':availableSeats', $this->availableSeats);
        $stmt->bindParam(':totalSeats', $this->totalSeats);
        $stmt->bindParam(':id', $this->id);

        // Thực thi truy vấn
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function create()
    {
        $conn = Database::Connect();
        $query = "INSERT INTO Flight 
                    SET id = :id,
                        flightTime = :flightTime, 
                        departureTime = :departureTime, 
                        arrivalTime = :arrivalTime, 
                        departureAddressID = :departureAddressId, 
                        arrivalAddressId = :arrivalAddressId, 
                        totalSeats = :totalSeats, 
                        availableSeats = :availableSeats";
    
        $stmt = $conn->prepare($query);
    
        // Generate a unique ID for the new flight
        $this->id = uniqid();
    
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':flightTime', $this->flightTime);
        $stmt->bindParam(':departureTime', $this->departureTime);
        $stmt->bindParam(':arrivalTime', $this->arrivalTime);
        $stmt->bindParam(':departureAddressId', $this->departureAddressId);
        $stmt->bindParam(':arrivalAddressId', $this->arrivalAddressId);
        $stmt->bindParam(':totalSeats', $this->totalSeats);
        $stmt->bindParam(':availableSeats', $this->availableSeats);
    
        if ($stmt->execute()) {
            return true;
        }
    }

    public function addFlight()
    {

        $conn = Database::Connect();
        $query = "INSERT INTO Flight (flightTime, departureTime, arrivalTime, departureAddressID, arrivalAddressId, totalSeats, availableSeats) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $result = $stmt->execute([
            $this->flightTime,
            $this->departureTime,
            $this->arrivalTime,
            $this->departureAddressId,
            $this->arrivalAddressId,
            $this->totalSeats,
            $this->availableSeats
        ]);
        return $result;
    }


    public function searchById($search_id)
    {
        $conn = Database::Connect();

        // select query
        $query = "SELECT
                Flight.id AS flightId,
                Flight.flightTime,
                Flight.departureTime,
                Flight.arrivalTime,
                ArrivalAddress.city AS arrivalCity,
                DepartureAddress.city AS departureCity
            FROM
                Flight
            INNER JOIN
                Address AS ArrivalAddress ON Flight.arrivalAddressId = ArrivalAddress.id
            INNER JOIN
                Address AS DepartureAddress ON Flight.departureAddressID = DepartureAddress.id
            WHERE
                Flight.id = :search_id
            ORDER BY
                Flight.id ASC";

        // prepare query statement
        $stmt = $conn->prepare($query);

        // bind variable values
        $stmt->bindParam(':search_id', $search_id, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }


    public function countAll_BySearch($search_id)
    {
        $conn = Database::Connect();

        // select query
        $query = "SELECT
                COUNT(*) as total_rows
            FROM
                Flight
            WHERE
                id = :search_id";

        // prepare query statement
        $stmt = $conn->prepare($query);

        // bind variable values
        $stmt->bindParam(':search_id', $search_id);

        // execute query
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    public static function getFlightById($conn, $flightId)
    {
        $query = "SELECT * FROM Flight WHERE id = :flightId LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':flightId', $flightId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }

    public static function getAddressById($conn, $addressId)
    {
        $query = "SELECT id, city FROM Address WHERE id = :addressId";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':addressId', $addressId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt;
    }
    public function countAllFlights() {
        $conn = Database::Connect();
        $query = "SELECT COUNT(*) as total FROM Flight";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

}

?>