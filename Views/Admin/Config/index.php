<?php
/**
 * @author Basic App Dev Team <dev@basic-app.com>
 * @license MIT
 * @link http://basic-app.com
 */
use BasicApp\Helpers\Url;

$this->data['title'] = $title;

$this->data['breadcrumbs'][] = ['label' => t('admin.menu', 'Options')];

$this->data['breadcrumbs'][] = ['label' => $title];

$this->data['adminOptionsMenu'][$modelClass]['active'] = true;

$this->data['enableCard'] = true;

$this->data['cardTitle'] = $title;

$adminTheme = service('adminTheme');

$form = $adminTheme->createForm($model, $errors);

echo $form->openMultipart();

echo $form->renderMessages($messages);

echo $model->renderForm($form, $row);

echo $form->renderErrors();

echo $form->submitButton(t('admin', 'Save'));

echo $form->close();