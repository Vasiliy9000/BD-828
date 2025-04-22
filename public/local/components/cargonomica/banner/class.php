<?php

namespace Components\Cargonomica;

use Bitrix\Main\ArgumentException;
use Bitrix\Main\FileTable;
use Bitrix\Main\ObjectPropertyException;
use Bitrix\Main\SystemException;
use CBitrixComponent;
use CFile;
use CIBlockElement;
use Exception;

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/**
 * https://jira.cargonomica.com/browse/BD-828
 */
class Banner extends CBitrixComponent
{
    /**
     * Обрабатываем параметры на случай неисправности
     * @param $arParams
     * @return array
     * @throws Exception
     */
    public function onPrepareComponentParams($arParams): array
    {
        $arParams['IBLOCK_ID'] = (int)$arParams['IBLOCK_ID'];
        if (!$arParams['IBLOCK_ID']) {
            throw new Exception('IBLOCK_ID is empty');
        }

        if (!$arParams['ELEMENT_CODE']) {
            throw new Exception('ELEMENT_CODE is empty');
        }

        return $arParams;
    }

    /**
     * @return void
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     */
    public function executeComponent(): void
    {
        if ($this->startResultCache()) {
            $this->execution();
            $this->includeComponentTemplate();
        }
    }

    /**
     * @return void
     * @throws ArgumentException
     * @throws ObjectPropertyException
     * @throws SystemException
     * @throws Exception
     */
    protected function execution(): void
    {
        $elements = CIBlockElement::GetList(
            [],
            [
                'IBLOCK_ID' => $this->arParams['IBLOCK_ID'],
                'CODE' => $this->arParams['ELEMENT_CODE'],
            ],
            false,
            ['nTopCount' => 1],
            [
                'PROPERTY_TOP_BANNER_LOGO',
                'PROPERTY_TOP_BANNER_VIDEO_DESKTOP',
                'PROPERTY_TOP_BANNER_VIDEO_MOBILE',

                'PROPERTY_TOP_BANNER_SHOW',
                'PROPERTY_TOP_BANNER_TITLE',
                'PROPERTY_TOP_BANNER_TEXT',
                'PROPERTY_TOP_BANNER_BUTTON_TEXT',
                'PROPERTY_TOP_BANNER_BUTTON_LINK'
            ]
        )->Fetch();

        if (!$elements) {
            throw new Exception('Element not found');
        }

        $this->arResult['TOP_BANNER'] = [
            'BannerShow' => $elements['PROPERTY_TOP_BANNER_SHOW_VALUE'],
            'BannerTitle' => $elements['PROPERTY_TOP_BANNER_TITLE_VALUE'],
            'BannerText' => $elements['PROPERTY_TOP_BANNER_TEXT_VALUE'],
            'BannerButtonText' => $elements['PROPERTY_TOP_BANNER_BUTTON_TEXT_VALUE'],
            'BannerButtonLink' => $elements['PROPERTY_TOP_BANNER_BUTTON_LINK_VALUE'],
        ];

        $ids = [
            'BannerLogo' => $elements['PROPERTY_TOP_BANNER_LOGO_VALUE'],
            'BannerVideoDesktop' => $elements['PROPERTY_TOP_BANNER_VIDEO_DESKTOP_VALUE'],
            'BannerVideoMobile' => $elements['PROPERTY_TOP_BANNER_VIDEO_MOBILE_VALUE'],
        ];

        $file = FileTable::getList([
            'select' => ['ID', 'SUBDIR', 'FILE_NAME'],
            'filter' => ['=ID' => $ids],
        ]);

        $fileLinks = [];
        while ($property = $file->fetch()) {
            $fileLinks = CFile::GetFileSRC($property);
            $this->arResult['TOP_BANNER'][array_search($property['ID'], $ids)] = $fileLinks;
        }
    }
}
