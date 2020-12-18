<?php

function btop_customer_club_order_status_completed($order_id)
{
    $udatedOrdersId = get_option('btop_customer_club_updated_orders_id');
    if (in_array($order_id, $udatedOrdersId)) {
        return;
    }
    $order = wc_get_order($order_id);
    $subtotal = $order->get_subtotal();
    $cart_min = get_option('btop_customer_club_cart_min');

    if ($subtotal < $cart_min) {
        return;
    }

    $email = $order->get_billing_email();
    $token = get_option('btop_customer_club_token');
    $unit = get_option('btop_customer_club_unit');
    $amount = floor($subtotal / $unit);

    if (!$token || !$email || !$amount) {
        return;
    }

    $response = wp_remote_post(
        esc_url_raw('http://btop.ir/wp-json/customer-club/transfer-credits'),
        array(
            'Content-Type' => 'application/json',
            'headers' => array(
                'Authorization' => 'Bearer ' . $token
            ),
            'body' => json_encode(array(
                'email' => $email,
                'amount' => $amount,
                "credittype" => "coin"
            )),
        )
    );

    $responseBody = wp_remote_retrieve_body($response);
    if ($responseBody && $responseBody['data'] && $responseBody['data']['postId']) {
        $udatedOrdersId[] = $order_id;
        update_option('btop_customer_club_updated_orders_id', $udatedOrdersId);
    }
}