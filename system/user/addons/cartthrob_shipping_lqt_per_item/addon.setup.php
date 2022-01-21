<?php

require_once __DIR__ . '/vendor/autoload.php';

const CARTTHROB_SHIPPING_LQT_PER_ITEM_NAME = 'CartThrob Shipping by Location Quantity Threshold Per Item';
const CARTTHROB_SHIPPING_LQT_PER_ITEM_VERSION = '1.0.0';
const CARTTHROB_SHIPPING_LQT_PER_ITEM_DESC = 'CartThrob Shipping by Location Quantity Threshold Per Item';
const CARTTHROB_SHIPPING_LQT_PER_ITEM_SETTINGS_EXIST = false;

return [
    'author' => 'Foster Made',
    'author_url' => 'https://cartthrob.com',
    'docs_url' => '',
    'name' => CARTTHROB_SHIPPING_LQT_PER_ITEM_NAME,
    'description' => CARTTHROB_SHIPPING_LQT_PER_ITEM_DESC,
    'version' => CARTTHROB_SHIPPING_LQT_PER_ITEM_VERSION,
    'namespace' => 'CartThrob\ShippingSample',
    'settings_exist' => CARTTHROB_SHIPPING_LQT_PER_ITEM_SETTINGS_EXIST,
];
