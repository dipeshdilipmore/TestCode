<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Wtc\CustomerImport\Model\Import\Profiles;

/**
 * Read file wich is provided by commad provided customer data
 *
 */

class ProfileJson implements ProfileInterface
{
    /**
     * @var File
     */
    protected $driverFile;
    
    /**
     * @var Json
     */
    protected $json;

    /**
     * @var DirectoryList
     */
    protected $_dir;

    /**
     * Constructor
     *
     * @param File $driverFile
     * @param Json $json
     * @param DirectoryList $dir
     */

    public function __construct(
        \Magento\Framework\Filesystem\Driver\File $driverFile,
        \Magento\Framework\Serialize\Serializer\Json $json,
        \Magento\Framework\Filesystem\DirectoryList $dir
    ) {
        $this->driverFile = $driverFile;
        $this->json = $json;
        $this->_dir = $dir;
    }
    
     /**
      * Get file by file type
      *
      * @param string $profile_source
      * @return array
      */
    public function getCustomers($profile_source)
    {
        $jsonData=[];

        if ($this->validateProfile($profile_source)) {
            $fileContent = $this->driverFile->fileGetContents($this->getProfilePath($profile_source));
            $jsonData = $this->json->unserialize($fileContent);
        
        }
        
        return $jsonData;
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
        *  add validation rule for json file
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
