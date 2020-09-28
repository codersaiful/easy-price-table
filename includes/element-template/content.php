<?php
$content = isset( $settings['content'] ) ? $settings['content'] : '';
echo wp_kses_post( $content );
