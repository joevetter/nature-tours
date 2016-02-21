<?php

use Phinx\Migration\AbstractMigration;

class CreatePagesTable extends AbstractMigration
{
  /**
   * executed each time we run a migration
   */
  public function up()
  {
    $pages = $this->table('pages');
    $pages->addColumn('title', 'string')
          ->addColumn('content', 'text')
          ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addColumn('updated_at', 'datetime', ['null' => true])
          ->save();
  }
  /**
   * executed each time we reverse a migration
   */
  public function down()
  {
    $this->dropTable('pages');
  }
}
