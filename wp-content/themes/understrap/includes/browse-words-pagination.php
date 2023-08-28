<?php
$dict = get_query_var('dict');
$rowsCount = get_query_var('rowsCount');
$nbPages = ceil($rowsCount/500);
global $letter;
$letterPage = get_query_var('letter-page');

if (!$letterPage) {
    $letterPage = 1;
}
?>

<div id="browse-words-top" class="pl-5 pr-5">
    <ul id="browse-letters-top" class="p-0 m-0">
        <?php for ($i = 1; $i <= $nbPages; $i++): ?>
            <a href="/danh-sach-tu/<?php echo $dict . '/' . $letter . '/' . $i; ?>"><li class="top-browse-item<?php echo $i == $letterPage ? ' active': ''; ?>"><?php echo $i; ?></li></a>
        <?php endfor; ?>
    </ul>
</div>