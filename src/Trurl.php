<?php

namespace Devoleg;

class Trurl
{
    protected static $al = [
        'ru' => [
            'а' => 'a',   'б' => 'b',   'в' => 'v',
            'г' => 'g',   'д' => 'd',   'е' => 'e',
            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
            'и' => 'i',   'й' => 'y',   'к' => 'k',
            'л' => 'l',   'м' => 'm',   'н' => 'n',
            'о' => 'o',   'п' => 'p',   'р' => 'r',
            'с' => 's',   'т' => 't',   'у' => 'u',
            'ф' => 'f',   'х' => 'h',   'ц' => 'c',
            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

            'А' => 'A',   'Б' => 'B',   'В' => 'V',
            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
            'И' => 'I',   'Й' => 'Y',   'К' => 'K',
            'Л' => 'L',   'М' => 'M',   'Н' => 'N',
            'О' => 'O',   'П' => 'P',   'Р' => 'R',
            'С' => 'S',   'Т' => 'T',   'У' => 'U',
            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        ]
    ];
    protected static $url_rep = [
        'ru' => [
            '&' => '-i-',
        ],
        'en' => [
            '&' => '-and-',
        ],
    ];

    public static function translit($string, $locale = 'ru')
    {
        if (isset(Trurl::$al[$locale])) {
            $string = strtr($string, Trurl::$al[$locale]);
        }
        return $string;
    }

    public static function url($string, $change_case = true, $locale = 'ru')
    {
        $string = Trurl::translit($string);
        if (isset(Trurl::$url_rep[$locale])) {
            $string = strtr($string, Trurl::$url_rep[$locale]);
        }
        if ($change_case) $string = mb_convert_case($string, MB_CASE_LOWER);
        $string = preg_replace('#[^0-9a-zA-Z\-]#', '-', $string);
        $string = preg_replace('#-{2,}#', '-', $string);
        if (substr($string, 0, 1) == '-') $string = substr($string, 1);
        if (substr($string, -1) == '-') $string = substr($string, 0, -1);
        return $string;
    }
}

?>