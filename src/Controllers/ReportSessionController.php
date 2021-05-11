<?php

require_once dirname( __DIR__ ) . '/config.php';

class ReportSessionController {
	private $pdo;

	public function __construct( $pdo ) {
		$this->pdo = $pdo;
	}

	public function reports_by_session( $session_id ) {
		if ( $this->user_has_reports( $session_id ) ) {
			$stmt = $this->pdo->prepare( 'SELECT * FROM reports as r WHERE r.session_id=:session_id ORDER BY created_at DESC LIMIT 10;' );
			$stmt->execute(
				[
					'session_id' => $session_id,
				] );

			return $stmt->fetchAll();
		}

		return false;
	}

	private function user_has_reports( $session_id ) {
		$stmt = $this->pdo->prepare( 'SELECT session_id FROM reports;' );
		$stmt->execute();

		$results = $stmt->fetchAll();

		foreach ( $results as $result ) {
			if ( in_array( $session_id, $result ) ) {

				return true;
			}
		}

		return false;
	}
}

$reportSessionController = new ReportSessionController( $pdo );