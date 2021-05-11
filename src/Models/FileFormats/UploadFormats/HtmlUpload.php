<?php

class HtmlUpload {
	protected $file;

	public function __construct( $file ) {
		$this->file = $file;
	}

	public function __toString(): string {
		$content = file_get_contents( $this->file['tmp_name'] );

		return strip_tags( $content );
	}
}