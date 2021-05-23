<?php
require_once 'Controllers/ReportController.php';
require_once 'Controllers/ReportSessionController.php';
require_once 'helper_functions.php';
session_start();

if (! empty($_POST['date_from']) && ! empty($_POST['date_to']) ) {
    $date_from   = $_POST['date_from'];
    $date_to     = $_POST['date_to'];
    $all_reports = $reportController->all_reports_for_timeframe($date_from, $date_to);
} else {
    $all_reports = $reportController->all_reports();
}

$all_rep_count                                = count($all_reports);
$sum_all_data['number_chars']                 = 0;
$sum_all_data['number_words']                 = 0;
$sum_all_data['number_sentences']             = 0;
$sum_all_data['number_palindromes']           = 0;
$sum_all_data['avg_word_length']              = 0;
$sum_all_data['avg_num_of_words_in_sentence'] = 0;

foreach ( $all_reports as $report ) {
    $sum_all_data['number_chars']                 += $report['num_chars'];
    $sum_all_data['number_words']                 += $report['num_words'];
    $sum_all_data['number_sentences']             += $report['num_sentences'];
    $sum_all_data['number_palindromes']           += $report['num_palindromes'];
    $sum_all_data['avg_word_length']              += $report['avg_word_length'];
    $sum_all_data['avg_num_of_words_in_sentence'] += $report['avg_num_of_words_in_sentence'];
}

$last_10_results = $reportSessionController->reports_by_session(session_id());
?>
<!DOCTYPE>
<html lang="en">
<head>
    <title>Text Analyzer</title>
</head>
<body>

<div>
    <h1>STATISTICAL INFO OF ALL REPORTS:</h1>
    Number of text submitted: <?php echo $all_rep_count; ?><br>
    Average Number of Chars:<?php echo average($sum_all_data['number_chars'], $all_rep_count); ?><br>
    Average Number of Words:<?php echo average($sum_all_data['number_words'], $all_rep_count); ?><br>
    Average Number of Sentences:<?php echo average($sum_all_data['number_sentences'], $all_rep_count); ?><br>
    Average Number of Palindromes:<?php echo average($sum_all_data['number_palindromes'], $all_rep_count); ?><br>
    Average Word Length:<?php echo average($sum_all_data['avg_word_length'], $all_rep_count); ?><br>
    Average Number of Words in Sentence:<?php echo average(
        $sum_all_data['avg_num_of_words_in_sentence'],
        $all_rep_count
    ); ?>
</div>
<div>
    <h3>Filter by Date:</h3>
    <form action="global_stat_view.php" method="post">
        From: <input type="text" name="date_from">
        To: <input type="text" name="date_to">
        <input type="submit" value="Filter">
    </form>
    Example:<br>
    From: 2021-05-10 20:13:50<br>
    To: 2021-05-10 23:53:45
</div>

<div>
    <h2>Your last 10 results:</h2>
    <?php if (! empty($last_10_results) ) : $count = 1; ?>
        <?php foreach ( $last_10_results as $report ): ?>
            <div>
                <strong><?php echo 'TEXT #' . $count; ?></strong>
                <p>Number of chars: <?php echo $report['num_chars']; ?></p>
                <p>Number of words: <?php echo $report['num_words']; ?></p>
                <p>Number of sentences: <?php echo $report['num_sentences']; ?></p>
                <p>Frequency of chars: <?php echo "<br>" . $report['freq_chars']; ?></p>
                <p>Distribution of characters as a percentage of
                    total: <?php echo "<br>" . $report['percentage_chars']; ?></p>
                <p>Average word length: <?php echo $report['avg_word_length']; ?></p>
                <p>The average number of words in a
                    sentence: <?php echo $report['avg_num_of_words_in_sentence']; ?></p>
                <p>Top 10 most used words: <?php echo "<br>" . $report['top_10_mu_words']; ?></p>
                <p>Top 10 longest words: <?php echo "<br>" . $report['top_10_longest_words']; ?></p>
                <p>Top 10 shortest words: <?php echo "<br>" . $report['top_10_shortest_words']; ?></p>
                <p>Top 10 longest sentences: <?php echo "<br>" . $report['top_10_longest_sentences']; ?></p>
                <p>Top 10 shortest
                    sentences: <?php echo $report['top_10_shortest_sentences']; ?></p>
                <p>Number of palindrome words: <?php echo $report['num_palindromes']; ?></p>
                <p>Top 10 longest palindrome
                    words: <?php echo "<br>" . $report['top_10_longest_palindromes']; ?></p>
                <p>Is the whole text a palindrome? (Without whitespaces and punctuation marks):
            <?php echo $report['is_text_palindrome']; ?>
                </p>
                <p>The reversed text: <?php echo $report['reversed_text']; ?></p>
                <p>Report has been generated at: <?php echo $report['created_at']; ?></p>
                <p>The reversed text but the character order in words kept
                    intact: <?php echo $report['reversed_with_order_intact']; ?></p>
                <p>Text hash: <?php echo $report['hash_text'];
                $count ++ ?></p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
