<?php
/**
 * All-In-One Checkout v1.0.15 : All-In-One Checkout v1.0.15 (CFM Unit)
 *
 * @category:    Aitoc
 * @package:     Aitoc_Aitcheckout / Aitoc_Aitcheckoutfields
 * @version      1.0.15 - 2.9.15
 * @license:     jC7sr77MwqoHj2SDR8w4YXR3o3w7irXLNFUdRYpgyc
 * @copyright:   Copyright (c) 2015 AITOC, Inc. (http://www.aitoc.com)
 */
/**
* @copyright  Copyright (c) 2010 AITOC, Inc. 
*/

$installer = $this;

$installer->startSetup();

$fields = array();
$describe = $installer->getConnection()->describeTable($installer->getTable('catalog/eav_attribute'));
foreach ($describe as $columnData) {
    $fields[] = $columnData['COLUMN_NAME'];
}

$describeEav = $installer->getConnection()->describeTable($installer->getTable('eav/attribute'));
foreach ($describeEav as $columnData) {
    $fieldsEav[] = $columnData['COLUMN_NAME'];
}

if((in_array('ait_registration_page',$fieldsEav)===true)&&(in_array('ait_registration_page',$fields)===false))
{
    $installer->run("ALTER TABLE {$this->getTable('catalog_eav_attribute')}
      ADD COLUMN `ait_registration_page` tinyint(1) NOT NULL  DEFAULT '0' after `is_wysiwyg_enabled`,
      ADD COLUMN `ait_registration_place` tinyint(1) NOT NULL DEFAULT '0' after `ait_registration_page`,
      ADD COLUMN `ait_registration_position` int(11) NOT NULL DEFAULT '0' after `ait_registration_place`,
      ADD COLUMN `ait_filterable` tinyint(1) NOT NULL  DEFAULT '0' after `ait_registration_place`;
    ");
    $describe = $installer->getConnection()->describeTable($installer->getTable('catalog/eav_attribute'));
    foreach ($describe as $columnData) {
        $fields[] = $columnData['COLUMN_NAME'];
    }
    $fields = array_intersect($fields,$fieldsEav);
    $eavTypeTable = $installer->getTable('eav_entity_type');
    $typeExists = $installer->getConnection()->fetchOne("SELECT count(*) FROM `{$eavTypeTable}` WHERE `entity_type_code`='aitoc_checkout'");
    if($typeExists)
    {
        $typeId = $installer->getConnection()->fetchOne("SELECT `entity_type_id` FROM `{$eavTypeTable}` WHERE `entity_type_code`='aitoc_checkout'");
    
        $stmt = $installer->getConnection()->select()
            ->from($installer->getTable('eav/attribute'), $fields)
            ->where('entity_type_id = ?', $typeId);
        $result = $installer->getConnection()->fetchAll($stmt);
        $table = $installer->getTable('catalog/eav_attribute');
        foreach ($result as $data) {
            $installer->getConnection()->insertOnDuplicate($table, $data);
        }
    }

    $describe = $installer->getConnection()->describeTable($installer->getTable('catalog/eav_attribute'));
    foreach ($describe as $columnData) {
        if ($columnData['COLUMN_NAME'] == 'attribute_id') {
            continue;
        }
        $installer->getConnection()->dropColumn($installer->getTable('eav/attribute'), $columnData['COLUMN_NAME']);
    }   
}

$installer->run("

ALTER TABLE {$this->getTable('catalog_eav_attribute')}
  ADD COLUMN `is_display_in_invoice` tinyint(1) NOT NULL  DEFAULT '0' after `ait_filterable`;
");

$installer->endSetup();