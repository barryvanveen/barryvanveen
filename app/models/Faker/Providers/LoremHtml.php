<?php namespace Barryvanveen\Faker\Providers;

use Faker\Provider\Lorem;

// todo: add phpDocs for all functions
// todo: add tests for all functions?
// todo: make pull request to faker?
class LoremHtml extends Lorem
{
    public function htmlText($nbParagraphs = 5)
    {
        $paragraphs = self::htmlParagraphs($nbParagraphs);

        $chances = [
            0 => 0.1,
            1 => 0.2,
            2 => 0.25,
            3 => 0.30,
            4 => 0.35,
        ];

        $insertions = [
            0 => 'htmlHeading',
            1 => 'htmlList',
            2 => 'htmlBlockquote',
            3 => 'htmlCode',
            4 => 'htmlPre',
        ];

        foreach ($paragraphs as $paragraphKey => $paragraph) {
            $rand      = $this->randomFloat(null, 0, 1);
            $insertKey = false;

            // do we want insert an html element
            foreach ($chances as $chanceKey => $chance) {
                if ($rand <= $chance) {
                    $insertKey = $chanceKey;
                    break;
                }
            }

            // no, we dont want to insert this time
            if ($insertKey === false) {
                continue;
            }

            // yes, we want to insert, call the function
            $paragraphs[] = call_user_func([$this, $insertions[$insertKey]]);
        }

        // todo: use shuffle to re-order paragraphs?

        return implode(' ', $paragraphs);
    }

    public static function htmlParagraphs($nbParagraphs = 3, $variableNbParagraphs = true)
    {
        if ($nbParagraphs <= 0) {
            return '';
        }
        if ($variableNbParagraphs) {
            $nbParagraphs = self::randomizeNbElements($nbParagraphs);
        }

        $paragraphs = [];
        for ($i = 0; $i < $nbParagraphs; $i++) {
            $paragraphs [] = static::htmlParagraph();
        }

        return $paragraphs;
    }

    public static function htmlParagraph($nbSentences = 3, $variableNbSentences = true)
    {
        if ($nbSentences <= 0) {
            return '';
        }
        if ($variableNbSentences) {
            $nbSentences = self::randomizeNbElements($nbSentences);
        }

        return '<p>'.implode(static::sentences($nbSentences), ' ').'</p>';
    }

    public static function htmlHeading($headingSize = 2)
    {
        if (!is_integer($headingSize) || $headingSize < 1 || $headingSize > 6) {
            return '';
        }

        return '<h'.$headingSize.'>'.static::sentence().'</h'.$headingSize.'>';
    }

    public static function htmlList($nbItems = 3, $orderedList = false, $variableNbItems = true)
    {
        if ($nbItems <= 0) {
            return '';
        }
        if ($variableNbItems) {
            $nbItems = self::randomizeNbElements($nbItems);
        }

        $items = '';
        for ($i = 0; $i < $nbItems; $i++) {
            $items .= '<li>'.static::sentence().'</li>';
        }

        if ($orderedList) {
            return '<ol>'.$items.'</ol>';
        }

        return '<ul>'.$items.'</ul>';
    }

    public static function htmlBlockquote()
    {
        $quote = static::sentence();
        if (mt_rand(0, 1)) {
            // todo: substitute with generate first- and lastname
            $quote .= '<footer>Firstname Lastname</footer>';
        }

        return '<blockquote>'.$quote.'</blockquote>';
    }

    public static function htmlCode()
    {
        return '<code>'.implode(' ', static::sentences()).'</code>';
    }

    public static function htmlPre()
    {
        return '<pre>'.implode(' ', static::sentences()).'</pre>';
    }
}
