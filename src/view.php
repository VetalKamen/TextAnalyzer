<?php

require_once 'Models/FileFormats/UploadFormats/XmlUpload.php';
require_once 'Models/FileFormats/UploadFormats/HtmlUpload.php';
require_once 'Models/FileFormats/UploadFormats/TxtUpload.php';

require_once 'Models/FileFormats/DownloadFormats/CsvDownload.php';
require_once 'Models/FileFormats/DownloadFormats/XmlDownload.php';
require_once 'Models/FileFormats/DownloadFormats/XlsxDownload.php';

require_once 'Models/TextComponents/Palindrome.php';
require_once 'Models/TextComponents/Word.php';
require_once 'Models/TextComponents/Char.php';
require_once 'Models/TextComponents/Sentence.php';

require_once 'Models/Report.php';
require_once 'Models/FileFactory.php';
require_once 'Models/Text.php';

require_once 'helper_functions.php';

require_once 'Controllers/ReportController.php';
session_start();

$default_text      = '';
$text              = '';
$num_of_chars      = '';
$num_of_words      = '';
$num_of_sentences  = '';
$num_of_palindrome = '';
$hash              = '';
if (! empty($_POST['input_text']) ) {
    $valid_text = $_POST['input_text'];

    /**
     *  Check if input is valid url and sending GET request if success.
     */
    if (filter_var($valid_text, FILTER_VALIDATE_URL) ) {
        $curlSession = curl_init();
        curl_setopt($curlSession, CURLOPT_URL, $valid_text);
        curl_setopt($curlSession, CURLOPT_HTTPHEADER, [ 'Content-Type:application/json' ]);
        curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

        $curl_data = curl_exec($curlSession);

        $valid_text = strip_tags($curl_data);
        curl_close($curlSession);
    }

    $start = microtime(true);
    $text  = new Text($valid_text);
    $hash  = generate_hash($text->get_text());
} elseif (empty($_POST['input_text']) && ! empty($_FILES['userfile']) ) {
    $start = microtime(true);
    $file  = FileFactory::uploadFile($_FILES['userfile']);
    $text  = new Text($file->__toString());
    $hash  = generate_hash($text->get_text());
}
if ($reportController->is_analyzed($hash) ) {
    $report->data['report'] = $reportController->get_report_by_hash($hash);
} elseif (! empty($hash) ) {
    $word       = new Word($text);
    $char       = new Char($text);
    $sentence   = new Sentence($text);
    $palindrome = new Palindrome($word);
    $report     = new Report(session_id(), $text, $word, $char, $sentence, $palindrome, $hash);
    $reportController->save_report($report->data['report']);
}

if (isset($_POST["hash_text"]) && isset($_POST['export_format']) ) {
    $report_to_download = $reportController->get_report_by_hash($_POST["hash_text"]);
    $file_for_export    = FileFactory::downloadFile($report_to_download, $_POST['export_format']);
    $file_for_export->export();
}
?>
<!DOCTYPE>
<html lang="en">
<head>
    <title>Text Analyzer</title>
</head>
<body>

<div>
    <h2>Hit the text!</h2>
    <br>
    <div>
        <form action="view.php" method="post">
            <input type="text" name="input_text">
            <input type="submit" value="Analyze">
        </form>
    </div>
    For files:
    <div>
        <form enctype="multipart/form-data" method="post">
            <input type="hidden" name="MAX_FILE_SIZE" value="30000"/>
            Send your file: <input name="userfile" type="file"/>
            <input type="submit" value="Send for analyze"/>
        </form>
    </div>
    <div>
        Export result as :
        <form class="form-horizontal" action="view.php" method="post"
              enctype="multipart/form-data">
            <div class="form-group">
                <div class="col-md-4 col-md-offset-4">
                    <input type="text" name="hash_text" hidden
                           value="<?php echo $report->data['report']['hash_text']; ?>">
                    <select name="export_format">
                        <option value="csv">csv</option>
                        <option value="xml">xml</option>
                        <option value="xlsx">xlsx</option>
                    </select>
                    <input type="submit" class="btn btn-success" value="Export"/>
                </div>
            </div>
        </form>
    </div>
    <br>
</div>
<?php if (! empty($text) ) : ?>
    <div>
        <p>Number of chars: <?php echo $report->data['report']['num_chars']; ?></p>
        <p>Number of words: <?php echo $report->data['report']['num_words']; ?></p>
        <p>Number of sentences: <?php echo $report->data['report']['num_sentences']; ?></p>
        <p>Frequency of chars: <?php echo "<br>" . $report->data['report']['freq_chars']; ?></p>
        <p>Distribution of characters as a percentage of
            total: <?php echo "<br>" . $report->data['report']['percentage_chars']; ?></p>
        <p>Average word length: <?php echo $report->data['report']['avg_word_length']; ?></p>
        <p>The average number of words in a
            sentence: <?php echo $report->data['report']['avg_num_of_words_in_sentence']; ?></p>
        <p>Top 10 most used words: <?php echo "<br>" . $report->data['report']['top_10_mu_words']; ?></p>
        <p>Top 10 longest words: <?php echo "<br>" . $report->data['report']['top_10_longest_words']; ?></p>
        <p>Top 10 shortest words: <?php echo "<br>" . $report->data['report']['top_10_shortest_words']; ?></p>
        <p>Top 10 longest sentences: <?php echo "<br>" . $report->data['report']['top_10_longest_sentences']; ?></p>
        <p>Top 10 shortest
            sentences: <?php echo $report->data['report']['top_10_shortest_sentences']; ?></p>
        <p>Number of palindrome words: <?php echo $report->data['report']['num_palindromes']; ?></p>
        <p>Top 10 longest palindrome
            words: <?php echo "<br>" . $report->data['report']['top_10_longest_palindromes']; ?></p>
        <p>Is the whole text a palindrome? (Without whitespaces and punctuation marks):
    <?php echo $report->data['report']['is_text_palindrome']; ?>
        </p>
    <?php
    $end       = microtime(true);
    $exec_time = $end - $start;
    ?>
        <p>The time it took to process the text in ms: <?php echo $exec_time; ?></p>
        <p>The reversed text: <?php echo $report->data['report']['reversed_text']; ?></p>
        <p>Report has been generated at: <?php echo date("Y-m-d H:i:s"); ?></p>
        <p>The reversed text but the character order in words kept
            intact: <?php echo $report->data['report']['reversed_with_order_intact']; ?></p>
        <p>Text hash: <?php echo $report->data['report']['hash_text']; ?></p>

    </div>
<?php endif; ?>
</body>
</html>
