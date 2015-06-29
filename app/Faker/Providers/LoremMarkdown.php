<?php
namespace Barryvanveen\Faker\Providers;

use Faker\Provider\Lorem;

// todo: add tests for all functions?
// todo: make pull request to faker?
class LoremMarkdown extends Lorem
{
    /**
     * insertions with their probabilities.
     *
     * @var array
     */
    protected $insertions = [
        0 => [
            'probability' => 0.35,
            'callback'    => 'markdownHeading',
        ],
        1 => [
            'probability' => 0.70,
            'callback'    => 'markdownList',
        ],
        2 => [
            'probability' => 0.80,
            'callback'    => 'markdownBlockquote',
        ],
        3 => [
            'probability' => 0.90,
            'callback'    => 'markdownPre',
        ],
        4 => [
            'probability' => 1.00,
            'callback'    => 'markdownCode',
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
     * Generate a text with markdown styling elements.
     * You can influence the generated markdown with the setInsertions-method.
     *
     * @param int $nbParagraphs number of plain paragraphs
     * @param int $nbInsertions number of other styled elements to be inserted
     *
     * @return string
     */
    public function markdownText($nbParagraphs = 8, $nbInsertions = 4)
    {
        $paragraphs = self::markdownParagraphs($nbParagraphs);

        // add $nbParagraphs styled elements
        for ($i = 0; $i < $nbInsertions; $i++) {
            $rand = $this->randomFloat(null, 0, 1);

            // add a markdown-element using Roulette Wheel Selection
            foreach ($this->insertions as $insertion) {
                if ($rand <= $insertion['probability']) {
                    $paragraphs[] = call_user_func([$this, $insertion['callback']]);
                    break;
                }
            }
        }

        shuffle($paragraphs);

        return implode("\n\n", $paragraphs);
    }

    /**
     * Generate paragraphs.
     *
     * @example array('Lorem ipsum', 'Dolores delectus')
     *
     * @param int  $nbParagraphs
     * @param bool $variableNbParagraphs
     * @param bool $asText
     *
     * @return array|string
     */
    public static function markdownParagraphs($nbParagraphs = 3, $variableNbParagraphs = true, $asText = false)
    {
        if ($nbParagraphs <= 0) {
            return '';
        }
        if ($variableNbParagraphs) {
            $nbParagraphs = self::randomizeNbElements($nbParagraphs);
        }

        $paragraphs = [];
        for ($i = 0; $i < $nbParagraphs; $i++) {
            $paragraphs [] = static::markdownParagraph();
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
    public static function markdownParagraph($nbSentences = 3, $variableNbSentences = true)
    {
        if ($nbSentences <= 0) {
            return '';
        }
        if ($variableNbSentences) {
            $nbSentences = self::randomizeNbElements($nbSentences);
        }

        return implode(static::sentences($nbSentences), ' ');
    }

    /**
     * Generate an heading tag containing a sentence.
     *
     * @example '##Lorem ipsum'
     *
     * @param int $headingSize
     *
     * @return string
     */
    public static function markdownHeading($headingSize = 2)
    {
        if (!is_integer($headingSize) || $headingSize < 1 || $headingSize > 6) {
            return '';
        }

        return str_repeat('#', $headingSize).static::sentence();
    }

    /**
     * Generate an ordered or unordered list of sentences.
     *
     * @example '* Lorem ipsum
     *           * Lorem ipsum
     *           * Lorem ipsum'
     *
     * @param int  $nbItems
     * @param bool $variableNbItems
     *
     * @return string
     */
    public static function markdownList($nbItems = 3, $variableNbItems = true)
    {
        if ($nbItems <= 0) {
            return '';
        }
        if ($variableNbItems) {
            $nbItems = self::randomizeNbElements($nbItems);
        }

        $listItemPrefix = '* '; // unordered list prefix
        if (self::randomFloat(null, 0, 1) <= 0.5) {
            $listItemPrefix = '1. '; // ordered list prefix
        }

        $items = [];
        for ($i = 0; $i < $nbItems; $i++) {
            $items[] = $listItemPrefix.static::sentence();
        }

        return implode("\n", $items);
    }

    /**
     * Generate a blockquote containing a sentence and possibly an author (Bootstrap-style).
     *
     * @example '> Lorem ipsum
     *           > <footer>Author of this quote</footer>'
     *
     * @return string
     */
    public static function markdownBlockquote()
    {
        $quote = '> '.static::sentence()."\n";

        if (self::randomFloat(null, 0, 1) <= 0.5) {
            $quote .= "\n> \\- *".self::words(2, true).'*';
        }

        return $quote;
    }

    /**
     * Generate a syntax highlighted text some sentences.
     *
     * @example '    Lorem ipsum
     *               Lorel ipsum'
     *
     * @return string
     */
    public static function markdownCode()
    {
        $items = [
            '```php',
            '$foo = 1;',
            '$bar = 2;',
            '$baz = $foo + $bar;',
            '',
            '// do some logic',
            'if ($foo >= $bar) {',
            '   $baz++;',
            '}',
            '',
            'return $baz;',
            '```',
        ];

        return implode("\n", $items);
    }

    /**
     * Generate a preformatted text containing some sentences.
     *
     * @example '    Lorem ipsum
     *               Lorel ipsum'
     *
     * @return string
     */
    public static function markdownPre()
    {
        $items = static::sentences(self::randomizeNbElements(2));

        return "```\n".implode("\n", $items)."\n```";
    }
}
