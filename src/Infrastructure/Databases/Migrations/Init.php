<?php
namespace Project\Infrastructure\Databases\Migrations;

use DateTime;
use Opulence\Databases\Migrations\Migration;

class Init extends Migration
{
    /**
     * Gets the creation date, which is used for ordering
     * 
     * @return DateTime The date this migration was created
     */
    public static function getCreationDate() : DateTime
    {
        return DateTime::createFromFormat(DateTime::ATOM, '2019-11-16T11:58:30+00:00');
    }
    
    /**
     * Executes the query that rolls back the migration
     */
    public function down() : void
    {
        $sql = 'DROP TABLE IF EXISTS users';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    /**
     * Executes the query that commits the migration
     */
    public function up() : void
    {
        $sql = 'CREATE TABLE users (id serial primary key, email text)';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }
}
