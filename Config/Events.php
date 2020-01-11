<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\System\SystemEvents;
use Config\Database;
use BasicApp\System\Events\SystemSeedEvent;
use BasicApp\System\Events\SystemResetEvent;
use BasicApp\Config\Database\Seeds\ConfigSeeder;
use BasicApp\Config\Database\Seeds\ConfigResetSeeder;

SystemEvents::onSeed(function(SystemSeedEvent $event) {

    $seeder = Database::seeder();

    $seeder->call(ConfigSeeder::class);
});

SystemEvents::onReset(function(SystemResetEvent $event) {

    $seeder = Database::seeder();

    $seeder->call(ConfigResetSeeder::class);
});