<?php

class TxtUpload
{
    protected $file;

    public function __construct( $file )
    {
        $this->file = $file;
    }

    public function __toString(): string
    {
        return file_get_contents($this->file['tmp_name']);
    }
}
