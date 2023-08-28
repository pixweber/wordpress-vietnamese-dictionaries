<?php
include("includes/queries-search.php");

$keyword = $_POST['keyword'];
$dict = $_POST['dict'];

$keyword = htmlspecialchars($keyword, ENT_QUOTES);
$keyword = addslashes($keyword);

$dictionaries = [];

$where = "word LIKE '$keyword%'";
$query = getSearchSqlQuery($dict, $keyword);

global $dictTables;
$target = $dictTables[$dict]['target'];

global $wpdb;
$results = $wpdb->get_results($query);

if ($results):
foreach ($results as $result): ?>
    <li><a id="<?php echo $result->slug; ?>" href="/<?php echo $dict; ?>/<?php echo urlencode($result->word); ?>_trong-tieng-<?php echo sanitize_title($target); ?>-la-gi"><?php echo $result->word; ?></a></li>
<?php endforeach;
endif?>
