<?php

namespace Sprint\Migration;


class Version20251003112807 extends Version
{
    protected $author = "admin";

    protected $description = "новые свойства для инфоблока Направлений";

    protected $moduleVersion = "5.0.0";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('directions', 'aspro_max_content');
        $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Текст кнопки баннера 1',
  'ACTIVE' => 'Y',
  'SORT' => '535',
  'CODE' => 'PROP_BANNER1_BTN_TEXT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Текст кнопки  баннера 2',
  'ACTIVE' => 'Y',
  'SORT' => '635',
  'CODE' => 'PROP_BANNER2_BTN_TEXT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
            $helper->Iblock()->saveProperty($iblockId, array (
  'NAME' => 'Текст кнопки  баннера 3',
  'ACTIVE' => 'Y',
  'SORT' => '735',
  'CODE' => 'PROP_BANNER3_BTN_TEXT',
  'DEFAULT_VALUE' => '',
  'PROPERTY_TYPE' => 'S',
  'ROW_COUNT' => '1',
  'COL_COUNT' => '30',
  'LIST_TYPE' => 'L',
  'MULTIPLE' => 'N',
  'XML_ID' => NULL,
  'FILE_TYPE' => '',
  'MULTIPLE_CNT' => '5',
  'LINK_IBLOCK_ID' => '0',
  'WITH_DESCRIPTION' => 'N',
  'SEARCHABLE' => 'N',
  'FILTRABLE' => 'N',
  'IS_REQUIRED' => 'N',
  'VERSION' => '1',
  'USER_TYPE' => NULL,
  'USER_TYPE_SETTINGS' => NULL,
  'HINT' => '',
));
            $helper->UserOptions()->saveElementForm($iblockId, array (
  'Параметры|edit1' => 
  array (
    'ID' => 'ID',
    'DATE_CREATE' => 'Создан',
    'TIMESTAMP_X' => 'Изменен',
    'ACTIVE' => 'Активность',
    'ACTIVE_FROM' => 'Начало активности',
    'ACTIVE_TO' => 'Окончание активности',
    'NAME' => 'Название',
    'CODE' => 'Символьный код',
    'SORT' => 'Сортировка',
  ),
  'Основной блок|edit5' => 
  array (
    'PROPERTY_PROP_MAIN_BLOCK_ACTIVE' => 'Основной блок активен',
    'PROPERTY_PROP_MAIN_BLOCK_POSITION' => 'Положение основного блока',
    'PREVIEW_PICTURE' => 'Картинка для анонса',
    'PREVIEW_TEXT' => 'Описание для анонса',
  ),
  'Инфо блок|edit6' => 
  array (
    'PROPERTY_PROP_INFO_BLOCK_ACTIVE' => 'Инфо блок активен',
    'PROPERTY_PROP_INFO_BLOCK_POSITION' => 'Положение инфо блока',
    'DETAIL_PICTURE' => 'Детальная картинка',
    'DETAIL_TEXT' => 'Детальное описание',
  ),
  'Доп инфо блок|cedit9' => 
  array (
    'PROPERTY_PROP_INFO_BLOCK2_ACTIVE' => 'Доп инфо блок активен',
    'PROPERTY_PROP_INFO_BLOCK2_POSITION' => 'Положение доп инфо блока',
    'PROPERTY_PROP_INFO_BLOCK2_TITLE' => 'Заголовок доп инфо блока',
    'PROPERTY_PROP_INFO_BLOCK2_TOPTEXT' => 'Текст доп инфо блока сверху',
    'PROPERTY_PROP_INFO_BLOCK2_IMAGE' => 'Изображение доп инфо блока',
    'PROPERTY_PROP_INFO_BLOCK2_TEXT' => 'Текст доп инфо блока',
  ),
  'Преимущества|cedit1' => 
  array (
    'PROPERTY_PROP_ADV_BLOCK_ACTIVE' => 'Блок преимуществ активен',
    'PROPERTY_PROP_ADV_BLOCK_POSITION' => 'Положение блока преимуществ',
    'PROPERTY_PROP_ADV_BLOCK_ROW' => 'Преимуществ в ряд',
    'PROPERTY_PROP_ADV_BLOCK_TITLE' => 'Заголовок блока преимуществ',
    'cedit1_csection1' => 'Преимущество 1',
    'PROPERTY_PROP_ADV_BLOCK_ITEM1_ICON' => 'Преимущество 1 иконка',
    'PROPERTY_PROP_ADV_BLOCK_ITEM1_TITLE' => 'Преимущество 1 заголовок',
    'PROPERTY_PROP_ADV_BLOCK_ITEM1_DESCR' => 'Преимущество 1 описание',
    'cedit1_csection2' => 'Преимущество 2',
    'PROPERTY_PROP_ADV_BLOCK_ITEM2_ICON' => 'Преимущество 2 иконка',
    'PROPERTY_PROP_ADV_BLOCK_ITEM2_TITLE' => 'Преимущество 2 заголовок',
    'PROPERTY_PROP_ADV_BLOCK_ITEM2_DESCR' => 'Преимущество 2 описание',
    'cedit1_csection3' => 'Преимущество 3',
    'PROPERTY_PROP_ADV_BLOCK_ITEM3_ICON' => 'Преимущество 3 иконка',
    'PROPERTY_PROP_ADV_BLOCK_ITEM3_TITLE' => 'Преимущество 3 заголовок',
    'PROPERTY_PROP_ADV_BLOCK_ITEM3_DESCR' => 'Преимущество 3 описание',
    'cedit1_csection4' => 'Преимущество 4',
    'PROPERTY_PROP_ADV_BLOCK_ITEM4_ICON' => 'Преимущество 4 иконка',
    'PROPERTY_PROP_ADV_BLOCK_ITEM4_TITLE' => 'Преимущество 4 заголовок',
    'PROPERTY_PROP_ADV_BLOCK_ITEM4_DESCR' => 'Преимущество 4 описание',
  ),
  'Врачи|cedit2' => 
  array (
    'PROPERTY_PROP_DOCTORS_ACTIVE' => 'Блок врачи активен',
    'PROPERTY_PROP_DOCTORS_POSITION' => 'Положение блока врачей',
    'PROPERTY_PROP_DOCTORS_TITLE' => 'Заголовок блока врачей',
    'PROPERTY_PROP_DOCTORS' => 'Врачи',
  ),
  'Баннер 1|cedit3' => 
  array (
    'PROPERTY_PROP_BANNER1_ACTIVE' => 'Баннер 1 активен',
    'PROPERTY_PROP_BANNER1_POSITION' => 'Положение баннера 1',
    'PROPERTY_PROP_BANNER1_TITLE' => 'Заголовок баннера 1',
    'PROPERTY_PROP_BANNER1_TEXT' => 'Текст баннера 1',
    'PROPERTY_PROP_BANNER1_BTN_TEXT' => 'Текст кнопки баннера 1',
    'PROPERTY_PROP_BANNER1_LINK' => 'Ссылка с кнопки баннера 1',
    'PROPERTY_PROP_BANNER1_IMAGE' => 'Изображение баннера 1',
    'PROPERTY_PROP_BANNER1_COLOR' => 'Фоновый цвет баннера 1',
  ),
  'Баннер 2|cedit4' => 
  array (
    'PROPERTY_PROP_BANNER2_ACTIVE' => 'Баннер 2 активен',
    'PROPERTY_PROP_BANNER2_POSITION' => 'Положение баннера 2',
    'PROPERTY_PROP_BANNER2_TITLE' => 'Заголовок баннера 2',
    'PROPERTY_PROP_BANNER2_TEXT' => 'Текст баннера 2',
    'PROPERTY_PROP_BANNER2_BTN_TEXT' => 'Текст кнопки баннера 2',
    'PROPERTY_PROP_BANNER2_LINK' => 'Ссылка с кнопки баннера 2',
    'PROPERTY_PROP_BANNER2_IMAGE' => 'Изображение баннера 2',
    'PROPERTY_PROP_BANNER2_COLOR' => 'Фоновый цвет баннера 2',
  ),
  'Баннер 3|cedit5' => 
  array (
    'PROPERTY_PROP_BANNER3_ACTIVE' => 'Баннер 3 активен',
    'PROPERTY_PROP_BANNER3_POSITION' => 'Положение баннера 3',
    'PROPERTY_PROP_BANNER3_TITLE' => 'Заголовок баннера 3',
    'PROPERTY_PROP_BANNER3_TEXT' => 'Текст баннера 3',
    'PROPERTY_PROP_BANNER3_BTN_TEXT' => 'Текст кнопки баннера 3',
    'PROPERTY_PROP_BANNER3_LINK' => 'Ссылка с кнопки баннера 3',
    'PROPERTY_PROP_BANNER3_IMAGE' => 'Изображение баннера 3',
    'PROPERTY_PROP_BANNER3_COLOR' => 'Фоновый цвет баннера 3',
  ),
  'Прайс|cedit6' => 
  array (
    'PROPERTY_PROP_PRICES_ACTIVE' => 'Блок цен активен',
    'PROPERTY_PROP_PRICES_POSITION' => 'Положение блока цен',
    'PROPERTY_PROP_PRICES_LINK' => 'Ссылка в блоке цен',
    'PROPERTY_PROP_PRICES_TITLE' => 'Заголовок блока цен',
    'PROPERTY_PROP_PRICES_LIST' => 'Список цен',
  ),
  'FAQ|cedit7' => 
  array (
    'PROPERTY_PROP_FAQ_ACTIVE' => 'Блок вопросов активен',
    'PROPERTY_PROP_FAQ_POSITION' => 'Положение блока вопросов',
    'PROPERTY_PROP_FAQ_TITLE' => 'Заголовок блока вопросов',
    'PROPERTY_PROP_FAQ_LIST' => 'Список вопросов',
  ),
  'Статьи|cedit8' => 
  array (
    'PROPERTY_PROP_ARTICLES_ACTIVE' => 'Блок статей активен',
    'PROPERTY_PROP_ARTICLES_POSITION' => 'Положение блока статей',
    'PROPERTY_PROP_ARTICLES_LINK' => 'Ссылка блока статей',
    'PROPERTY_PROP_ARTICLES_TITLE' => 'Заголовок блока статей',
    'PROPERTY_PROP_ARTICLES_LIST' => 'Список статей',
  ),
  'Список услуг|cedit10' => 
  array (
    'PROPERTY_PROP_LIST_ACTIVE' => 'Список услуг активен',
    'PROPERTY_PROP_LIST_POSITION' => 'Положение списка услуг',
    'PROPERTY_PROP_LIST_TITLE' => 'Заголовок списка услуг',
    'PROPERTY_PROP_LIST' => 'Список услуг',
  ),
  'Текстовые карточки|cedit11' => 
  array (
    'PROPERTY_PROP_CARDS_ACTIVE' => 'Блок карточек активен',
    'PROPERTY_PROP_CARDS_POSITION' => 'Положение блока карточек',
    'PROPERTY_PROP_CARDS_ROW' => 'Карточек в ряд',
    'PROPERTY_PROP_CARDS_NUM' => 'Нумерация карточек',
    'PROPERTY_PROP_CARDS_TITLE' => 'Заголовок блока карточек',
    'PROPERTY_PROP_CARDS1' => 'Карточка 1',
    'PROPERTY_PROP_CARDS2' => 'Карточка 2',
    'PROPERTY_PROP_CARDS3' => 'Карточка 3',
    'PROPERTY_PROP_CARDS4' => 'Карточка 4',
    'PROPERTY_PROP_CARDS_IMAGE' => 'Карточка с изображением(на всю ширину)',
  ),
  'Текстовые карточки 2|cedit13' => 
  array (
    'PROPERTY_PROP_CARDS2_ACTIVE' => 'Блок карточек 2 активен',
    'PROPERTY_PROP_CARDS2_POSITION' => 'Положение блока карточек 2',
    'PROPERTY_PROP_CARDS2_ROW' => 'Карточек в ряд (2)',
    'PROPERTY_PROP_CARDS2_NUM' => 'Нумерация карточек (2)',
    'PROPERTY_PROP_CARDS2_TITLE' => 'Заголовок блока карточек 2',
    'PROPERTY_PROP_CARDS2_1' => 'Карточка 1 (2)',
    'PROPERTY_PROP_CARDS2_2' => 'Карточка 2 (2)',
    'PROPERTY_PROP_CARDS2_3' => 'Карточка 3 (2)',
    'PROPERTY_PROP_CARDS2_4' => 'Карточка 4 (2)',
    'PROPERTY_PROP_CARDS2_IMAGE' => 'Карточка с изображением(на всю ширину) (2)',
  ),
  'Раскрывающийся список|cedit12' => 
  array (
    'PROPERTY_PROP_ACCORD_ACTIVE' => 'Раскрывающийся список активен',
    'PROPERTY_PROP_ACCORD_POSITION' => 'Положение раскрывающегося списка',
    'PROPERTY_PROP_ACCORD_TITLE' => 'Заголовок раскрывающегося списка',
    'PROPERTY_PROP_ACCORD_LIST' => 'Раскрывающийся список',
  ),
  'SEO|edit14' => 
  array (
    'IPROPERTY_TEMPLATES_ELEMENT_META_TITLE' => 'Шаблон META TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_META_KEYWORDS' => 'Шаблон META KEYWORDS',
    'IPROPERTY_TEMPLATES_ELEMENT_META_DESCRIPTION' => 'Шаблон META DESCRIPTION',
    'IPROPERTY_TEMPLATES_ELEMENT_PAGE_TITLE' => 'Заголовок элемента',
    'IPROPERTY_TEMPLATES_ELEMENTS_PREVIEW_PICTURE' => 'Настройки для картинок анонса элементов',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_PREVIEW_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'IPROPERTY_TEMPLATES_ELEMENTS_DETAIL_PICTURE' => 'Настройки для детальных картинок элементов',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_ALT' => 'Шаблон ALT',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_TITLE' => 'Шаблон TITLE',
    'IPROPERTY_TEMPLATES_ELEMENT_DETAIL_PICTURE_FILE_NAME' => 'Шаблон имени файла',
    'SEO_ADDITIONAL' => 'Дополнительно',
    'TAGS' => 'Теги',
  ),
  'Разделы|edit2' => 
  array (
    'SECTIONS' => 'Разделы',
  ),
));
    $helper->UserOptions()->saveElementGrid($iblockId, array (
  'views' => 
  array (
    'default' => 
    array (
      'columns' => 
      array (
        0 => '',
      ),
      'columns_sizes' => 
      array (
        'expand' => 1,
        'columns' => 
        array (
        ),
      ),
      'sticked_columns' => 
      array (
      ),
      'custom_names' => 
      array (
      ),
    ),
  ),
  'filters' => 
  array (
  ),
  'current_view' => 'default',
));

    }
}
