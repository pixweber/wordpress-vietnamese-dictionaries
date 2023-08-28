<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
global $wp_query;
global $wpdb;
global $dict, $letter;
$query_vars = $wp_query->query_vars;

include("includes/queries-list.php");
global $dictTables;

$dict = $query_vars['dict'];
$letter = $query_vars['letter'];
$dictTable = $dictTables[$dict];
$target = $dictTables[$dict]['target'];

$offset = 0;
if ($query_vars['letter-page']) {
    $offset = (int)$query_vars['letter-page'] * 500;
}

$where = "slug LIKE '$letter%'";
if ($letter === '0-9') {
    $where = "slug REGEXP '^[0-9]'";
}

$queryCount = getListSqlQuery($dict, $letter, $offset)['count'];
$query = getListSqlQuery($dict, $letter, $offset)['list'];

$results = $wpdb->get_results($queryCount);
set_query_var('rowsCount', $results[0]->count);

$results = $wpdb->get_results($query);
get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>
    <div class="wrapper p-0" id="page-wrapper">
        <?php //include("includes/toolbar.php"); ?>

        <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
            <div class="text-center mt-5 mb-2">
                <?php include("includes/browse-words-top.php"); ?>
            </div>

            <div id="browse-words-results" class="p-4">
                <ul><?php foreach ($results as $result): ?><li><a id="<?php echo $result->word; ?>" href="/<?php echo $dict; ?>/<?php echo urlencode($result->word); ?>_trong-tieng-<?php echo sanitize_title($target); ?>-la-gi"><?php echo $result->word; ?></a></li><?php endforeach; ?>
                </ul>
            </div>

            <div class="text-center mt-1 mb-4">
                <?php include("includes/browse-words-pagination.php"); ?>
            </div>
        </div><!-- #content -->

    </div><!-- #page-wrapper -->


<?php
get_footer();