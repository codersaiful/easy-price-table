<?php
$symbol = isset( $settings['symbol'] ) ? $settings['symbol'] : '';
$amount = isset( $settings['amount'] ) ? $settings['amount'] : '';
$billing_cycle = isset( $settings['billing-cycle'] ) ? $settings['billing-cycle'] : '';
?>
<span class="currency"><?php echo wp_kses_post( $symbol ); ?></span>
<span class="amount"><?php echo wp_kses_post( $amount ); ?></span>
<span class="billing-cycle"><?php echo wp_kses_post( $billing_cycle ); ?></span>   