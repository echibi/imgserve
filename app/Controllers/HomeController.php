<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 16/02/17
 */

namespace App\Controllers;


use App\Models\ImageModel;
use Intervention\Image\ImageManager;
use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Router;

class HomeController extends Controller {

	/**
	 * @var Router
	 */
	public $router;


	public $imageManager;

	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param          $args
	 *
	 * @return Response
	 */
	public function getRandomImage( Request $request, Response $response, $args ) {

		$baseImgPath = $this->app->get( 'settings' )['images']['dir'] . '/';

		/**
		 * @var ImageModel $imageModel
		 */
		$imageModel = $this->app->get( 'ImageModel' );
		$image      = $imageModel->getRandom();
		$imagePath  = $baseImgPath . $image->filename;
		if ( file_exists( $imagePath ) ) {

			$this->imageManager = $this->app->get( 'image' );

			/**
			 * @var ImageManager $imageManager
			 */
			$imageManager = $this->app->get( 'image' );

			$placeholder = $imageManager->make( $imagePath )
				->fit( $args['width'], $args['height'] );
			if ( $image->id > 4 ) {
				$placeholder->greyscale();
			}
			$placeholder->response( 'jpeg' );


			$response->write( $placeholder );

			return $response->withHeader( 'Content-Type', 'image/jpeg' );

		}


	}
}