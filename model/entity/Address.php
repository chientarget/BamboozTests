<?php
include_once __DIR__ . '/../../connect/Database.php';

class Address
{
    public $id;
    public $city;
    public $country;
    public $airfield;
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function __destruct()
    {

    }


    public static function readAll($from_record_num, $records_per_page)
    {
        $conn = Database::Connect();
        $query = "SELECT
                a.id,
                a.city,
                a.country,
                a.airfield
            FROM
                Address a
            LIMIT
                {$from_record_num}, {$records_per_page}";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public static function getAddressById($flight_id)
    {
        $conn = Database::Connect();
        $query = "SELECT
                a.id,
                a.city,
                a.country,
                a.airfield
            FROM
                Address a
            WHERE a.id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $flight_id); // Truyền giá trị id của chuyến bay vào truy vấn
        $stmt->execute();

        return $stmt;
    }

    public function countAll()
    {
        $conn = Database::Connect();
        $query = "SELECT id FROM Address";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    function create()
    {
        $conn = Database::Connect();
        $query = "INSERT INTO
                        Address
                    SET
                    city = :city,
                    country = :country,
                    airfield = :airfield
                    ";

        $stmt = $conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':airfield', $this->airfield);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function update()
    {
        $conn = Database::Connect();

        // SQL update query
        $query = "UPDATE Address
                      SET city = :city,
                          country = :country,
                          airfield = :airfield
                      WHERE id = :id";

        // prepare query statement
        $stmt = $conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':city', $this->city);
        $stmt->bindParam(':country', $this->country);
        $stmt->bindParam(':airfield', $this->airfield);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function searchById($search_id)
    {
        $conn = Database::Connect();

        // select query
        $query = "SELECT
            id,
            airfield,
            city,
            country
        FROM
            Address
        WHERE
            id = :search_id";

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
                        Address
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
    public function countAllAddresses() {
        $conn = Database::Connect();
        $query = "SELECT COUNT(*) as total FROM Address";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

}

?>