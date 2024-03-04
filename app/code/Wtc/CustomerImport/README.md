# Mage2 Module WTC CustomerImport

    ``wtc/module-customerimport``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [To Be](#markdown-header-to-be)



## Main Functionalities
Import bulk customer through command line from diffarent profile .
curentaly this module suport sample-csv (csv) and sample-json (json) profile 


## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/`
 - Enable the module by running `php bin/magento module:enable WTC_CustomerImport`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: from git hub
- clone code from https://github.com/dipeshdilipmore/TestCode.git
- add code in `app/code/`
- Enable the module by running `php bin/magento module:enable WTC_CustomerImport`
- Apply database updates by running `php bin/magento setup:upgrade`\*
- Flush the cache by running `php bin/magento cache:flush`

### Type 3: Composer 
This package is not yet accessible on packagist.org; it will be added eventually.

## Configuration
- create `customer_import` dir under var if not prsent 


## Specifications

 - Console Command
	- wtc:customer:import <profile-name> <source>
      -<profile-name> = sample-csv, sample-json
      -<source> = csv or json source file ,this source file place in `var/customer_import/` dir before runing command 

## To Be
To make file handling more efficient, will add validation. 
Will Handle duplicate records with appropriate message meaning 
Will add more unit test cases




