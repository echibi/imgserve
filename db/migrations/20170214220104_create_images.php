<?php

use Phinx\Migration\AbstractMigration;

class CreateImages extends AbstractMigration {
	public function change() {
		$table = $this->table( 'images' );
		$table->addColumn( 'filename', 'string' )
			->addColumn( 'alt', 'text' )
			->create();
	}
}
