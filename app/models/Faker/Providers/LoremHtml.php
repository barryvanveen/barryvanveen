<?php
namespace Barryvanveen\Faker\Providers;

use Faker\Provider\Lorem;

// todo: add tests for all functions?
// todo: make pull request to faker?
class LoremHtml extends Lorem
{
    /**
     * insertions with their probabilities.
     *
     * @var array
     */
    protected $insertions = [
        0 => [
            'probability' => 0.35,
            'callback'    => 'htmlHeading',
        ],
        1 => [
            'probability' => 0.70,
            'callback'    => 'htmlList',
        ],
        2 => [
            'probability' => 0.82,
            'callback'    => 'htmlBlockquote',
        ],
        3 => [
            'probability' => 0.94,
            'callback'    => 'htmlCode',
        ],
        4 => [
            'probability' => 1.00,
            'callback'    => 'htmlPre',
        ],
    ];

    /**
     * Set your own insertions:
     *   For each html-element that you want to have inserted, give its probability and callback function
     *   Probabilities should be filled cumulative and up to 1.0.
     *
     * @param array $newInsertions
     */
    public function setInsertions(Array $newInsertions)
    {
        $this->insertions = $newInsertions;
    }

    /**
     * Generate a text with html-elements. You can influence the generated html with the setInsertions-method.
     *
     * @param int $nbParagraphs number of plain html-paragraphs
     * @param int $nbInsertions number of other html-elements to be inserted
     *
     * @return string
     */
    public function htmlText($nbParagraphs = 8, $nbInsertions = 4)
    {
        $paragraphs = self::htmlParagraphs($nbParagraphs);

        // add $nbParagraphs other html elements
        for ($i = 0; $i < $nbInsertions; $i++) {
            $rand = $this->randomFloat(null, 0, 1);

            // add a html-element using Roulette Wheel Selection
            foreach ($this->insertions as $insertion) {
                if ($rand <= $insertion['probability']) {
                    $paragraphs[] = call_user_func([$this, $insertion['callback']]);
                    break;
                }
            }
        }

        shuffle($paragraphs);

        return implode(' ', $paragraphs);
    }

    /**
     * Generate html paragraphs.
     *
     * @example array('<p>Lorem ipsum</p>', '<p>Dolores delectus</p>')
     *
     * @param int  $nbParagraphs
     * @param bool $variableNbParagraphs
     * @param bool $asText
     *
     * @return array|string
     */
    public static function htmlParagraphs($nbParagraphs = 3, $variableNbParagraphs = true, $asText = false)
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

        return $asText ? implode("\n\n", $paragraphs) : $paragraphs;
    }

    /**
     * Generate a single html paragraph.
     *
     * @example '<p>Lorem ipsum</p>'
     *
     * @param int  $nbSentences
     * @param bool $variableNbSentences
     *
     * @return string
     */
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

    /**
     * Generate an heading tag containing a sentence.
     *
     * @example '<h2>Lorem ipsum</h2>'
     *
     * @param int $headingSize
     *
     * @return string
     */
    public static function htmlHeading($headingSize = 2)
    {
        if (!is_integer($headingSize) || $headingSize < 1 || $headingSize > 6) {
            return '';
        }

        return '<h'.$headingSize.'>'.static::sentence().'</h'.$headingSize.'>';
    }

    /**
     * Generate an ordered or unordered list of sentences.
     *
     * @example '<ul><li>Lorem ipsum</li><li>Lorem ipsum</li></ul>'
     *
     * @param int  $nbItems
     * @param bool $variableNbItems
     *
     * @return string
     */
    public static function htmlList($nbItems = 3, $variableNbItems = true)
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

        if (self::randomFloat(null, 0, 1) <= 0.5) {
            return '<ol>'.$items.'</ol>';
        }

        return '<ul>'.$items.'</ul>';
    }

    /**
     * Generate a blockquote containing a sentence and possible an author (Bootstrap-style).
     *
     * @example '<blockquote>Lorem ipsum<footer>Cicero</footer>'
     *
     * @return string
     */
    public static function htmlBlockquote()
    {
        $quote = static::sentence();
        if (self::randomFloat(null, 0, 1) <= 0.5) {
            $quote .= '<footer>'.self::words(2, true).'</footer>';
        }

        return '<blockquote>'.$quote.'</blockquote>';
    }

    /**
     * Generate a code tag containing some sentences.
     *
     * @example '<code>Lorem ipsum</code>'
     *
     * @return string
     */
    public static function htmlCode()
    {
        return '<code>'.implode(' ', static::sentences()).'</code>';
    }

    /**
     * Generate html pre-tag containing some sentences.
     *
     * @example '<pre>Lorem ipsum</pre>'
     *
     * @return string
     */
    public static function htmlPre()
    {
        return '<pre>'.implode(' ', static::sentences()).'</pre>';
    }
}
