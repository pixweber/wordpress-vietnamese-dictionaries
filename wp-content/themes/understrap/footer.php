<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
$container = get_theme_mod('understrap_container_type');
global $word;
global $post;
?>

<?php get_template_part('sidebar-templates/sidebar', 'footerfull'); ?>

<div class="wrapper" id="wrapper-footer">
    <div class="<?php echo esc_attr($container); ?>">
        <div class="row">
            <div class="col-md-12">
                <footer class="site-footer" id="colophon">
                    <div class="site-info text-center">
                        <?php
                        if ($post->post_name !== 'danh-sach-tu') {
                            include("includes/browse-words.php");
                        }
                        ?>
                    </div><!-- .site-info -->
                </footer><!-- #colophon -->
            </div><!--col end -->
        </div><!-- row end -->
    </div><!-- container end -->
</div><!-- wrapper end -->
</div><!-- #page we need this extra closing tag here -->
<?php
wp_footer();
global $post;
?>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        function scrollList() {
            $('#danh-sach-tu').animate({
                scrollTop: $("#<?php echo sanitize_title($word); ?>").offset().top - 500
            }, 1);
        }

        $('#dict-list').val('<?php echo get_query_var('dict'); ?>');
        $('#dict-list').change(function(){
            window.location.href = "/" + $(this).val();
        });

        <?php if (in_array($post->post_name, ['anh-viet', 'viet-anh', 'viet-phap', 'viet-phap', 'duc-viet', 'viet-duc'])): ?>
            scrollList();
        <?php endif; ?>

        $('#tim-kiem').keyup(function() {
            var keyword = $(this).val();
            var dict = $('#dict-list').val();

            if (keyword.length < 3) return;

            $.ajax({
                type: "POST",
                url: "/search",
                data: `keyword=${keyword}&dict=${dict}`,
                beforeSend: function(){
                },
                success: function(data){
                    console.log(data);
                    $('#danh-sach-tu').html(data);
                }
            });
        });

        $('#button-addon2').click(function(){
            $('#tim-kiem').val('');
        })
    });
</script>

</body>

</html>

