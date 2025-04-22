$APPLICATION->IncludeComponent(
    "cargonomica:banner.text",
    "cargonomica:banner",
    "",
    [
        'IBLOCK_ID' => CARGONOMICA_MAIN_PAGE_SETTINGS_IB_ID,
        'ELEMENT_CODE' => 'index',
        'CACHE_TYPE' => 'A',
        'CACHE_TIME' => 3600 * 24 * 365,
    ],
);
