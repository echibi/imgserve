<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 16/02/17
 */

namespace App\Controllers;


use App\Models\ImageModel;
use Intervention\Image\ImageManager;
use phpFastCache\Cache\ExtendedCacheItemPoolInterface;
use Slim\Http\Request;
use Slim\Http\Response;

class HomeController extends Controller {

	/**
	 * @var ExtendedCacheItemPoolInterface
	 */
	public $cache;


	public $imageManager;

	/**
	 * @param Request  $request
	 * @param Response $response
	 * @param          $args
	 *
	 * @return Response
	 */
	public function getRandomImage( Request $request, Response $response, $args ) {

		$this->cache = $this->app->get( 'cache' );

		$width  = $args['width'];
		$height = $args['height'];

		$key = $width . 'x' . $height;

		$cache = $this->cache->getItem( $key );

		if ( is_null( $cache->get() ) ) {

			$settings    = $this->app->get( 'settings' );
			$baseImgPath = $settings['images']['dir'] . '/';

			/**
			 * @var ImageModel $imageModel
			 */
			$imageModel = $this->app->get( 'ImageModel' );
			$image      = $imageModel->getRandom();
			$imagePath  = $baseImgPath . $image->filename;

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

			$cache->set( $placeholder )->expiresAfter( $settings['cache']['expires'] );
			$this->cache->save( $cache );

			$this->logger->addInfo( 'generated new image', array(
				'key'   => $key,
				'image' => $image
			) );

		} else {
			$placeholder = $cache->get();
		}

		$response->write( $placeholder );

		return $response->withHeader( 'Content-Type', 'image/jpeg' );


	}
}