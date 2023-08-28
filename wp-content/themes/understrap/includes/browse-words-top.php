<?php
$dict = get_query_var('dict');
$letters = ['0-9', 'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'x', 'y', 'z'];
global $letter;
?>
<div id="browse-words-top">
    <ul id="browse-letters-top" class="p-0 m-0">
        <?php foreach ($letters as $letter_):?>
            <a href="/danh-sach-tu/<?php echo $dict; ?>/<?php echo $letter_; ?>"><li class="top-browse-item<?php echo $letter_ === $letter ? ' active': ''; ?>"><?php echo strtoupper($letter_); ?></li></a>
        <?php endforeach; ?>
    </ul>
</div>