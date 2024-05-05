<?php

class Invoice
{
    public $id;
    public $bookingId;
    public $totalAmount;
    public $departureTime;
    public $arrivalTime;
    public $paymentStatus;
    private $db;

    public function __construct($db, $id = null, $bookingId = null, $totalAmount = null, $departureTime = null, $arrivalTime = null, $paymentStatus = null)
    {
        $this->db = $db;
        $this->id = $id;
        $this->bookingId = $bookingId;
        $this->totalAmount = $totalAmount;
        $this->departureTime = $departureTime;
        $this->arrivalTime = $arrivalTime;
        $this->paymentStatus = $paymentStatus;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getBookingId()
    {
        return $this->bookingId;
    }

    public function setBookingId($bookingId)
    {
        $this->bookingId = $bookingId;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
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

    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }
    public function calculateTotalRevenue() {
        $conn = Database::Connect();
        $query = "SELECT SUM(totalAmount) as totalRevenue FROM Invoice";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['totalRevenue'];
    }


}

?>