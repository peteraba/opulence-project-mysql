<?php
namespace Project\Infrastructure\Databases\Migrations;

use DateTime;
use Opulence\Databases\Migrations\Migration;

class Third extends Migration
{
    /**
     * @inheritdoc
     */
    public static function getCreationDate() : DateTime
    {
        return DateTime::createFromFormat(DateTime::ATOM, '2019-11-16T19:24:40+00:00');
    }

    /**
     * @inheritdoc
     */
    public function down() : void
    {
        $sql = 'DROP TABLE IF EXISTS roles';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    /**
     * @inheritdoc
     */
    public function up() : void
    {
        $sql = 'CREATE TABLE roles (id serial primary key)';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }
}
