<?php
/**
 * Copyright © @2024 All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Wtc\CustomerImport\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Wtc\CustomerImport\Api\CustomerImportManagementInterface;
use Magento\Framework\Console\Cli;

class Import extends Command
{

    public const PROFILE_NAME = "profile-name";
    
    public const PROFILE_SOURCE = "source";
    
     /**
      * @var CustomerImportManagementInterface
      */
    protected $customerImportManagement;

    /**
     * Constructor
     * @param CustomerImportManagementInterface $customerImportManagement
     */

    public function __construct(
        CustomerImportManagementInterface $customerImportManagement,
    ) {
        $this->customerImportManagement = $customerImportManagement;
        parent::__construct();
    }

     /**
      * @inheritdoc
      */
    protected function configure()
    {
        $this->setName("wtc:customer:import");
        $this->setDescription("import customer");
        $this->setDefinition([
            new InputArgument(
                self::PROFILE_NAME,
                InputArgument::REQUIRED,
                "profile-name"
            ),
            new InputArgument(
                self::PROFILE_SOURCE,
                InputArgument::REQUIRED,
                "source"
            )
        ]);
        parent::configure();
    }

     /**
      * @inheritdoc
      */
    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        try {
            
            $profile_name = $input->getArgument(self::PROFILE_NAME);
            $profile_source = $input->getArgument(self::PROFILE_SOURCE);

            $message=$this->customerImportManagement->importCustomers($profile_name, $profile_source);
            $output->writeln($message);
            
            return Cli::RETURN_SUCCESS;
            
        } catch (\Exception $exception) {

            $output->writeln("<error>{$exception->getMessage()}</error>");
            return Cli::RETURN_FAILURE;
        }
    }
}
