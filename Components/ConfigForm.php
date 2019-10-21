<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Config\Components;

use Exception;
use Config\Database;
use BasicApp\Core\Form;

abstract class ConfigForm extends \BasicApp\Core\Model
{

    protected $table = 'configs';

    abstract function renderForm(Form $form, $data);

    public function getProperty($class, $property)
    {
        $result = $this->db->table($this->table)->where([
            'config_class' => $class,
            'config_property' => $property
        ])->get();

        if (!$result)
        {
            $error = $this->db->error(); 

            throw new Exception($error);
        }

        return $result->getRowArray();
    }

    public function insert($data = null, bool $returnID = true)
    {
        if ($this->validate($data) === false)
        {
            return false;
        }

        $properties = [];

        foreach ($data as $property => $value)
        {
            $entity = $this->getProperty($this->returnType, $property);

            if (!$entity)
            {
                $result = $this->db->table($this->table)->insert([
                    'config_class' => $this->returnType,
                    'config_property' => $property,
                    'config_value' => $value
                ]);

                if (!$result)
                {
                    $error = $this->db->error(); 

                    throw new Exception($error);
                }
            }
            else
            {
                $result = $this->db->table($this->table)
                    ->where('config_id', $entity['config_id'])
                    ->update([
                        'config_value' => $value
                    ]);

                if (!$result)
                {
                    $error = $this->db->error(); 

                    throw new Exception($error);
                }
            }

            $properties[] = $property;
        }

        // delete old properties

        $this->db->table($this->table)
            ->where('config_class', get_called_class())
            ->whereNotIn('config_property', $properties)
            ->delete();

        return true;
    }

}