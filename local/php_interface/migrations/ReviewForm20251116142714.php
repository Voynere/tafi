<?php

namespace Sprint\Migration;


class ReviewForm20251116142714 extends Version
{
    protected $author = "tafiadmin";

    protected $description = "[357317]  Миграция для формы отзывов";

    protected $moduleVersion = "5.5.2";

    /**
     * @throws Exceptions\HelperException
     * @return bool|void
     */
    public function up()
    {
        $helper = $this->getHelperManager();
        $formId = $helper->Form()->saveForm(array (
  'NAME' => 'Написать отзыв',
  'SID' => 'REVIEW',
  'BUTTON' => 'Отправить',
  'C_SORT' => '300',
  'MAIL_EVENT_TYPE' => 'FORM_FILLING_REVIEW',
  'FILTER_RESULT_TEMPLATE' => '',
  'TABLE_RESULT_TEMPLATE' => '',
  'arSITE' => 
  array (
    0 => 's1',
  ),
  'arMENU' => 
  array (
    'ru' => 'Написать отзыв',
    'en' => '',
    'br' => '',
    'fr' => '',
    'it' => '',
    'la' => '',
    'pl' => '',
    'ua' => '',
  ),
  'arGROUP' => 
  array (
    'everyone' => '10',
  ),
  'arMAIL_TEMPLATE' => 
  array (
    0 => 
    array (
      'EVENT_NAME' => 'FORM_FILLING_REVIEW',
      'SUBJECT' => 'Заполнена форма "Оставить отзыв" на сайте #SITE_NAME#',
    ),
  ),
));
            $helper->Form()->saveField($formId, array (
  'TITLE' => 'Какую бы вы поставили оценку?',
  'TITLE_TYPE' => 'text',
  'SID' => 'RATING',
  'C_SORT' => '50',
  'IN_FILTER' => 'N',
  'IN_RESULTS_TABLE' => 'N',
  'FIELD_TYPE' => '',
  'FILTER_TITLE' => '',
  'RESULTS_TABLE_TITLE' => '',
  'ANSWERS' => 
  array (
    0 => 
    array (
      'FIELD_TYPE' => 'text',
      'C_SORT' => '100',
    ),
  ),
  'VALIDATORS' => 
  array (
  ),
));
            $helper->Form()->saveField($formId, array (
  'TITLE' => 'Ваше имя',
  'TITLE_TYPE' => 'text',
  'SID' => 'NAME',
  'REQUIRED' => 'Y',
  'IN_FILTER' => 'N',
  'IN_RESULTS_TABLE' => 'N',
  'FIELD_TYPE' => NULL,
  'COMMENTS' => NULL,
  'FILTER_TITLE' => NULL,
  'RESULTS_TABLE_TITLE' => NULL,
  'ANSWERS' => 
  array (
    0 => 
    array (
      'FIELD_TYPE' => 'text',
      'C_SORT' => '100',
    ),
  ),
  'VALIDATORS' => 
  array (
  ),
));
            $helper->Form()->saveField($formId, array (
  'ACTIVE' => 'N',
  'TITLE' => 'Ваш номер телефона',
  'TITLE_TYPE' => 'text',
  'SID' => 'PHONE',
  'C_SORT' => '200',
  'REQUIRED' => 'Y',
  'IN_FILTER' => 'N',
  'FIELD_TYPE' => '',
  'FILTER_TITLE' => '',
  'RESULTS_TABLE_TITLE' => '',
  'ANSWERS' => 
  array (
    0 => 
    array (
      'FIELD_TYPE' => 'text',
      'C_SORT' => '100',
    ),
  ),
  'VALIDATORS' => 
  array (
  ),
));
            $helper->Form()->saveField($formId, array (
  'TITLE' => 'Ваша почта',
  'TITLE_TYPE' => 'text',
  'SID' => 'EMAIL',
  'C_SORT' => '300',
  'REQUIRED' => 'Y',
  'IN_FILTER' => 'N',
  'IN_RESULTS_TABLE' => 'N',
  'FIELD_TYPE' => '',
  'FILTER_TITLE' => '',
  'RESULTS_TABLE_TITLE' => '',
  'ANSWERS' => 
  array (
    0 => 
    array (
      'FIELD_TYPE' => 'email',
      'C_SORT' => '100',
    ),
  ),
  'VALIDATORS' => 
  array (
  ),
));
            $helper->Form()->saveField($formId, array (
  'ACTIVE' => 'N',
  'TITLE' => 'Прикрепите файл, если требуется',
  'TITLE_TYPE' => 'text',
  'SID' => 'FILE',
  'C_SORT' => '400',
  'IN_FILTER' => 'N',
  'IN_RESULTS_TABLE' => 'N',
  'FIELD_TYPE' => '',
  'FILTER_TITLE' => '',
  'RESULTS_TABLE_TITLE' => '',
  'ANSWERS' => 
  array (
    0 => 
    array (
      'FIELD_TYPE' => 'file',
      'C_SORT' => '100',
    ),
  ),
  'VALIDATORS' => 
  array (
  ),
));
            $helper->Form()->saveField($formId, array (
  'TITLE' => 'Отзыв',
  'TITLE_TYPE' => 'text',
  'SID' => 'REVIEW_TEXT',
  'C_SORT' => '600',
  'REQUIRED' => 'Y',
  'IN_FILTER' => 'N',
  'IN_RESULTS_TABLE' => 'N',
  'FIELD_TYPE' => '',
  'FILTER_TITLE' => '',
  'RESULTS_TABLE_TITLE' => '',
  'ANSWERS' => 
  array (
    0 => 
    array (
      'FIELD_TYPE' => 'textarea',
      'FIELD_PARAM' => 'left',
      'C_SORT' => '100',
    ),
  ),
  'VALIDATORS' => 
  array (
  ),
));
        }
}

