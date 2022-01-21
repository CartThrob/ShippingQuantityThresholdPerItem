<?php

require_once __DIR__ . '/vendor/autoload.php';

const CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_NAME = 'CartThrob Shipping by Location Quantity Threshold Per Item';
const CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_VERSION = '1.0.0';
const CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_DESC = 'CartThrob Shipping by Location Quantity Threshold Per Item';
const CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_SETTINGS_EXIST = false;

return [
    'author' => 'Foster Made',
    'author_url' => 'https://cartthrob.com',
    'docs_url' => '',
    'name' => CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_NAME,
    'description' => CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_DESC,
    'version' => CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_VERSION,
    'namespace' => 'CartThrob\ShippingSample',
    'settings_exist' => CARTTHROB_SHIPPING_PER_ITEM_LOCATION_QUANTITY_THRESHOLD_SETTINGS_EXIST,
];
