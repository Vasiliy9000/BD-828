
<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 */

if ($arResult['textBanner']['textBannerShow'] !== 'Y') {
    return;
}

?>

<section class="home-promo">
    <div class="home-promo__inner">
        <div class="home-promo__body">
            <h2 class="home-promo__heading"><?= $arResult['textBanner']['textBannerText'] ?></h2>
            <style>
                .home-promo__body:after {
                    background: url(<?= $arResult['textBanner']['textBannerImage'] ?>) 100% 0 no-repeat;
                    background-size: 100% auto;
                }
            </style>
        </div>
    </div>
</section>
