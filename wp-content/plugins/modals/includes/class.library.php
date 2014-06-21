<?php

class moLibrary {

	public function isSiteAdmin() {

		$currentUser = wp_get_current_user();
		return in_array('administrator', $currentUser->roles);

	}


}

?>
