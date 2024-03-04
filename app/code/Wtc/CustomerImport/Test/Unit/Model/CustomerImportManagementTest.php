<?php
/**
 * Copyright © @2024 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace WTC\CustomerImport\Test\Unit\Model;

use Wtc\CustomerImport\Model\CustomerImportManagement;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Wtc\CustomerImport\Api\CustomerImportManagementInterface;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit\Framework\MockObject\MockObject;
use Wtc\CustomerImport\Model\Import\Profiles\ProfileCsv;
use Wtc\CustomerImport\Model\Import\Profiles\ProfileJson;

class CustomerImportManagementTest extends \PHPUnit\Framework\TestCase
{
     
     /**
      * @var CustomerImportManagement
      */
    protected $model;

    /**
     * @var CustomerRepositoryInterface |MockObject
     *
     * */
    protected $customerRepository ;

    /**
     * @var CustomerInterfaceFactory |MockObject
     *
     */
    protected $customerFactory;

    /**
     * @var string[]
     */
    protected $profiles;
   
    public function setUp() : void
    {
        //setup
        $this->customerFactory = $this->getMockBuilder(CustomerInterfaceFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();
        $this->customerRepository = $this->getMockForAbstractClass(CustomerRepositoryInterface::class);
        
        $this->profiles=[
            "sample-csv"=>$this->getMockBuilder(ProfileCsv::class)
            ->disableOriginalConstructor()
            ->getMock(),
            "sample-json"=>$this->getMockBuilder(ProfileJson::class)
           ->disableOriginalConstructor()
            ->getMock()
        ];

        $this->model = (new ObjectManager($this))->getObject(
            CustomerImportManagement::class,
            [
                'customerRepository' => $this->customerRepository,
                'customerFactory' => $this->customerFactory,
                'profiles' => $this->profiles,
            ]
        );
    }

    public function testImportCustomers()
    {

        $profile_source='sample.csv';
        $expectedResult[]="0"." ".CustomerImportManagement::SUCCESS_MESSAGE;
        $expectedResult[]="2"." ".CustomerImportManagement::SUCCESS_MESSAGE;
        $this->assertContains(
            $this->model->importCustomers('sample-csv', $profile_source),
            $expectedResult
        );
    }

    public function testGetProfile()
    {
        $profile="sample-csv";
        $this->assertEquals(
            $this->profiles[$profile],
            $this->model->getProfile('sample-csv', $profile),
        );

        return false;
    }
}
