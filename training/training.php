<?php

add_filter('manage_edit-order_columns', 'add_custom_order_columns', 20);

function add_custom_order_columns($colums)
{
    $colums['Order Total'] = __('Order', 'Textdomain');

    return $colums;
}

add_action('manage_shop_order_custom_column', 'populate_order_total_column' 10, 2);
function populate_order_total_column($column_name, $post_id){
    if($column_name === 'order_total') {
        $order = wc_get_order($post_id);
        if($order){
            echo $order->get_formatted_order_total();
        }else {
            echo '-';
        }
    }
}