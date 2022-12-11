<?php
	
	namespace App\Services;

	interface Newsletter
	{
		public function subscribe($email, $list=null);
	}


?>