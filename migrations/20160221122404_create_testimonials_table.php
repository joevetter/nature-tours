<?php

use Phinx\Migration\AbstractMigration;

class CreateTestimonialsTable extends AbstractMigration
{
  /**
   * executed each time we run a migration
   */
  public function up()
  {
    $testimonials = $this->table('testimonials');
    $testimonials->addColumn('title', 'string')
          ->addColumn('testimonial', 'text')
          ->addColumn('user_id', 'integer')
          ->addForeignKey('user_id', 'users', 'id', ['delete' => 'cascade',
                                                     'update' => 'cascade'])
          ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
          ->addColumn('updated_at', 'datetime', ['null' => true])
          ->save();
  }
  /**
   * executed each time we reverse a migration
   */
  public function down()
  {
    $this->dropTable('testimonials');
  }
}
