<?php

// Backpack\CRUD: Define the resources for the entities you want to CRUD.
CRUD::resource('banner', 'BannerCrudController');
CRUD::resource('event', 'EventCrudController');
CRUD::resource('participant', 'TeamCrudController');
CRUD::resource('member', 'UserCrudController');
CRUD::resource('useradmin', 'AdminCrudController');
//CRUD::resource('faq', 'FaqCrudController');
//CRUD::resource('judge', 'JudgeCrudController');
//CRUD::resource('page', 'PageCrudController');
