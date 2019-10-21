<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Config\Database\Migrations;

class Migration_create_configs_table extends \BasicApp\Core\Migration
{

    public $tableName = 'configs';

    public function up()
    {
        $this->forge->addField([
            'config_id' => $this->primaryKey()->toArray(),
            'config_updated_at' => $this->created()->toArray(),
            'config_class' => $this->string(127)->notNull()->toArray(),
            'config_property' => $this->string(127)->notNull()->toArray(),
            'config_value' => $this->string()->toArray()
        ]);

        $this->forge->addKey('config_id', true);

        $this->forge->addKey('config_class');

        $this->forge->addUniqueKey(['config_class', 'config_property']);

        $this->forge->createTable($this->tableName);
    }

    public function down()
    {
        $this->forge->dropTable($this->tableName);
    }

}