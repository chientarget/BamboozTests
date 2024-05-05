<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../connect/Database.php');
require_once(__DIR__ . '/../model/entity/Customer.php');

class DeleteCustomer_Test extends TestCase
{
    private Customer $customer;

    /**
     * @codeCoverageIgnore
     */
    protected function setUp(): void
    {
        $db = Database::Connect();
        $this->customer = new Customer($db);
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithEmptyFlightID
     */
    public function testDeleteCustomerWithEmptyFlightID(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->customer->deleteCustomer("");
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithExistingFlightID
     */
    public function testDeleteCustomerWithExistingFlightID(): void
    {
        $result = $this->customer->deleteCustomer("existingFlightID");

        $this->assertTrue($result);
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithPreviouslyBookedFlight
     */
    public function testDeleteCustomerWithPreviouslyBookedFlight(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Không thể xóa chuyến bay");

        $this->customer->deleteCustomer("previouslyBookedFlightID");
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithNullFlightID
     */
    public function testDeleteCustomerWithNullFlightID(): void
    {
        $this->expectException(InvalidArgumentException::class);

        $this->customer->deleteCustomer(null);
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithDatabaseError
     */
    public function testDeleteCustomerWithDatabaseError(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Không thể xóa chuyến bay");

        $this->customer->deleteCustomer("flightIDWithDBError");
    }
}