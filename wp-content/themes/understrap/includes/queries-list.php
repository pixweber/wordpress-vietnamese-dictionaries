<?php
function getListSqlQuery($dict, $letter, $offset) {
    $where = "word LIKE '$letter%'";

    if ($letter === '0-9') {
        $where = "word REGEXP '^[0-9]'";
    }

    $queries = [
        'anh-viet' => [
            'list' => getAnhVietListSqlQuery($where, $offset),
            'count' => getAnhVietListCountSqlQuery($where),
        ],
        'viet-anh' => [
            'list' => getVietAnhListSqlQuery($where, $offset),
            'count' => getVietAnhListCountSqlQuery($where),
        ],
        'phap-viet' => [
            'list' => getGeneralListSqlQuery($where, $offset, 'fr_vi'),
            'count' => getGeneralListCountSqlQuery($where, 'fr_vi'),
        ],
        'viet-phap' => [
            'list' => getGeneralListSqlQuery($where, $offset, 'vi_fr'),
            'count' => getGeneralListCountSqlQuery($where, 'vi_fr'),
        ],
        'duc-viet' => [
            'list' => getGeneralListSqlQuery($where, $offset, 'de_vi'),
            'count' => getGeneralListCountSqlQuery($where, 'de_vi'),
        ],
        'viet-duc' => [
            'list' => getGeneralListSqlQuery($where, $offset, 'vi_de'),
            'count' => getGeneralListCountSqlQuery($where, 'vi_de'),
        ],
        'y-viet' => [
            'list' => getGeneralListSqlQuery($where, $offset, 'it_vi'),
            'count' => getGeneralListCountSqlQuery($where, 'it_vi'),
        ],
        'viet-viet' => [
            'list' => getGeneralListSqlQuery($where, $offset, 'vi_vi'),
            'count' => getGeneralListCountSqlQuery($where, 'vi_vi'),
        ],
    ];

    return $queries[$dict];
}

function getAnhVietListSqlQuery($where, $offset): string {
    return "SELECT DISTINCT word, slug FROM (
    SELECT word, slug FROM td111_en_vi_business WHERE $where
    UNION ALL    
    SELECT word, slug FROM td111_en_vi_technical WHERE $where
    UNION ALL
    SELECT word, slug FROM td111_en_vi_general WHERE $where
    ) fusion
    ORDER BY word LIMIT 500 OFFSET $offset";
}

function getAnhVietListCountSqlQuery($where): string {
    return "SELECT COUNT(*) AS count FROM (
    SELECT DISTINCT word, slug FROM (
    SELECT word, slug FROM td111_en_vi_business WHERE $where
    UNION ALL    
    SELECT word, slug FROM td111_en_vi_technical WHERE $where
    UNION ALL
    SELECT word, slug FROM td111_en_vi_general WHERE $where
    ) fusion
    ) ok";
}

function getVietAnhListSqlQuery($where, $offset): string {
    return "SELECT DISTINCT word, slug FROM (
    SELECT word, slug FROM td111_vi_en_business WHERE $where
    UNION ALL    
    SELECT word, slug FROM td111_vi_en_technical WHERE $where
    UNION ALL
    SELECT word, slug FROM td111_vi_en_general WHERE $where
    ) fusion
    ORDER BY word LIMIT 500 OFFSET $offset";
}

function getVietAnhListCountSqlQuery($where): string {
    return "SELECT COUNT(*) AS count FROM (
    SELECT DISTINCT word, slug FROM (
    SELECT word, slug FROM td111_vi_en_business WHERE $where
    UNION ALL    
    SELECT word, slug FROM td111_vi_en_technical WHERE $where
    UNION ALL
    SELECT word, slug FROM td111_vi_en_general WHERE $where
    ) fusion
    ) ok";
}

function getGeneralListSqlQuery($where, $offset, $iso) {
    $tableName = "td111_" . $iso. "_general";
    return "SELECT DISTINCT word, slug 
    FROM $tableName WHERE $where
    ORDER BY word LIMIT 500 OFFSET $offset";
}

function getGeneralListCountSqlQuery($where, $iso) {
    $tableName = "td111_" . $iso. "_general";
    return "SELECT COUNT(*) AS count 
    FROM $tableName 
    WHERE $where";
}