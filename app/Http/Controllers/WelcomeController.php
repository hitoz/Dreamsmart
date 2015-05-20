<?php namespace App\Http\Controllers;

use Session;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */

	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	private function getAuth() {
		$auth_config = array(
		    'client_id'         => '1f2482626a8945e6904891bca67d25d1',
		    'client_secret'     => '32a87295edd7421e94225d066a6a7955',
		    'redirect_uri'      => 'http://localhost:81/github/dreamsmart/public/storing',
		    'scope'             => array( 'likes', 'comments', 'relationships' )
		);
		$auth = new \Instagram\Auth($auth_config);
		return $auth;
	}

	public function index()
	{
		$auth = $this->getAuth();
		$auth->authorize();		
	}

	public function storeAccessToken()
	{
		$auth = $this->getAuth();
		Session::put('instagram_access_token', $auth->getAccessToken($_GET['code']));
		return redirect('list');
	}

	public function getList($tagFilter = '') {
		$instagram = new \Instagram\Instagram;
		$instagram->setAccessToken(Session::get('instagram_access_token'));
		$media = null;
		if ($tagFilter == "") {
			$media = $instagram->getPopularMedia();
		}
		else {
			try {
				$tag = $instagram->getTag($tagFilter);
				$media = $tag->getMedia(array('count' => 5));
			}
			catch (\Instagram\Core\ApiException $ex) {
				return 'Invalid tag';
			}		
		}		
		return view('list')->with('medias', $media)->with('tagFilter', $tagFilter);
	}

}
