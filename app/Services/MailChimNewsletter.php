<?php

	namespace App\Services;

	use MailchimpMarketing\ApiClient;

	class MailChimNewsletter implements Newsletter
	{
		protected $client;
		public function __construct($client)
		{
			$this->client = $client;
		}
		public function subscribe($email, $list=null)
		{
			$list ??= config('services.mailchimp.lists.subscribes');
			return $this->client->lists->addListMember($list,[
				'email_address'=>$email,
				'status'=>'subscribed'
			]);
		}
	}

?>