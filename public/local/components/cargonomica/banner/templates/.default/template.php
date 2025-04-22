<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * @var array $arResult
 */

if ($arResult['TOP_BANNER']['BannerShow'] != 'Y') {
    return;
}

?>

<style>
    .home-intro__heading:before {
        background: url(<?= $arResult['TOP_BANNER']['BannerLogo'] ?>) 50% 50% no-repeat;
        background-size: 100% auto;
    }

    .home-intro__folder:before {
        background: url(<?= SITE_TEMPLATE_PATH ?>/assets/img/folder-intro-top.svg) 0 100% no-repeat;
        background-size: auto 100%;
    }

    .btn-cta:after {
        background: url(<?= SITE_TEMPLATE_PATH ?>/assets/img/icons/btn-cta-arrow.svg);
        background-size: contain;
    }
</style>

<section class="home-intro">
    <div class="home-intro__inner">
        <video class="home-intro__back _desktop" muted autoplay loop playsinline inline>
            <source src="<?= $arResult['TOP_BANNER']['BannerVideoDesktop'] ?>" type="video/mp4">
        </video>
        <video class="home-intro__back _mobile" muted autoplay loop playsinline inline>
            <source src="<?= $arResult['TOP_BANNER']['BannerVideoMobile'] ?>" type="video/mp4">
        </video>
        <div class="home-intro__folder">
            <div class="home-intro__folder-body">
                <h1 class="home-intro__heading"><?= $arResult['TOP_BANNER']['BannerTitle'] ?></h1>
                <p class="home-intro__copy"><?= $arResult['TOP_BANNER']['BannerText'] ?></p>
                <p class="home-intro__cta">
                    <a href="<?= $arResult['TOP_BANNER']['BannerButtonLink'] ?>" class="btn-cta"><?= $arResult['TOP_BANNER']['BannerButtonText'] ?></a>
                </p>
            </div>
        </div>
    </div>
</section>
