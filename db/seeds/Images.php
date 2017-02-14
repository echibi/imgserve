<?php

use Phinx\Seed\AbstractSeed;

class Images extends AbstractSeed {
	/**
	 * Run Method.
	 *
	 * Write your database seeder using this method.
	 *
	 * More information on writing seeders is available here:
	 * http://docs.phinx.org/en/latest/seeding.html
	 */
	public function run() {
		$data = array();
		for ( $i = 1; $i < 10; $i ++ ) {
			$data[] = array(
				'filename' => $i . '.jpg',
				'alt'      => '',
			);
		}

		$table = $this->table( 'images' );
		$table->insert( $data )
			->save();
	}
}
