<?php

use Phinx\Migration\AbstractMigration;

class CreateToursTable extends AbstractMigration
{
  /**
   * executed each time we run a migration
   */
  public function up()
  {
    $tours = $this->table('tours');
    $tours->addColumn('title', 'string')
          ->addColumn('description', 'text')
          ->addColumn('start_date', 'string')
          ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addColumn('updated_at', 'datetime', ['null' => true])
          ->save();
  }
  /**
   * executed each time we reverse a migration
   */
  public function down()
  {
    $this->dropTable('tours');
  }
}
