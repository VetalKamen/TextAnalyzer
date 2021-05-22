<?php

class XmlUpload
{
    protected $file;

    public function __construct( $file )
    {
        $this->file = $file;
    }

    public function __toString(): string
    {
        $xml
            = json_decode(
                json_encode(
                    simplexml_load_string(
                        file_get_contents($this->file['tmp_name'])
                    )
                ), true
            );
        $plain_text = '';

        array_walk_recursive(
            $xml,
            function ( $item, $key ) use ( &$plain_text ) {
                return $plain_text .= $item;
            }
        );

        return $plain_text ?? '';
    }
}
