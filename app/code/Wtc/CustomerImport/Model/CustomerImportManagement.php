<?php
/**
 * Copyright © @2024 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wtc\CustomerImport\Model;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Api\Data\CustomerInterfaceFactory;
use Wtc\CustomerImport\Api\CustomerImportManagementInterface;

class CustomerImportManagement implements CustomerImportManagementInterface
{
    
    /**
     * @var CustomerRepositoryInterface
     *
     */
     protected $customerRepository ;

     /**
      * @var CustomerInterfaceFactory
      *
      */
     protected $customerFactory;

     /**
      * @var string[]
      */
     protected $profiles;
    
     /**
      * Constructor
      *
      * @param  CustomerRepositoryInterface $customerRepository
      * @param  CustomerInterfaceFactory $customerFactory
      * @param array $profiles
      */

    public function __construct(
        CustomerRepositoryInterface $customerRepository,
        CustomerInterfaceFactory $customerFactory,
        array $profiles = []
    ) {
        $this->customerRepository =$customerRepository;
        $this->customerFactory = $customerFactory;
        $this->profiles = $profiles;
    }

    /**
     * Import customer from  profile
     *
     * @param string $profile
     * @param string $profile_source
     * @return string
     */
    public function importCustomers($profile, $profile_source)
    {
        $profilObje=$this->getProfile($profile);
        if ($profilObje) {
            $customers=$profilObje->getCustomers($profile_source);
            if (!empty($customers)) {
                $insertedCount=$this->saveCustomers($customers);

                return  $insertedCount." ".self::SUCCESS_MESSAGE;
            } else {
                return self::ERROR_NO_RECORD_FOUND ;
            }
        }
        
        return self::ERROR_NOT_VALIDE_PROFILE . implode(",", array_keys($this->profiles));
    }

    /**
     * Get Profile
     *
     * @param string $profile
     * @return Object
     */

    public function getProfile($profile)
    {
        if (isset($this->profiles[$profile])) {
            return $this->profiles[$profile];
        }

        return false;
    }

     /**
      * Save Customers
      *
      * @param array $customers
      * @return int
      */
    
    protected function saveCustomers($customers)
    {
        /** @var int $insertedCount */
        $insertedCount=0;

        /** @var int $errorCount */
        $errorCount=0;

        foreach ($customers as $customerRow) {

            /** @var CustomerInterface $customer */
            $customer = $this->customerFactory->create();
            $customer->setFirstname($customerRow[self::COLUMN_FIRST_NAME])
                ->setGroupId(1)
                ->setLastname($customerRow[self::COLUMN_LAST_NAME])
                ->setWebsiteId(1)
                ->setEmail($customerRow[self::COLUMN_EMAIL_ADDRESS]);
            try {
                $this->customerRepository->save($customer, 'password');
                $insertedCount++;
            } catch (\Exception $e) {
                //@ToDo handle error
                 
                $errorCount ++;
            }
        }
        return $insertedCount;
    }
}
