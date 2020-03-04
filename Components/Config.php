<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Config\Components;

use Exception;
use Config\Database;

abstract class Config extends \CodeIgniter\Config\BaseConfig
{

    public function __construct()
    {
        parent::__construct();

        $db = Database::connect();

        $query = $db->table('configs');

        $query->where('config_class', static::class);

        $values = [];

        foreach ($query->get()->getResultArray() as $row)
        {
            $values[$row['config_property']] = $row['config_value'];
        }

        foreach ($values as $property => $value)
        {
            if (property_exists($this, $property))
            {
                $this->{$property} = $value;
            }
        }
    }

}