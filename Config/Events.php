<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\System\SystemEvents;
use Config\Database;
use BasicApp\System\Events\SystemResetEvent;
use BasicApp\Config\Database\Seeds\ConfigResetSeeder;

SystemEvents::onReset(function(SystemResetEvent $event) {

    $seeder = Database::seeder();

    $seeder->call(ConfigResetSeeder::class);
});