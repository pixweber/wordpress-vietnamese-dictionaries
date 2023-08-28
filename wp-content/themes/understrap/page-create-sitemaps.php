<?php
use SitemapPHP\Sitemap;
global $wpdb;
require get_template_directory() . '/sitemaps/queries.php';
global $queries;

$dict = 'viet-viet';
$uri = 'https://tudien.gautui.com';
$sitemap = new Sitemap("$uri");

echo '<pre>';
var_dump('$queries[$dict]', $queries[$dict]);
echo '</pre>';

$words = $wpdb->get_results($queries[$dict]);
foreach ( $words as $word ) {
    $sitemap->addItem(getUrlByWord($uri, $dict, $word->word), '0.6', 'weekly', date('Y-m-d'));
}

$sitemap->createSitemapIndex("$uri/sitemaps", 'Today');

function getUrlByWord($uri, $dict, $word) {
    global $dictTables;
    $target = sanitize_title($dictTables[$dict]['target']);
    return "/$dict/" . urlencode($word) . "_trong-tieng-$target-la-gi";
}