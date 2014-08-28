<?php

/*
 * Graph API Explorer : https://developers.facebook.com/tools/explorer
 * API functions : https://developers.facebook.com/docs/graph-api/reference/v2.1/
 * Using the API : https://developers.facebook.com/docs/graph-api/using-graph-api/v2.1
*/

class Facebook
{
	private $access_token;
	private $locale;
	private static $base_url = 'https://graph.facebook.com/';


	/*
	 * TODO : make a simple test of access token validity
	 * TODO : check locale validity
	*/
	public function __construct($access_token, $locale = '')
	{
		$this->access_token = $access_token;
		$this->locale = $locale;
	}


	/*

	*/
	private function executeQuery($url)
	{
		if ($this->locale == '') {
			$ch = curl_init($url);
		}
		else {
			$ch = curl_init($url.'&locale='.$this->locale);
		}
		
		curl_setopt_array($ch, array(
			CURLOPT_RETURNTRANSFER=>true,
			CURLOPT_SSL_VERIFYHOST=>false,
			CURLOPT_SSL_VERIFYPEER=>false,
			CURLOPT_POST=>false
 		));

 		return json_decode(curl_exec($ch));
	}


	/*
	 * Search for pages regarding an expression
	*/
	public function searchForPages($expression)
	{
		$request = 'search';
		$param = '&q='.$expression.'&type=page';
		$fields = '&fields=category,name,id';
		$url = self::$base_url.$request.'?access_token='.$this->access_token.$param.$fields;

 		$result = $this->executeQuery($url);

 		return (is_null($result->data)) ? $result->error->message : $result->data;
	}


	/*
	 * Return posts, likes and comments of a page (ex : id page = 6483988719)
	*/
	public function getPosts($idPage)
	{
		$request = 'posts';
		$fields = '&fields=id,from,story,name,caption,type,status_type,object_id,created_time,updated_time,shares,likes,comments';
		$url = self::$base_url.$idPage.'/'.$request.'?access_token='.$this->access_token.$fields;

		$result = $this->executeQuery($url);

 		return (is_null($result->data)) ? $result->error->message : $result->data;
	}


	/*
	 * Return active users regarding likes & comments
	*/
	public function getActiveUsers($idPage)
	{
		// TODO
	}

}