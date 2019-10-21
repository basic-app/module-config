<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Config\Components;

use Exception;
use Config\Database;

abstract class Config extends \CodeIgniter\Config\BaseConfig
{

    protected $modelClass;

    public function __construct()
    {
        parent::__construct();

        if (!$this->modelClass)
        {
            throw new Exception('Property "modelClass" is not defined.');
        }

        $modelClass = $this->modelClass;

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