<?php

use Core\Page;
use Modules\Crud\Libraries\Repositories\CrudRepository;

// init table fields
$tableName  = $_GET['table'];
$table      = tableFields($tableName);
$fields     = $table->getFields();
$module     = $table->getModule();
$success_msg = get_flash_msg('success');
$error_msg   = get_flash_msg('error');

if(isset($fields['_userstamp']))
{
    $fields['created_at'] = [
        'label' => __('crud.label.created_at'),
        'type' => 'text'
    ];
    $fields['created_by'] = [
        'label' => __('crud.label.created_by'),
        'type' => 'options-obj:users,id,name'
    ];
    $fields['updated_at'] = [
        'label' => __('crud.label.updated_at'),
        'type' => 'text'
    ];
    $fields['updated_by'] = [
        'label' => __('crud.label.updated_by'),
        'type' => 'options-obj:users,id,name'
    ];

    unset($fields['_userstamp']);
}

// page section
$title = _ucwords(__("$module.label.$tableName"));
Page::setActive("$module.$tableName");
Page::setTitle($title);
Page::setModuleName($title);
Page::setBreadcrumbs([
    [
        'url' => routeTo('/'),
        'title' => __('crud.label.home')
    ],
    [
        'url' => routeTo('crud/index', ['table' => $tableName]),
        'title' => $title
    ],
    [
        'title' => 'Index'
    ]
]);

Page::pushFoot("<script src='".asset('assets/crud/js/crud.js')."'></script>");

Page::pushHook('index');

// get data
$crudRepository = new CrudRepository($tableName);
$crudRepository->setModule($module);

if(isset($_GET['draw']))
{
    return $crudRepository->dataTable($fields);
}

return view('crud/views/index', compact('fields', 'tableName', 'success_msg', 'error_msg', 'crudRepository'));