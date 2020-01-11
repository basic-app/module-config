<?php

namespace BasicApp\Config\Database\Seeds;

class ConfigResetSeeder extends \BasicApp\Core\Seeder
{

    public function run()
    {
        $this->db->table('configs')->truncate();
    }

}