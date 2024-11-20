<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();

$autoload['libraries'] = array('database','session','form_validation','ion_auth');

$autoload['drivers'] = array();

$autoload['helper'] = array('url','asset','custom','html','format');

$autoload['config'] = array('asset');

$autoload['language'] = array();

$autoload['model'] = array('crud_model'=>'crud');
