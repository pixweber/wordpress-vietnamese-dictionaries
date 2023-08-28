<?php
/*$words = json_decode(file_get_contents('./it_vi_general.json'), true);

global $wpdb;
$tablename = $wpdb->prefix.'it_vi_general';

foreach ($words as $word) {
    $wpdb->insert( $tablename, [
        'word' => $word['word'],
        'slug' => sanitize_title($word['word']),
        'meaning' => $word['meaning'],
    ],
    ['%s', '%s', '%s']);
}*/