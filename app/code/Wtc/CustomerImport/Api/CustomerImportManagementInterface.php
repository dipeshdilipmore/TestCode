<?php
/**
 * Copyright © @2024 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wtc\CustomerImport\Api;

interface CustomerImportManagementInterface
{
    //error messages
    public const ERROR_NO_RECORD_FOUND="No Record Found in profile, please check Source have valide records";

    public const ERROR_NOT_VALIDE_PROFILE="This Profile Not valide. Available Profiles is ";

    //success messages
    public const SUCCESS_MESSAGE ="New Customer Added";
    
    //column mapping
    public const COLUMN_FIRST_NAME="fname";

    public const COLUMN_LAST_NAME="lname";

    public const COLUMN_EMAIL_ADDRESS="emailaddress";

    /**
     * Import customer from profile source
     *
     * @param string $profile
     * @param string $profile_source
     * @return string
     */
    public function importCustomers($profile, $profile_source);

     /**
      * Get Profile
      *
      * @param string $profile
      * @return Object
      */

    public function getProfile($profile);
}
