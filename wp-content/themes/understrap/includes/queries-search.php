<?php
function getSearchSqlQuery($dict, $keyword) {
    $queries = [
        'anh-viet' => getAnhVietSqlQuery($keyword),
        'viet-anh' => getVietAnhSearchSqlQuery($keyword),
        'viet-phap' => getGeneralSearchSqlQuery($keyword, 'fr_vi'),
        'viet-phap' => getGeneralSearchSqlQuery($keyword, 'vi_fr'),
        'duc-viet' => getGeneralSearchSqlQuery($keyword, 'de_vi'),
        'viet-duc' => getGeneralSearchSqlQuery($keyword, 'vi_de'),
        'y-viet' => getGeneralSearchSqlQuery($keyword, 'it_vi'),
        'viet-viet' => getGeneralSearchSqlQuery($keyword, 'vi_vi'),
    ];

    return $queries[$dict];
}

function getAnhVietSqlQuery($keyword): string {
    $where = "word LIKE '$keyword%'";

    return "SELECT DISTINCT word, slug FROM (
    SELECT word, slug FROM td111_en_vi_business WHERE $where
    UNION ALL    
    SELECT word, slug FROM td111_en_vi_technical WHERE $where
    UNION ALL
    SELECT word, slug FROM td111_en_vi_general WHERE $where
    ) fusion
    ORDER BY word LIMIT 20";
}

function getVietAnhSearchSqlQuery($keyword): string {
    $where = "word LIKE '$keyword%'";

    return "SELECT DISTINCT word, slug FROM (
    SELECT word, slug FROM td111_vi_en_business WHERE $where
    UNION ALL    
    SELECT word, slug FROM td111_vi_en_technical WHERE $where
    UNION ALL
    SELECT word, slug FROM td111_vi_en_general WHERE $where
    ) fusion
    ORDER BY word LIMIT 20";
}

function getGeneralSearchSqlQuery($keyword, $iso): string {
    $tableName = $tableName = "td111_" . $iso. "_general";
    $where = "word LIKE '$keyword%'";

    return "SELECT DISTINCT word, slug FROM (
        SELECT word, slug FROM $tableName WHERE $where
    ) fusion
    ORDER BY word LIMIT 20";
}