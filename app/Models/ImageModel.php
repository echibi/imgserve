<?php
/**
 * Created by Jonas Rensfeldt.
 * Date: 16/02/17
 */

namespace App\Models;


class ImageModel extends Model {

	const table = 'images';

	/**
	 * @return mixed
	 */
	public function getRandom() {
		$query = $this->db->table( self::table );
		$query->limit( 1 );
		// $query->select( 'filename' );
		$query->orderBy( $this->db->raw( 'rand()' ) );

		return $query->first();
	}
}