<?php
$url = isset( $settings['url'] ) ? $settings['url'] : '';
$text = isset( $settings['text'] ) ? $settings['text'] : '';
$new_tab = isset( $settings['new_tab'] ) ? '_blank' : '_self';
?>
<a href="<?php echo esc_attr( $url ); ?>" class="btn btn-primary" target="<?php echo esc_attr( $new_tab ); ?>"><?php echo wp_kses_post( $text ); ?></a>