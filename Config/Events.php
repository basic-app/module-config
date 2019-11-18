<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\System\SystemEvents;

SystemEvents::onUpdate(function($event)
{
    if ($event->reset)
    {
        $db = db_connect();

        if (!$db->simpleQuery('TRUNCATE TABLE configs'))
        {
            throw new Exception($db->error());
        }

        echo 'config table truncated' . PHP_EOL;
    }
});