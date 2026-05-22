<?php
declare(strict_types=1);
namespace Itb\Seo\Service;

use cijic\phpMorphy\Morphy;

class MorphyService 
{
    protected Morphy $morphy;
    protected string $charset;

    protected function __construct(string $charset = 'utf-8') {
        $this->charset = $charset;

        try {
            $this->morphy = new Morphy();
        } catch(\Throwable $e) {
            die('Error occured while creating phpMorphy instance: ' . $e->getMessage());
        }
    }

    protected function toLower(string $word) {
        return mb_strtolower($word, $this->charset);
    }

    protected function toUpper(string $word) {
        return mb_strtoupper($word, $this->charset);
    }

    public function getFormsWord(string $word, string $type = 'ЕД') {

        $word = $this->toUpper($word);

        $paradigms = $this->morphy->findWord($word);
        $word_forms = array();

        if($paradigms) {
            $paradigms->getByPartOfSpeech('С');

            foreach ($paradigms as $paradigm) {
                $info = $paradigm->getFoundWordForm();
                if(isset($info[0])) {
                    $gramm = $info[0]->getGrammems();
                    if(in_array("МН", $gramm)) {
                        $type = "МН";
                    }
                }
                foreach ($paradigm as $form) {

                    $value = $this->toLower($form->getWord());

                    if ($form->hasGrammems(array($type, 'РД'))) {
                        $word_forms['GENITIVE'] = $value;
                    } elseif ($form->hasGrammems(array($type, 'ДТ'))) {
                        $word_forms['DATIVE'] = $value;
                    } elseif ($form->hasGrammems(array($type, 'ВН'))) {
                        $word_forms['ACCUSATIVE'] = $value;
                    } elseif ($form->hasGrammems(array($type, 'ТВ'))) {
                        $word_forms['ABLATIVE'] = $value;
                    } elseif ($form->hasGrammems(array($type, 'ПР'))) {
                        $word_forms['PREPOSITIONAL'] = $value;
                    }
                }
            }
        }

        return $word_forms;
    }

    public function getFormsPhrase(array|string $arWords) {
        if(!is_array($arWords))
            $arWords = explode(',', $arWords);

        $phase_forms = array();
        foreach($arWords as $arWord){
            $item = trim($arWord);
            if(!$item)
                continue;

            if(stripos($item, " ") === false) {
                $forms = $this->getFormsWord($item);

                $phase_forms['GENITIVE'][]          = $forms['GENITIVE'];
                $phase_forms['DATIVE'][]            = $forms['DATIVE'];
                $phase_forms['ACCUSATIVE'][]        = $forms['ACCUSATIVE'];
                $phase_forms['ABLATIVE'][]          = $forms['ABLATIVE'];
                $phase_forms['PREPOSITIONAL'][]     = $forms['PREPOSITIONAL'];
            } else {
                $items = explode(' ', $item);
                $words = Array();

                foreach($items as $text){
                    $text = trim($text);
                    if(!$text)
                        continue;

                    $forms = $this->getFormsWord($text);

                    $words['GENITIVE'][]            = $forms['GENITIVE'];
                    $words['DATIVE'][]              = $forms['DATIVE'];
                    $words['ACCUSATIVE'][]          = $forms['ACCUSATIVE'];
                    $words['ABLATIVE'][]            = $forms['ABLATIVE'];
                    $words['PREPOSITIONAL'][]       = $forms['PREPOSITIONAL'];
                }
                foreach ($words as $key => $value) {
                    $phase_forms[$key][] = implode(" ", $words[$key]);
                }
            }
        }

        return $phase_forms;
    }
}