<?php
include_once __DIR__ . '/../../connect/Database.php';

class Booking
{
    public $id;
    public $customerId;
    public $flightId;
    public $bookingDate;
    public $seatNumber;
    public $roundTrip;
    public $seatClassId;
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
                Booking.id, 
                Booking.flight_id, 
                Booking.customer_id,
                Flight.departureTime as flightDepartureTime, 
                Customer.fullName as customerFullName, 
                SeatClass.seat_clazz as seatClass
                    FROM Booking
                    INNER JOIN Flight ON Booking.flight_id = Flight.id
                    INNER JOIN Customer ON Booking.customer_id = Customer.id
                    INNER JOIN SeatClass ON Booking.seatClassId = SeatClass.id
            LIMIT
                {$from_record_num},{$records_per_page}";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function countAll()
    {
        $conn = Database::Connect();
        $query = "SELECT id FROM Booking";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }


    function delete($id)
    {
        $conn = Database::Connect();

        // Start transaction
        $conn->beginTransaction();

        try {
            // Delete invoices that reference the booking
            $query = "DELETE FROM Invoice WHERE booking_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            // Delete the booking
            $query = "DELETE FROM Booking WHERE id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);

            if ($stmt->execute()) {
                // Commit transaction
                $conn->commit();
                return true;
            } else {
                throw new Exception("Error deleting booking: " . implode(" ", $stmt->errorInfo()));
            }
        } catch (Exception $e) {
            // Roll back the transaction if something failed
            $conn->rollback();
            echo $e->getMessage();
            return false;
        }
    }


    public function searchByName($search_name) {
        $conn = Database::Connect();

        // select query
        $query = "SELECT Booking.id AS bookingId,
                    Booking.flight_id AS flightId,
                    Booking.customer_id AS customerId,
                    Flight.departureTime AS flightDepartureTime,
                    Customer.fullName AS customerFullName,
                    SeatClass.seat_clazz AS seatClass
                FROM
                    Booking
                INNER JOIN
                    Flight ON Booking.flight_id = Flight.id
                INNER JOIN
                    Customer ON Booking.customer_id = Customer.id
                INNER JOIN
                    SeatClass ON Booking.seatClassId = SeatClass.id
                WHERE
                    Customer.fullName LIKE :search_name
                ORDER BY
                    Booking.id ASC";

        // prepare query statement
        $stmt = $conn->prepare($query);

        // bind variable values
        $search_name = "%$search_name%";
        $stmt->bindParam(':search_name', $search_name, PDO::PARAM_STR);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }

    public function countAll_BySearchName($search_name) {
        $conn = Database::Connect();

        // select query
        $query = "SELECT
                    COUNT(*) as total_rows
                FROM
                    Booking
                INNER JOIN
                    Customer ON Booking.customer_id = Customer.id
                WHERE
                    Customer.fullName LIKE :search_name";
    
        // prepare query statement
        $stmt = $conn->prepare($query);
    
        // bind variable values
        $search_name = "%$search_name%";
        $stmt->bindParam(':search_name', $search_name, PDO::PARAM_STR);
    
        // execute query
        $stmt->execute();
    
        // get row count
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // return count
        return $row['total_rows'];
    }

    

    public function countAll_BySearch($search_id)
    {
        $conn = Database::Connect();

        // select query
        $query = "SELECT
                        COUNT(*) as total_rows
                    FROM
                        Booking
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


    public function readOne()
    {
        $conn = Database::Connect();
        $query = "SELECT
                        b.id,
                        b.customer_id,
                        b.flight_id,
                        b.bookingDate as bookingDate,
                        b.seatNumber as seatNumber,
                        b.roundTrip,
                        b.seatClassId,
                        f.departureTime,
                        f.arrivalTime,
                        da.city AS departureCity,
                        da.country AS departureCountry,
                        da.airfield AS departureAirfield,
                        aa.city AS arrivalCity,
                        aa.country AS arrivalCountry,
                        aa.airfield AS arrivalAirfield,
                        s.seat_clazz ASseatClass
                    FROM
                        Booking b
                    JOIN
                        Flight f ON b.flight_id = f.id
                    JOIN
                        Address da ON f.departureAddressID = da.id
                    JOIN
                            
                        Address aa ON f.arrivalAddressId = aa.id
                    JOIN
                        SeatClass s ON b.seatClassId = s.id
                    WHERE
                        b.id = ?
                    LIMIT
                        0,1";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->customerId = $row['customer_id'];
        $this->flightId = $row['flight_id'];
        $this->bookingDate = $row['bookingDate'];
        $this->seatNumber = $row['seatNumber'];
        $this->roundTrip = $row['roundTrip'];
        $this->seatClassId = $row['seatClassId'];
    }


    function update()
    {
        $conn = Database::Connect();

        // Kiểm tra` xem id khách hàng mới tồn tại trong cơ sở dữ liệu hay không
        $customerQuery = "SELECT id FROM Customer WHERE id = :customerId";
        $customerStmt = $conn->prepare($customerQuery);
        $customerStmt->bindParam(':customerId', $this->customerId);
        $customerStmt->execute();
        $customerExists = $customerStmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra xem id chuyến bay mới tồn tại trong cơ sở dữ liệu hay không
        $flightQuery = "SELECT id FROM Flight WHERE id = :flightId";
        $flightStmt = $conn->prepare($flightQuery);
        $flightStmt->bindParam(':flightId', $this->flightId);
        $flightStmt->execute();
        $flightExists = $flightStmt->fetch(PDO::FETCH_ASSOC);

        // Nếu không tìm thấy id khách hàng hoặc id chuyến bay mới trong cơ sở dữ liệu, hiển thị thông báo lỗi
        if (!$customerExists) {
            echo "<script>alert('Không tìm thấy id khách hàng mới trong cơ sở dữ liệu.');</script>";
            return false;
        }

        if (!$flightExists) {
            echo "<script>alert('Không tìm thấy id chuyến bay mới trong cơ sở dữ liệu.');</script>";
            return false;
        }
        // Query cập nhật thông tin của chuyến bay
        $query = "UPDATE
                        Booking
                    SET
                        customer_id = :customerId,
                        flight_id = :flightId,             
                        seatClassId = :seatClassId,
                        bookingDate = :bookingDate,
                        seatNumber = :seatNumber,
                        roundTrip = :roundTrip
                    WHERE
                        id = :id";
        $stmt = $conn->prepare($query);

        // Bind các tham số
        $stmt->bindParam(':customerId', $this->customerId);
        $stmt->bindParam(':flightId', $this->flightId);
        $stmt->bindParam(':seatClassId', $this->seatClassId);
        $stmt->bindParam(':bookingDate', $this->bookingDate);
        $stmt->bindParam(':seatNumber', $this->seatNumber);
        $stmt->bindParam(':roundTrip', $this->roundTrip);
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
        // Câu truy vấn SQL để chèn một bản ghi mới vào bảng Booking
        $query = "INSERT INTO Booking 
                        (customer_id, flight_id, bookingDate, seatNumber, roundTrip, seatClassId) 
                      VALUES 
                        (:customerId, :flightId, :bookingDate, :seatNumber, :roundTrip, :seatClassId)";

        // Chuẩn bị câu truy vấn
        $stmt = $conn->prepare($query);

        // Gán các tham số từ đối tượng Booking cho các tham số của câu truy vấn
        $stmt->bindParam(':customerId', $this->customerId);
        $stmt->bindParam(':flightId', $this->flightId);
        $stmt->bindParam(':bookingDate', $this->bookingDate);
        $stmt->bindParam(':seatNumber', $this->seatNumber);
        $stmt->bindParam(':roundTrip', $this->roundTrip);
        $stmt->bindParam(':seatClassId', $this->seatClassId);

        // Thực thi câu truy vấn
        if ($stmt->execute()) {
            return true; // Trả về true nếu thêm thành công
        } else {
            return false;
        }
    }

    public function countAllBookings()
    {
        $conn = Database::Connect();
        $query = "SELECT COUNT(*) as total FROM Booking";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }
}

?>