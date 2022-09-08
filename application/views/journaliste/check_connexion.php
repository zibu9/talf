<?php
	if(!isset($_SESSION['id'], $_SESSION['username'], $_SESSION['usertype'])) {
		redirect('journaliste/login_page');
	}elseif ( $_SESSION['usertype']!='journaliste') {
		redirect('admin/index');
	}
?>
