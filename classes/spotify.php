<?php
/**********************************************************************************

spotify.php
This class is used for accessing teh Spotify API
Copyright Jonathan Lazar 2015

**********************************************************************************/
class Spotify
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

	function getSongs($name) {

		$params['q']=$name;
		$params['type']='track';

		$url = 'https://api.spotify.com/v1/search';
		$url .= '?'.http_build_query($params);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$buffer=curl_exec($ch);
		curl_close($ch);		

		$data = $this->processJson($buffer);
		$formatted = $this->formatData($data);

		return $formatted;
	}


        private function processJson($buffer) {

		$i = 0;
                $searchdata = json_decode($buffer, TRUE);
                //print_r($searchdata);
		foreach ($searchdata['tracks']['items'] as $curtrack) {
			$track[$i]['id'] = $curtrack['album']['id'];
			$track[$i]['ext_url'] = $curtrack['external_urls']['spotify'];
			$track[$i]['href'] = $curtrack['href'];
			$track[$i]['img'] = $curtrack['album']['images'][2]['url'];
			$track[$i]['name'] = $curtrack['name'];
			$track[$i]['uri'] = $curtrack['album']['uri'];
			$track[$i]['artist'] = $curtrack['artists'][0]['name'];
			$track[$i]['artist_url'] = $curtrack['artists'][0]['external_urls']['spotify'];
			$i++;
		}
                return $track;
        }

	private function formatData($data) {

		$output = '<div id="song">';

		foreach ($data as $curdata) {
			$output .= '<div id="track">';
			$output .= '<img src="'.$curdata['img'].'" class="songimg">';
			$output .= '<a target="_blank" href="'.$curdata['ext_url'].'">'.$curdata['name'].'<BR><a target="_blank" href="'.$curdata['artist_url'].'">'.$curdata['artist'].'</a>';
			$output .= '</div>';

		}
		$output .= '</div>';

		return $output;
	}

}
