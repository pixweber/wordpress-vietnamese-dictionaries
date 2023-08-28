<?php
function getSqlQuery($dict, $word) {
    $word = urldecode($word);

    $queries = [
        'anh-viet' => getAnhVietSqlQuery($word),
        'viet-anh' => getVietAnhSqlQuery($word),
        'phap-viet' => getGeneralSqlQuery($word, 'fr_vi'),
        'viet-phap' => getGeneralSqlQuery($word, 'vi_fr'),
        'duc-viet' => getGeneralSqlQuery($word, 'de_vi'),
        'viet-duc' => getGeneralSqlQuery($word, 'vi_de'),
        'y-viet' => getGeneralSqlQuery($word, 'it_vi'),
        'viet-viet' => getGeneralSqlQuery($word, 'vi_vi'),
    ];

    return $queries[$dict];
}

function getAnhVietSqlQuery($word): string {
    return "SELECT DISTINCT word, slug FROM (
    (SELECT word, slug FROM td111_en_vi_business where word < '$word' ORDER BY word DESC LIMIT 50)
    UNION ALL
    SELECT word, slug FROM td111_en_vi_business WHERE word = '$word'
    UNION ALL
    (SELECT word, slug FROM td111_en_vi_business WHERE word > '$word' ORDER BY word limit 50)
    UNION ALL
    (SELECT word, slug FROM td111_en_vi_technical where word < '$word' ORDER BY word DESC LIMIT 50)
    UNION ALL
    SELECT word, slug FROM td111_en_vi_technical WHERE word = '$word'
    UNION ALL
    (SELECT word, slug FROM td111_en_vi_technical WHERE word > '$word' ORDER BY word limit 50)
    UNION ALL
    (SELECT word, slug FROM td111_en_vi_general where word < '$word' ORDER BY word DESC LIMIT 50)
    UNION ALL
    SELECT word, slug FROM td111_en_vi_general WHERE word = '$word'
    UNION ALL
    (SELECT word, slug FROM td111_en_vi_general WHERE word > '$word' ORDER BY word limit 50)
    ) fusion
    
    ORDER BY word";
}

function getVietAnhSqlQuery($word): string {
    return "SELECT DISTINCT word, slug FROM (
    (SELECT word, slug FROM td111_vi_en_business where word < '$word' ORDER BY word DESC LIMIT 50)
    UNION ALL
    SELECT word, slug FROM td111_vi_en_business WHERE word = '$word'
    UNION ALL
    (SELECT word, slug FROM td111_vi_en_business WHERE word > '$word' ORDER BY word limit 50)
    UNION ALL
    (SELECT word, slug FROM td111_vi_en_technical where word < '$word' ORDER BY word DESC LIMIT 50)
    UNION ALL
    SELECT word, slug FROM td111_vi_en_technical WHERE word = '$word'
    UNION ALL
    (SELECT word, slug FROM td111_vi_en_technical WHERE word > '$word' ORDER BY word limit 50)
    UNION ALL
    (SELECT word, slug FROM td111_vi_en_general where word < '$word' ORDER BY word DESC LIMIT 50)
    UNION ALL
    SELECT word, slug FROM td111_vi_en_general WHERE word = '$word'
    UNION ALL
    (SELECT word, slug FROM td111_vi_en_general WHERE word > '$word' ORDER BY word limit 50)
    ) fusion
    
    ORDER BY word";
}

function getGeneralSqlQuery($word, $iso) {
    $tableName = "td111_" . $iso. "_general";

    return "SELECT DISTINCT word, slug FROM (
    (SELECT word, slug FROM $tableName where word < '$word' ORDER BY word DESC LIMIT 50)
    UNION ALL
    SELECT word, slug FROM $tableName WHERE word = '$word'
    UNION ALL
    (SELECT word, slug FROM $tableName WHERE word > '$word' ORDER BY word limit 50)
    ) fusion    
    ORDER BY word";
}