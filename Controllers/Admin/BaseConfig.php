<?php
/**
 * @author Basic App Dev Team
 * @license MIT
 * @link http://basic-app.com
 */
namespace BasicApp\Config\Controllers\Admin;

use CodeIgniter\Exceptions\PageNotFoundException;
use stdClass;
use BasicApp\Admin\AdminEvents;

abstract class BaseConfig extends \BasicApp\Admin\AdminController
{

	public function index()
	{
        $modelClass = $this->request->getGet('class');

        if (!$modelClass)
        {
            throw new PageNotFoundException;
        }

        $adminOptionsMenu = AdminEvents::optionsMenu();

        if (isset($adminOptionsMenu[$modelClass]))
        {
            $title = $adminOptionsMenu[$modelClass]['label'];
        }
        else
        {
            $title = $class;
        }

        $messages = [];

        $model = new $modelClass;

        $entityClass = $model->returnType;

        $row = new $entityClass;

        $post = $this->request->getPost();

        if ($post || $_FILES)
        {
            foreach($post as $key => $value)
            {
                if (property_exists($row, $key))
                {
                    $row->$key = $value;
                }
            }        

            $saved = $model->save($row);

            if ($saved)
            {
                $messages[] = t('admin', 'The changes have been successfully saved.');
            
                $row = new $entityClass;
            }
        }

        $errors = $model->errors();

        if ($errors === null)
        {
            $errors = [];
        }

		return $this->render('BasicApp\Config\Admin\Config\index', [
			'model' => $model,
            'row' => $row,
            'modelClass' => $modelClass,
			'errors' => $errors,
			'messages' => $messages,
            'title' => $title
		]);
	}

}