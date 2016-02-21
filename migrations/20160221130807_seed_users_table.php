<?php

use Phinx\Migration\AbstractMigration;

class SeedUsersTable extends AbstractMigration
{
    public function up()
    {
      $password_hash = password_hash('verysecret', PASSWORD_DEFAULT);
      $this->execute('
        INSERT INTO users (firstname, lastname, email, password)
        VALUES
        ("Homer", "Simpson", "homer@simpsons.com", "' . $password_hash . '")
      ');
    }

    public function down()
    {

    }
}
