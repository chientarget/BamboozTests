<?php
require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../connect/Database.php');
require_once(__DIR__ . '/../model/entity/Customer.php');

class SearchCustomer_Test extends TestCase
{
    private Customer $customer;

    protected function setUp(): void
    {
        $db = Database::Connect();
        $this->customer = new Customer($db);
    }

    public function testSearchCustomerWithValidCMND(): void
    {
        $this->customer->setCMND('123456789');
        $result = $this->customer->searchCustomer($this->customer->getCMND());

        $this->assertNotEmpty($result, "Expected to return customer, but it returned an empty list");
    }

    public function testSearchCustomerWithInvalidCMND(): void
    {
        $this->customer->setCMND('abc123');
        $result = $this->customer->searchCustomer($this->customer->getCMND());

        $this->assertEmpty($result, "Expected to return an empty list, but it returned a customer");
    }

    public function testSearchCustomerWithNonExistentCMND(): void
    {
        $this->customer->setCMND('999999999');
        $result = $this->customer->searchCustomer($this->customer->getCMND());

        $this->assertEmpty($result, "Expected to return an empty list, but it returned a customer");
    }

    public function testSearchCustomerWithNullCMND(): void
    {
        $this->customer->setCMND(null);
        $result = $this->customer->searchCustomer($this->customer->getCMND());

        $this->assertEmpty($result, "Expected to return an empty list, but it returned a customer");
    }
}