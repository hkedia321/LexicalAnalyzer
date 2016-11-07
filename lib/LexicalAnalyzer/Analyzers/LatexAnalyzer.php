<?php

namespace LexicalAnalyzer\Analyzers;

class LatexAnalyzer extends Analyzer
{
    public $tokenTypes = array(
        "T_LATEX_COMMAND" => array(
            "regex" => '/^\\\([^_$#%&][a-zA-Z0-9\._-]+)(({[^}]*})|(\[[^\]]*\]))*/s',
            "store" => true
            ),

        // "T_KEYWORD" => array(
        //     "regex" => '/^(int)|(double)|(return)|(goto)|(while)|(if)|(break)|(continue)|(public)|(private)|(float)|(class)/',
        //     "store" => true
        //     ),
        "T_INDENTIFIER" => array(
            "regex" => '/^[a-zA-ZÀ-ÿ][a-zA-Z0-9À-ÿ]*/',
            "store" => true
            ),

        "T_NUMBER" => array(
            "regex" => '/^[0-9]([0-9\.,]*[0-9])?/',
            "store" => true
            ),
        "T_ESCAPED" => array(
            "regex" => '/^\\\[_$#%&]/',
            "store" => true
            ),
        "T_WHITESPACE" => array(
            "regex" => '/^\s+/',
            "store" => true
            ),
        "T_COMMENT" => array(
            "regex" => '/^%[^\n]*\n/',
            "store" => true
            ),
        "T_PUNCTUATION" => array(
            "regex" => '/^[,\._!\?\(\)-:;\'"–<>|@\*\{\}$#%&=+\[\]`]+/',
            "store"=> true
            ),
        "T_EOF"=> array(
            "regex" => '/^$/',
            "store"=> true
            ),
        );
}
