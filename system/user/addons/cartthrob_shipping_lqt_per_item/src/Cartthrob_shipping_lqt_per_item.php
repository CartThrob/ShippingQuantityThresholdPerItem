<?php

if (!defined('CARTTHROB_PATH')) {
    Cartthrob_core::core_error('No direct script access allowed');
}

use CartThrob\Plugins\Shipping\ShippingPlugin;
use Money\Money;

class Cartthrob_shipping_lqt_per_item extends ShippingPlugin
{
    // CartThrob Properties
    public $short_title = 'ct.lqt_per_item.short_title';

    public $settings = [
            [
                'name' => 'set_shipping_cost_by',
                'short_name' => 'mode',
                'default' => 'rate',
                'type' => 'radio',
                'options' => [
                    'price' => 'rate_amount',
                    'rate' => 'rate_amount_times_cart_total',
                ],
            ],
            [
                'name' => 'primary_location_field',
                'short_name' => 'location_field',
                'type' => 'select',
                'default' => 'country_code',
                'options' => [
                    'zip' => 'zip',
                    'state' => 'state',
                    'region' => 'Region',
                    'country_code' => 'settings_country_code',
                    'shipping_zip' => 'shipping_zip',
                    'shipping_state' => 'shipping_state',
                    'shipping_region' => 'shipping_region',
                    'shipping_country_code' => 'settings_shipping_country_code',
                ],
            ],
            [
                'name' => 'backup_location_field',
                'short_name' => 'backup_location_field',
                'type' => 'select',
                'default' => 'country_code',
                'options' => [
                    'zip' => 'zip',
                    'state' => 'state',
                    'region' => 'Region',
                    'country_code' => 'settings_country_code',
                    'shipping_zip' => 'shipping_zip',
                    'shipping_state' => 'shipping_state',
                    'shipping_region' => 'shipping_region',
                    'shipping_country_code' => 'settings_shipping_country_code',
                ],
            ],
            [
                'name' => 'thresholds',
                'short_name' => 'thresholds',
                'type' => 'matrix',
                'settings' => [
                    [
                        'name' => 'location_threshold',
                        'short_name' => 'location',
                        'type' => 'text',
                    ],
                    [
                        'name' => 'rate',
                        'short_name' => 'rate',
                        'note' => 'rate_example',
                        'type' => 'text',
                    ],
                    [
                        'name' => 'quantity_threshold',
                        'short_name' => 'threshold',
                        'note' => 'quantity_threshold_example',
                        'type' => 'text',
                    ],
                ],
            ],
        ];

    /**
     * @param Cartthrob_cart $cart
     * @return Money
     */
    public function rate(Cartthrob_cart $cart): Money
    {
        $customer_info = $this->core->cart->customer_info();

        $location_field = $this->plugin_settings('location_field', 'shipping_country_code');
        $backup_location_field = $this->plugin_settings('backup_location_field', 'country_code');
        $location = '';

        if (!empty($customer_info[$location_field])) {
            $location = $customer_info[$location_field];
        } elseif (!empty($customer_info[$backup_location_field])) {
            $location = $customer_info[$backup_location_field];
        }

        $total_shipping = 0;

        foreach ($this->core->cart->items() as $item) {
            if ($item->is_shippable()) {
                $total_items = $item->quantity();

                $shipping = 0;
                $price = ($item->price() * $item->quantity());

                $priced = false;
                $last_rate = '';

                foreach ($this->plugin_settings('thresholds', []) as $threshold_setting) {
                    $location_array = preg_split('/\s*,\s*/', trim($threshold_setting['location']));

                    if (in_array($location, $location_array)) {
                        if ($total_items > $threshold_setting['threshold']) {
                            $last_rate = $threshold_setting['rate'];
                            continue;
                        } else {
                            $shipping = ($this->plugin_settings('mode') == 'rate') ? $price * $threshold_setting['rate'] : $threshold_setting['rate'];
                            $priced = true;
                            break;
                        }
                        $last_rate = $threshold_setting['rate'];
                    } elseif (in_array('GLOBAL', $location_array)) {
                        if ($total_items > $threshold_setting['threshold']) {
                            $last_rate = $threshold_setting['rate'];
                            continue;
                        } else {
                            $shipping = ($this->plugin_settings('mode') == 'rate') ? $price * $threshold_setting['rate'] : $threshold_setting['rate'];
                            $priced = true;
                            break;
                        }
                        $last_rate = $threshold_setting['rate'];
                    }
                }

                if (!$priced) {
                    $shipping = ($this->plugin_settings('mode') == 'rate') ? $price * $last_rate : $last_rate;
                }

                $total_shipping += $shipping;
            }
        }

        return ee('cartthrob:MoneyService')->toMoney($total_shipping);
    }
}
