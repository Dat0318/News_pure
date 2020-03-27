<?php 
	// Lop Session
	/**
	 * 
	 */
	class Session 
	{
		// Ham bat dau session
		public function start() {
			session_start();
		}

		// Ham luu session
		public function send($user) {
			$_SESSION['user'] = $user;
		}

		// Ham lay du lieu session
		public function get() {
			if (isset($_SESSION['user'])) {
				$user = $_SESSION['user'];
			}
			else {
				$user = '';
			}
			return $user;
		}

		// Ham xoa session
		public function destroy() {
			session_destroy();
		}
	}
?>