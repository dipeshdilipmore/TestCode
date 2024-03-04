<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Wtc\CustomerImport\Model\Import\Profiles;

interface ProfileInterface
{

    public const FILE_PATH = "customer_import/";
    //const FILE_PATH = "";

    /**
     * Get customers data from profile
     *
     * @param string $profile_source
     * @return array
     */
    public function getCustomers($profile_source);

     /**
      * Validate profile
      *
      * @param string $profile_source
      * @return boolean
      */

    public function validateProfile($profile_source);

     /**
      * Return profile path
      *
      * @param string $profile_source
      * @return string
      */
    public function getProfilePath($profile_source);
}
