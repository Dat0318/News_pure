<?php
	// Lop database
	/**
	 *
	 */
	class DB
	{
		// Cac bien thong tin ket noi
		private $hostname = 'localhost',
			$username = 'root',
			$password = '',
			$dbname = 'newspaper';

		// Bien luu tru khi ket noi
		public $cn = NULL;

		// Ham ket noi
		public function connect() {
			$this->cn = mysqli_connect($this->hostname, $this->username, $this->password, $this ->dbname);
		}

		// Ham ngat ket noi
		public function close() {
			if ($this->cn) {
				mysqli_close($this->cn);
			}
		}

		// Ham truy van
		public function query($sql = null) {
			if ($this->cn) {
				mysqli_query($this->cn, $sql);
			}
		}

		// Ham dem so hang
		public function num_rows($sql = null) {
			if ($this->cn) {
				$query = mysqli_query($this->cn, $sql);
				if ($query) {
					$row = mysqli_num_rows($query);
					return $row;
				}
			}
		}

		// Ham lay du lieu
		public function fetch_assoc($sql = null, $type) {
			if ($this->cn) {
				$query = mysqli_query($this->cn, $sql);
				if ($query) {
					if ($type == 0) {
						// Lay nhieu du lieu gan vao mang
						while ($row = mysqli_fetch_assoc($query)) {
							$data[] = $row;
						}
						return $data;
					}
					else if ($type ==1 ){
						// Lay mot hang du lieu gan vao bien
						$data = mysqli_fetch_assoc($query);
						return $data;
					}
				}
			}
		}

		// Ham lay ID cao nhat
		public function insert_id() {
			if ($this->cn) {
				$count = mysqli_insert_id($this->cn);
				if ($count == '0') {
					$count = '1';
				} else {
					$count = $count;
				}
				return $count;
			}
		}

		// Ham charset cho database
		public function set_char($uni) {
			if ($this->cn) {
				mysqli_set_charset($this->cn, $uni);
			}
		}

	}
?>
