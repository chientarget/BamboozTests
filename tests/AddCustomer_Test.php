<?php

require 'vendor/autoload.php';

use PHPUnit\Framework\TestCase;

require_once(__DIR__ . '/../connect/Database.php');
require_once(__DIR__ . '/../model/entity/Customer.php');

class AddCustomer_Test extends TestCase
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
     * @codeCoverageIgnore
     * @throws Exception
     */
    protected function tearDown(): void
    {
        $id = $this->customer->getIdFromUsername();
        if ($id !== null) {
            $this->customer->delete($id);
        }
    }

    /**
     * @covers AddCustomer_Test::testAddCustomerSuccess
     * @throws Exception
     */
    public function testAddCustomerSuccess(): void
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

        $this->assertTrue($result, "Expected addCustomer to return true, but it returned false");
    }

    /**
     * @covers AddCustomer_Test::testAddCustomerWithNullData
     * @throws Exception
     */
    public function testAddCustomerWithNullData(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Vui lòng nhập đầy đủ thông tin");

        $this->customer->addCustomer();
    }

    /**
     * @covers AddCustomer_Test::testAddCustomerWithExistingData
     */
    public function testAddCustomerWithExistingData(): void
    {
        $this->customer->setUsername('user1');
        $this->customer->setFullName('Nguyễn Văn A');
        $this->customer->setBirthDate('1990-01-01');
        $this->customer->setPhone('0912345678');
        $this->customer->setEmail('user1@email.com');
        $this->customer->setAddress('123 Đường ABC, Hà Nội');
        $this->customer->setCMND('123456789012');
        $this->customer->setPassword('password1');
        $this->customer->setVisaCreated(true);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Thông tin người dùng đã tồn tại");

        $this->customer->addCustomer();
    }

    /**
     * @covers AddCustomer_Test::testAddCustomerWithInvalidData
     */
    public function testAddCustomerWithInvalidData(): void
    {
        $this->customer->setUsername('invalidUsername@2');
        $this->customer->setFullName('Invalid Name 123');
        $this->customer->setBirthDate('1990-13-01');
        $this->customer->setPhone('1234567890abc');
        $this->customer->setEmail('invalidEmail2');
        $this->customer->setAddress('123 Test Street');
        $this->customer->setCMND('123456789016');
        $this->customer->setPassword('test');
        $this->customer->setVisaCreated('false');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Dữ liệu không hợp lệ");

        $this->customer->addCustomer();
    }

    /**
     * @covers AddCustomer_Test::testAddCustomerWithLongData
     */
    public function testAddCustomerWithLongData(): void
    {
        $longData = str_repeat('a', 256);
        $uniquePart = time(); // Get the current timestamp

        $this->customer->setUsername('unique' . $uniquePart . $longData);
        $this->customer->setFullName('Test User');
        $this->customer->setBirthDate('1990-01-01');
        $this->customer->setPhone('0123456789123456789');
        $this->customer->setEmail('unique' . $uniquePart . $longData . '@example.com');
        $this->customer->setAddress($longData);
        $this->customer->setCMND('1234567890' . $uniquePart);
        $this->customer->setPassword('Test@12345');
        $this->customer->setVisaCreated('false');

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Thông tin quá dài");

        $this->customer->addCustomer();
    }

}