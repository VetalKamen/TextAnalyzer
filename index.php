<?php
require_once 'Text.php';
require_once 'TextComponents/Palindrome.php';
require_once 'TextComponents/Word.php';
require_once 'TextComponents/Char.php';
require_once 'TextComponents/Sentence.php';
require_once 'helper_functions.php';

$default_text      = '';
$text              = '';
$num_of_chars      = '';
$num_of_words      = '';
$num_of_sentences  = '';
$num_of_palindrome = '';
if ( ! empty( $_POST['inputValue'] ) ) {
	$start             = microtime( true );
	$text              = new Text( $_POST['inputValue'] );
	$word              = new Word( $text );
	$char              = new Char( $text );
	$sentence          = new Sentence( $text );
	$palindrome        = new Palindrome( $word );
	$num_of_chars      = $char->get_count();
	$num_of_words      = $word->get_count();
	$num_of_sentences  = $sentence->get_count();
	$num_of_palindrome = $palindrome->get_count();
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
    <form action="index.php" method="post">
        <p><input type="text" name="inputValue"></p>
        <input type="submit" value="Analyze">
    </form>
    <br>
</div>
<?php if ( ! empty( $text ) ): ?>
    <div>
        <p>Number of chars: <?php echo $num_of_chars; ?></p>
        <p>Number of words: <?php echo $num_of_words; ?></p>
        <p>Number of sentences: <?php echo $num_of_sentences; ?></p>
        <p>Frequency of chars: <?php echo "<br>" . $char->frequency(); ?></p>
        <p>Distribution of characters as a percentage of
            total: <?php echo "<br>" . $char->frequency_in_percentage(); ?></p>
        <p>Average word length: <?php echo average( $num_of_chars, $num_of_words ); ?></p>
        <p>The average number of words in a
            sentence: <?php echo average( $num_of_words, $num_of_sentences ); ?></p>
        <p>Top 10 most used words: <?php echo "<br>" . $word->most_used(); ?></p>
        <p>Top 10 longest words: <?php echo "<br>" . $word->sort_by_length( 'longest' ); ?></p>
        <p>Top 10 shortest words: <?php echo "<br>" . $word->sort_by_length( 'shortest' ); ?></p>
        <p>Top 10 longest sentences: <?php echo "<br>" . $sentence->sort_by_length( 'longest' ); ?></p>
        <p>Top 10 shortest
            sentences: <?php echo $sentence->sort_by_length( 'shortest' ); ?></p>
        <p>Number of palindrome words: <?php echo $num_of_palindrome; ?></p>
        <p>Top 10 longest palindrome
            words: <?php echo "<br>" . $palindrome->sort_by_length( 'longest' ); ?></p>
        <p>Is the whole text a palindrome? (Without whitespaces and punctuation marks):
			<?php echo $palindrome->get_count() == $word->get_count() ? 'True' : 'False'; ?>
        </p>
		<?php
		$end       = microtime( true );
		$exec_time = $end - $start;
		?>
        <p>The time it took to process the text in ms: <?php echo $exec_time; ?></p>
        <p>The reversed text: <?php echo mb_strrev( $text->get_text() ); ?></p>
        <p>Report has been generated at: <?php echo date( "Y-m-d H:i:s" ); ?></p>
        <p>The reversed text but the character order in words kept
            intact: <?php echo reverse_default( $text->get_text() ); ?></p>

    </div>
<?php endif; ?>
</body>
</html>