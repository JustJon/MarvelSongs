<?php
/**********************************************************************************

marvel.php
This class is for accessing the Marvel API - currently only getting character info
Copyright Jonathan Lazar 2015

**********************************************************************************/
class Marvel
{
	private $oauth_token;
	private $oauth_token_secret;

	//Constructor
	function __construct($consumertoken, $consumersecrettoken)
	{
		$this->oauth_token=$consumertoken;
		$this->oauth_token_secret=$consumersecrettoken;
	}

	//Destructor
	function __destruct()
	{
	}

	function getCharacter($name) {

		$ts=time();
		$key=$ts.$this->oauth_token_secret.$this->oauth_token;
		$md5key=md5($key);

		$params['name']=$name;
		$params['ts']=$ts;
		$params['apikey']=$this->oauth_token;
		$params['hash']=md5($ts.$this->oauth_token_secret.$this->oauth_token);

		$url = 'http://gateway.marvel.com:80/v1/public/characters';
		$url .= '?'.http_build_query($params);
		$url .= '&';

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$buffer=curl_exec($ch);
		curl_close($ch);

		$data = $this->processJson($buffer);

		if (empty($data['name'])) {
			$formatted='';
		} else {
                	$formatted = $this->formatData($data);
		}

                return $formatted;
	}

	private function processJson($buffer) {

		$chardata = json_decode($buffer, TRUE);
		//var_dump($chardata['data']);

		$data['id'] = $chardata['data']['results'][0]['id'];
		$data['name'] = $chardata['data']['results'][0]['name'];
		$data['img'] = $chardata['data']['results'][0]['thumbnail']['path'].'.'.$chardata['data']['results'][0]['thumbnail']['extension'];
		$data['desc'] = $chardata['data']['results'][0]['description'];
		$data['attrib'] = $chardata['attributionHTML'];

		return $data;
	}

        private function formatData($data) {

                $output = '<div id="bio">';

		$output .= '<span id="title">'.$data['name'].'</span>';
		$output .= '<br style="clear:left">';
		$output .= '<img src="'.$data['img'].'" id="img">';
		$output .= $data['desc'];
		$output .= '<br style="clear:both"><div id="attrib">'.$data['attrib'].'</div>';
                $output .= '</div>';

                return $output;
        }

}
