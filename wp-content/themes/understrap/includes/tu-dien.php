<?php
global $wp_query;
global $wpdb;
$query_vars = $wp_query->query_vars;

global $word;
global $meaningBusiness, $meaningTechnical, $meaningGeneral;

$dict = get_query_var('dict');
global $dictTables;


$dictTable = $dictTables[$dict];
$dictGeneralTable = 'td111_' . $dictTables[$dict]['iso'] . '_general';
$word = urldecode($query_vars['word']);
$target = $dictTables[$dict]['target'];

if (!$word) {
    $word = $dictTables[$dict]['default'];
}

if (in_array($dict, ['viet-anh', 'anh-viet'])) {
    $tableIso = $dictTables[$dict]['iso'];

    $results = $wpdb->get_results("SELECT word, meaning FROM td111_" . $tableIso . "_business WHERE word = '$word'");
    $meaningBusiness = $results[0]->meaning;

    $results = $wpdb->get_results("SELECT word, meaning FROM td111_" . $tableIso . "_technical WHERE word = '$word'");
    $meaningTechnical = $results[0]->meaning;
}

$results = $wpdb->get_results("SELECT word, meaning FROM $dictGeneralTable WHERE word = '$word'");
$meaningGeneral = $results[0]->meaning;
set_query_var('meaning', $word->meaning);

include("queries.php");
$query = getSqlQuery($dict, $word);
$results = $wpdb->get_results($query);

get_header();
$container = get_theme_mod( 'understrap_container_type' );
?>

    <div class="wrapper p-0" id="page-wrapper">
        <?php include("toolbar.php"); ?>

        <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">
            <div class="row">
                <div id="danh-sach-tu-col" class="col-4 col-sm-3">
                    <div id="danh-sach-tu" style="">
                        <ul style="padding-left: 20px">
                            <?php
                            if ($results):
                            foreach ($results as $result):
                                ?>
                                <li class="<?php echo sanitize_title($word) === $result->slug ? 'active' : ''; ?>">
                                    <a id="<?php echo sanitize_title($result->word); ?>" href="/<?php echo $dict; ?>/<?php echo urlencode($result->word); ?>_trong-tieng-<?php echo sanitize_title($target) ?>-la-gi"><?php echo $result->word; ?></a>
                                </li>
                            <?php
                            endforeach;
                            endif;
                            ?>
                        </ul>

                    </div>
                </div>
                <div class="col-8 col-sm-9">
                    <div id="nghia-cua-tu" class="pt-4">
                        <h2>Nghĩa của từ "<?php echo $word; ?>" trong tiếng <?php echo ucfirst($target); ?></h2>
                        <hr />
                        <?php
                        if ($meaningGeneral) {
                            echo '<h3>Từ điển phổ thông</h3>';
                            echo $meaningGeneral;
                            echo '<hr />';
                        }
                        ?>

                        <?php
                        if ($meaningBusiness) {
                            echo '<h3>Từ điển thương mại</h3>';
                            echo $meaningBusiness;
                            echo '<hr />';
                        }
                        ?>

                        <?php
                        if ($meaningTechnical) {
                            echo '<h3>Từ điển kỹ thuật</h3>';
                            echo $meaningTechnical;
                            echo '<hr />';
                        }
                        ?>
                    </div>
                </div>

            </div><!-- .row -->

        </div><!-- #content -->

    </div><!-- #page-wrapper -->


<?php
get_footer();