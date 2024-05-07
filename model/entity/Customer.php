<?php

include_once(__DIR__ . '/../../connect/Database.php');

class Customer
{
    public $id;
    public $fullName;
    public $address;
    public $phone;
    public $CMND;
    public $visaCreated;
    public $username;
    public $password;
    public $birthDate;
    public $email;
    private $db;

    private $conn;
    private $table_name = "Customer";

    public function __construct($db)
    {
        $this->db = $db;
        $this->conn = $db;
    }

    public function __destruct()
    {

    }

    // Getter và setter cho $fullName
    public function getFullName()
    {
        return $this->fullName;
    }

    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    // Getter và setter cho $address
    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    // Getter và setter cho $phone
    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    // Getter và setter cho $CMND
    public function getCMND()
    {
        return $this->CMND;
    }

    public function setCMND($CMND)
    {
        $this->CMND = $CMND;
    }

    // Getter và setter cho $visaCreated
    public function getVisaCreated()
    {
        return $this->visaCreated;
    }

    public function setVisaCreated($visaCreated)
    {
        $this->visaCreated = $visaCreated;
    }

    // Getter và setter cho $username
    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    // Getter và setter cho $password
    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // Getter và setter cho $birthDate
    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    // Getter và setter cho $email
    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }


    public static function readAll($from_record_num, $records_per_page)
    {
        $conn = Database::Connect();
        $query = "SELECT
            Customer.id AS customer_id,
            Customer.fullName,
            Customer.address,
            Customer.phone,
            Customer.CMND,
            Customer.visaCreated,
            Customer.username,
            Customer.password,
            Customer.birth_date, -- Thay đổi từ birthDate thành birth_date
            Customer.email
        FROM
            Customer
        ORDER BY
            Customer.fullName ASC
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
        $query = "SELECT id FROM Customer";

        $stmt = $conn->prepare($query);
        $stmt->execute();

        $num = $stmt->rowCount();

        return $num;
    }

    // delete the customer and all associated bookings and invoices
    public function delete($id)
    {
        $conn = Database::Connect();

        if (empty($id)) {
            throw new InvalidArgumentException("No customer found with the provided CMND.");
        }

        // Check if the customer has a visa created
        $query = "SELECT visaCreated FROM Customer WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $visaCreated = $stmt->fetchColumn();

        if ($visaCreated == 1) {
            return false;
        }

        // Start a transaction
        $conn->beginTransaction();

        try {
            // Delete all invoices associated with the bookings of the customer
            $query = "DELETE invoice FROM invoice INNER JOIN booking ON invoice.booking_id = booking.id WHERE booking.customer_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            // Delete all bookings associated with the customer
            $query = "DELETE FROM booking WHERE customer_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            // Delete the customer
            $query = "DELETE FROM Customer WHERE id = ?";
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
                        id, fullName, address, phone,CMND,visaCreated,username,password,birth_date,email
                    FROM
                        Customer
                    WHERE
                        id = ?
                    LIMIT
                        0,1";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->id = $row['id'];
        $this->fullName = $row['fullName'];
        $this->address = $row['address'];
        $this->phone = $row['phone'];
        $this->CMND = $row['CMND'];
        $this->visaCreated = $row['visaCreated'];
        $this->username = $row['username'];
        $this->password = $row['password'];
        $this->birthDate = $row['birth_date'];
        $this->email = $row['email'];
    }

    function update()
    {
        $conn = Database::Connect();

        $query = "UPDATE
                        Customer
                    SET
                    fullName = :fullName,
                    username = :username,
                    password = :password,
                    address = :address,
                    phone = :phone,
                    birth_date = :birth_date,
                    email = :email,
                    CMND  = :CMND,
                    visaCreated = :visaCreated
                    WHERE
                        id = :id";

        $stmt = $conn->prepare($query);

        // posted values
        $this->fullName = htmlspecialchars(strip_tags($this->fullName));
        $this->address = htmlspecialchars(strip_tags($this->address));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->birthDate = htmlspecialchars(strip_tags($this->birthDate));
        $this->username = htmlspecialchars(strip_tags($this->username));
        $this->password = htmlspecialchars(strip_tags($this->password));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->CMND = htmlspecialchars(strip_tags($this->CMND));
        $this->visaCreated = htmlspecialchars(strip_tags($this->visaCreated));


        // bind parameters
        $stmt->bindParam(':fullName', $this->fullName);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':birth_date', $this->birthDate);
        $stmt->bindParam(':username', $this->username);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':CMND', $this->CMND);
        $visaCreatedValue = $this->visaCreated ? 1 : 0;
        $stmt->bindParam(':visaCreated', $visaCreatedValue, PDO::PARAM_INT);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function create()
    {
        $conn = Database::Connect();
        $query = "INSERT INTO
                        Customer
                    SET
                    fullName = :fullName,
                    address = :address,
                    phone = :phone,
                    birth_date = :birth_date,
                    email = :email,
                    CMND  = :CMND,
                    username = :username,
                    visaCreated = :visaCreated
                    ";

        $stmt = $conn->prepare($query);

        // bind parameters
        $stmt->bindParam(':fullName', $this->fullName);
        $stmt->bindParam(':address', $this->address);
        $stmt->bindParam(':phone', $this->phone);
        $stmt->bindParam(':birth_date', $this->birthDate);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':CMND', $this->CMND);
        $stmt->bindParam(':username', $this->username);
        $visaCreatedValue = $this->visaCreated ? 1 : 0;
        $stmt->bindParam(':visaCreated', $visaCreatedValue, PDO::PARAM_INT);

        // execute the query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function searchCustomer($search_term)
    {
        $conn = Database::Connect();

        if (is_null($search_term) || empty($search_term) || !preg_match('/^[0-9]+$/', $search_term)) {
            return [];
        }

        $query = "SELECT id, fullName, birth_date, email, phone, visaCreated FROM Customer WHERE CMND like ?";

        $stmt = $conn->prepare($query);
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->execute();
        $result = $stmt->fetchAll();
        if (empty($result)) {
            return [];
        }
        return $result;
    }

    public function search($search_term, $from_record_num, $records_per_page)
    {
        $conn = Database::Connect();
        // select query
        $query = "SELECT
                        id, fullName, birth_date, email, phone, visaCreated
                    FROM
                        Customer
                    WHERE
                        CMND like ?
                    ORDER BY
                        fullName ASC
                    LIMIT
                        ?, ?";

        // prepare query statement
        $stmt = $conn->prepare($query);

        // bind variable values
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);
        $stmt->bindParam(2, $from_record_num, PDO::PARAM_INT);
        $stmt->bindParam(3, $records_per_page, PDO::PARAM_INT);

        // execute query
        $stmt->execute();

        // return values from database
        return $stmt;
    }

    public function countAll_BySearch($search_term)
    {
        $conn = Database::Connect();
        // select query
        $query = "SELECT
                        COUNT(*) as total_rows
                    FROM
                        Customer
                    WHERE
                        CMND LIKE ?";

        // chuẩn bị câu truy vấn
        $stmt = $conn->prepare($query);

        // gắn giá trị biến
        $search_term = "%{$search_term}%";
        $stmt->bindParam(1, $search_term);

        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row['total_rows'];
    }

    public function sort($column)
    {
        $conn = Database::Connect();
        // Sử dụng PDO để thực hiện truy vấn sắp xếp
        $query = "SELECT * FROM Customer ORDER BY $column";
        $stmt = $conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public static function getCustomerById($customer_id)
    {
        $conn = Database::Connect();
        $query = "SELECT
                        id,
                        fullName,
                        address,
                        phone,
                        CMND,
                        visaCreated,
                        birth_date,
                        email
                    FROM
                        Customer
                    WHERE
                        id = ?
                    LIMIT
                        0,1";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $customer_id, PDO::PARAM_INT); // Truyền giá trị id của khách hàng vào truy vấn
        $stmt->execute();

        return $stmt;
    }

    #region Chiến
    function readOne2()
    {
        $conn = Database::Connect();
        $query = "SELECT id, fullName, address, phone,CMND,visaCreated,username,password,birth_date,email FROM Customer WHERE username = ? LIMIT 0,1";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row === false) {
            // Handle the case where no rows were returned
            // For example, throw an exception:
            throw new Exception('No customer found with the provided username');
        }

        $this->id = $row['id'];
        $this->fullName = $row['fullName'];
        $this->address = $row['address'];
        $this->phone = $row['phone'];
        $this->CMND = $row['CMND'];
        $this->visaCreated = $row['visaCreated'];
        $this->username = $row['username'];
        $this->birthDate = $row['birth_date'];
        $this->email = $row['email'];
    }


    public function addCustomer()
    {
        // Check if all properties are set and not null
        if (empty($this->username) || empty($this->password) || empty($this->fullName) || empty($this->email) || empty($this->phone) || empty($this->CMND) || empty($this->address) || empty($this->visaCreated) || empty($this->birthDate)) {
            throw new InvalidArgumentException("Vui lòng nhập đầy đủ thông tin");
        }

        // Check if username, phone, email, or CMND already exists
        if ($this->checkUsernameExistence() || $this->checkPhoneExistence() || $this->checkEmailExistence() || $this->checkCMNDExistence()) {
            throw new Exception("Thông tin người dùng đã tồn tại");
        }

        // Check if data is valid
        if (!$this->isValidFullName() || !$this->isValidPhone() || !$this->isValidID() || !$this->isValidPassword()) {
            throw new Exception("Dữ liệu không hợp lệ");
        }

        // Check if data is too long
        if (strlen($this->username) > 255 || strlen($this->password) > 255 || strlen($this->fullName) > 255 || strlen($this->email) > 255 || strlen($this->phone) > 15 || strlen($this->CMND) > 15 || strlen($this->address) > 255) {
            throw new Exception("Thông tin quá dài");
        }

        $sql = "INSERT INTO Customer (username, password, fullName, email, phone, CMND, address, visaCreated, birth_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($sql);
        $result = $stmt->execute([
            $this->username,
            $this->password,
            $this->fullName,
            $this->email,
            $this->phone,
            $this->CMND,
            $this->address,
            $this->visaCreated,
            $this->birthDate
        ]);

        return $result;
    }

    public function checkLogin()
    {
        $sql = "SELECT * FROM Customer WHERE username = ? AND password = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->username, $this->password]);
        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }


    public function getIdFromUsername()
    {
        $sql = "SELECT id FROM Customer WHERE username = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$this->username]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;
    }

    public function isValidInput($input, $type)
    {
        // Check if input contains any special characters
        if ($type == 'fullName') {
            return preg_match('/^[\p{L}\s]+$/u', $input);
        } elseif ($type == 'username') {
            return preg_match('/^[a-zA-Z]+$/', $input);
        }
    }

    public function isValidFullName()
    {
        // Check if full name contains any numbers or special characters
        return preg_match('/^[\p{L}\p{M}*\s\p{P}]+$/u', $this->fullName);
    }


    public function countAllCustomers()
    {
        $conn = Database::Connect();
        $query = "SELECT COUNT(*) as total FROM Customer";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // check trùng dữ liệu
    public function checkUsernameExistence()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE username = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->username);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function checkPhoneExistence()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE phone = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->phone);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function isValidPhone()
    {
        // Check if phone number only contains numbers
        return preg_match('/^[0-9]+$/', $this->phone);
    }

    public function isValidID()
    {
        // Check if ID only contains numbers
        return preg_match('/^[0-9]+$/', $this->CMND);
    }

    public function isValidPassword()
    {
        // Check if password is at least 8 characters long, contains at least one uppercase letter and one special character
        return preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*]).{8,}$/', $this->password);
    }

    public function checkEmailExistence()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->email);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }

    public function checkCMNDExistence()
    {
        $query = "SELECT * FROM " . $this->table_name . " WHERE CMND = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->CMND);
        $stmt->execute();
        return $stmt->rowCount() > 0;
    }


#endregion
}

?>