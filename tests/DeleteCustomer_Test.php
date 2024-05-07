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
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("No customer found with the provided CMND.");
        $this->customer->delete("");

    }


    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithExistingFlightID
     */
    public function testDeleteCustomerWithExistingFlightID(): void
    {

        $this->customer->setUsername('testUsername');
        $this->customer->setFullName('Test User');
        $this->customer->setBirthDate('1990-01-01');
        $this->customer->setPhone('1234567890');
        $this->customer->setEmail('test@example.com');
        $this->customer->setAddress('123 Test Street');
        $this->customer->setCMND('123456789');
        $this->customer->setPassword('Test@1234');
        $this->customer->setVisaCreated('false');


        $result = $this->customer->addCustomer();
        $idname = $this->customer->getIdFromUsername('testUsername');

        $initialCount = $this->customer->countAll();
        $result = $this->customer->delete($idname);
        $finalCount = $this->customer->countAll();
        $this->assertTrue($result && $finalCount === $initialCount - 1);
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithPreviouslyBookedFlight
     * @throws Exception
     */
    public function testDeleteCustomerWithPreviouslyBookedFlight(): void
    {
        $result = $this->customer->delete('1');
        $this->assertFalse($result, "Expected to return false, but it returned true");
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithNullFlightID
     * @throws Exception
     */
    public function testDeleteCustomerWithNullFlightID(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("No customer found with the provided CMND.");

        $this->customer->delete(null);
    }

    /**
     * @covers DeleteCustomer_Test::testDeleteCustomerWithDatabaseError
     * @throws Exception
     */
    public function testDeleteCustomerWithDatabaseError(): void
    {
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Database error");
        $this->customer->delete('1000');
    }
}