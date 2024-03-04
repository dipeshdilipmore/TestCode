<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Wtc\CustomerImport\Model\Import\Profiles;

/**
 * Read Profile wich is provided by commad provided customer data
 *
 */

class ProfileCsv implements ProfileInterface
{
   /**
    * @var Csv
    */
    protected $csv;
    
    /**
     * @var DirectoryList
     */
    protected $_dir;

     /**
      * Constructor
      *
      * @param Csv $csv
      * @param DirectoryList $dir
      */

    public function __construct(
        \Magento\Framework\File\Csv $csv,
        \Magento\Framework\Filesystem\DirectoryList $dir
    ) {
        $this->csv = $csv;
        $this->_dir = $dir;
    }
    
    /**
     * Get file by profile
     *
     * @param string $csvProfile
     * @return array
     */
    public function getCustomers($csvProfile)
    {
         $csvData=[];
        if ($this->validateProfile($csvProfile)) {
            $csvDataRaw = $this->csv->getData($this->getProfilePath($csvProfile));
            $headerRow=$csvDataRaw[0];
            unset($csvDataRaw[0]); //remove header row
         
         //for compatible other profile mapped column to value
            foreach ($csvDataRaw as $csvDataRow) {
                $row=[];
                foreach ($headerRow as $key => $Column) {
                    $row[$Column]=$csvDataRow[$key];
                }
                $csvData[]=$row;
            }
        }
         return $csvData;
    }

    /**
     * Validate profile
     *
     * @param string $profile_source
     * @return boolean
     */

    public function validateProfile($profile_source)
    {
        
        /*
        *  @ToDo
        *  add validation rule for csv file
        */

        return true;
    }
    
     /**
      * Return profile path
      *
      * @param string $profile_source
      * @return string
      */
    public function getProfilePath($profile_source)
    {
        return $this->_dir->getPath("var")."/".self::FILE_PATH.$profile_source;
    }
}
