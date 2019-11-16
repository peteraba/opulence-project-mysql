<?php
namespace Project\Infrastructure\Databases\Migrations;

use DateTime;
use Opulence\Databases\Migrations\Migration;

class Fourth extends Migration
{
    /**
     * @inheritdoc
     */
    public static function getCreationDate() : DateTime
    {
        return DateTime::createFromFormat(DateTime::ATOM, '2019-11-16T19:24:45+00:00');
    }

    /**
     * @inheritdoc
     */
    public function down() : void
    {
        $sql = 'DROP TABLE IF EXISTS resources';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    /**
     * @inheritdoc
     */
    public function up() : void
    {
        $sql = 'CREATE TABLE resources (id serial primary key)';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }
}
