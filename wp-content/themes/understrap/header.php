<?php
// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$bootstrap_version = get_theme_mod( 'understrap_bootstrap_version', 'bootstrap4' );
$navbar_type       = get_theme_mod( 'understrap_navbar_type', 'collapse' );
remove_action('wp_head', 'rel_canonical');
$dict = get_query_var('dict');
global $word;
global $post;
global $dictTables;
$letter = strtoupper(get_query_var('letter'));
$letterPage = get_query_var('letter-page') ? get_query_var('letter-page') : 1;
$description = "Tra cứu từ điển " . $dictTables[$dict]['title']. " online. Nghĩa của từ " . $word . " trong tiếng  " . ucwords($dictTables[$dict]['target']) . '.' . $word . " là gì? Tra cứu từ điển trực tuyến.";
if ($post->post_name == 'danh-sach-tu') {
    $description = "Danh sách từ ngữ " . $dictTables[$dict]['title'] . " theo vần $letter - Trang $letterPage";
}
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
    <meta name="description" content="<?php echo $description; ?>">
    <meta name="keywords" content="tra từ điển, từ điển collocation, từ điển wordnet, dịch, dịch tiếng anh, dịch anh việt, dịch tiếng việt, dịch tự động, dịch thuật, dịch nhanh, dịch chuyên ngành, dịch anh việt, từ điển anh việt, dịch online, phần mềm dịch, từ điển, translator, translate english, translate vietnamese, nga việt, việt nga, từ điển tiếng nga">
    <meta property="og:title" content="Add title here">
    <meta property="og:description" content="Add description here">
    <!--<meta property="og:image" content="https://your-website.com/og-image.png">-->
    <meta property="og:url" content="https://tudien.gautui.com">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FVSPJGP7E5"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-FVSPJGP7E5');
    </script>
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9179630402888925" crossorigin="anonymous"></script>
</head>

<body <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
<?php do_action( 'wp_body_open' ); ?>
<div class="site" id="page">

	<header id="wrapper-navbar">
		<a class="skip-link sr-only sr-only-focusable" href="#content"><?php esc_html_e( 'Skip to content', 'understrap' ); ?></a>
		<?php get_template_part( 'global-templates/navbar', $navbar_type . '-' . $bootstrap_version ); ?>
	</header>
