CREATE DATABASE texlyzer;
use texlyzer;

CREATE TABLE reports
(
    id                           INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    session_id                   VARCHAR(100),
    num_chars                    INT(30),
    num_words                    INT(30),
    num_sentences                INT(30),
    num_palindromes              INT(30),
    freq_chars                   TEXT,
    percentage_chars             TEXT,
    avg_word_length              TEXT,
    avg_num_of_words_in_sentence TEXT,
    top_10_mu_words              TEXT,
    top_10_longest_words         TEXT,
    top_10_shortest_words        TEXT,
    top_10_longest_sentences     TEXT,
    top_10_shortest_sentences    TEXT,
    top_10_longest_palindromes   TEXT,
    is_text_palindrome           TEXT,
    reversed_text                TEXT,
    reversed_with_order_intact   TEXT,
    hash_text                    TEXT,
    created_at                   TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
