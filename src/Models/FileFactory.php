<?php
require_once 'FileFormats/UploadFormats/HtmlUpload.php';
require_once 'FileFormats/UploadFormats/TxtUpload.php';
require_once 'FileFormats/UploadFormats/XmlUpload.php';

require_once 'FileFormats/DownloadFormats/CsvDownload.php';
require_once 'FileFormats/DownloadFormats/XmlDownload.php';
require_once 'FileFormats/DownloadFormats/XlsxDownload.php';

class FileFactory {

	public static function uploadFile( $file ) {
		$file_format = explode( '.', $file['name'] );
		switch ( $file_format[1] ) {
			case 'txt':
				$created_file = new TxtUpload( $file );
				break;
			case 'xml':
				$created_file = new XmlUpload( $file );
				break;
			case 'html':
				$created_file = new HtmlUpload( $file );
				break;
			default:
				echo 'Incorrect Upload Format';
				break;
		}

		return $created_file;
	}

	public static function downloadFile( $report, $format ) {
		switch ( $format ) {
			case 'csv':
				$file_for_export = new CsvDownload( $report );
				break;
			case 'xml':
				$file_for_export = new XmlDownload( $report );
				break;
			case 'xlsx':
				$file_for_export = new XlsxDownload( $report );
				break;
			default:
				echo 'Incorrect Download Format';
				break;
		}

		return $file_for_export;
	}
}