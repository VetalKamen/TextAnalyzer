<?php
require_once dirname(dirname(dirname(__DIR__))) . '/Interfaces/ExportFile.php';

class XmlDownload implements ExportFile
{
    private $report;

    public function __construct( $report )
    {
        $this->report = $report;
    }

    public function export()
    {
        $output = fopen("php://output", "wb");
        header('Content-Type: text/xml; charset=utf-8');
        header('Content-Disposition: attachment; filename=result.xml');
        $text = '<root>';
        $text .= '<sessid>' . $this->report['session_id'] . '</sessid>';
        $text .= '<chars>' . $this->report['num_chars'] . '</chars>';
        $text .= '<words>' . $this->report['num_words'] . '</words>';
        $text .= '<sentences>' . $this->report['num_sentences'] . '</sentences>';
        $text .= '<frequencyChars>' . $this->report['freq_chars'] . '</frequencyChars>';
        $text .= '<percentageChars>' . $this->report['percentage_chars'] . '</percentageChars>';
        $text .= '<averageWordLength>' . $this->report['avg_word_length'] . '</averageWordLength>';
        $text .= '<averageNumWordsInSentence>' . $this->report['avg_num_of_words_in_sentence'] . '</averageNumWordsInSentence>';
        $text .= '<top10MostUsedWords>' . $this->report['top_10_mu_words'] . '</top10MostUsedWords>';
        $text .= '<top10LongestWords>' . $this->report['top_10_longest_words'] . '</top10LongestWords>';
        $text .= '<top10ShortestWords>' . $this->report['top_10_shortest_words'] . '</top10ShortestWords>';
        $text .= '<top10LongestSentences>' . $this->report['top_10_longest_sentences'] . '</top10LongestSentences>';
        $text .= '<top10ShortestSentences>' . $this->report['top_10_shortest_sentences'] . '</top10ShortestSentences>';
        $text .= '<numOfPalindromes>' . $this->report['num_palindromes'] . '</numOfPalindromes>';
        $text .= '<top10LongestPalindromes>' . $this->report['top_10_longest_palindromes'] . '</top10LongestPalindromes>';
        $text .= '<isTextPalindrome>' . $this->report['is_text_palindrome'] . '</isTextPalindrome>';
        $text .= '<reversedText>' . $this->report['reversed_text'] . '</reversedText>';
        $text .= '<reversedOrderIntact>' . $this->report['reversed_with_order_intact'] . '</reversedOrderIntact>';
        $text .= '<hash>' . $this->report['hash'] . '</hash>';
        $text .= '</root>';
        fputs($output, $text);
        fclose($output);
        exit();
    }
}
