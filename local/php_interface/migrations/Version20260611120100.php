<?php

namespace Sprint\Migration;

class Version20260611120100 extends Version
{
    protected $author = "tafiadmin";

    protected $description = "Врачи: восстановить поля формы элемента после Version20260611120000";

    protected $moduleVersion = "5.5.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $iblockId = $helper->Iblock()->getIblockIdIfExists('doctors', 'aspro_max_content');

        $helper->UserOptions()->saveElementForm($iblockId, [
            'Параметры|edit1' => [
                'XML_ID' => 'Внешний код',
                'ID' => 'ID',
                'DATE_CREATE' => 'Создан',
                'TIMESTAMP_X' => 'Изменен',
                'ACTIVE' => 'Активность',
                'ACTIVE_FROM' => 'Начало активности',
                'ACTIVE_TO' => 'Окончание активности',
                'NAME' => 'Название',
                'CODE' => 'Символьный код',
                'SORT' => 'Сортировка',
                'IBLOCK_ELEMENT_PROP_VALUE' => 'Значения свойств',
                'PROPERTY_PROP_POSITION' => 'Должность',
                'PROPERTY_PROP_EXPERIENCE' => 'Стаж',
                'PROPERTY_PROP_ADDRESS' => 'Адрес филиала',
                'PREVIEW_PICTURE' => 'Фото',
                'PROPERTY_PROP_CATEGORY' => 'Категория',
                'PROPERTY_PROP_INITIAL_APPOINTMENT' => 'Первичный прием врача',
                'PROPERTY_PROP_SECOND_APPOINTMENT' => 'Повторный прием врача',
                'PROPERTY_PROP_ABILITY_HOME' => 'Доступен выезд на дом',
                'PROPERTY_PROP_ABILITY_INSURANCE' => 'Доступен приём по ДМС',
                'PROPERTY_PROP_ABILITY_CHILD' => 'Принимает взрослых и детей',
                'PROPERTY_PROP_SKILLS' => 'Навыки и услуги',
                'PROPERTY_PROP_EDUCATION' => 'Образование',
                'PROPERTY_PROP_REVIEWS' => 'Отзывы',
                'PROPERTY_PROP_APPOINTMENT_LINK' => 'Запись на прием',
                'PROPERTY_PROP_SHOW_ON_THE_MAIN' => 'Врачи на главной',
                'PROPERTY_PROP_DOCTOR_SERVICES' => 'Услуги врача',
                'PROPERTY_PROP_OFTEN_REQ' => 'С какими запросами чаще обращаются пациенты',
                'PROPERTY_PROP_APPOINTMENT_IMPORTANT' => 'Что важно в приеме',
                'PROPERTY_PROP_DOCTOR_ABOUT' => 'Доктор о себе',
            ],
            'SEO|edit14' => [
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
            ],
            'Разделы|edit2' => [
                'SECTIONS' => 'Разделы',
            ],
            'Подробно|edit6' => [
                'DETAIL_PICTURE' => 'Детальная картинка',
                'DETAIL_TEXT' => 'Детальное описание',
            ],
        ]);
    }
}
