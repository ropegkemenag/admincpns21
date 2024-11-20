<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Loader extends CI_Loader {

	public function admin($view, $vars = array(), $return = FALSE)
	{
    $folder = 'admin/';

		$vars['view']	= $folder.$view;
		$tpl  				= $folder.'template';

		// return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
		if (method_exists($this, '_ci_object_to_array'))
		{
			return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
		} else {
			return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
		}
	}

	public function tpl($view, $vars = array(), $return = FALSE)
	{
    $folder = 'layout/';

		$vars['view']	= $view;
		$tpl  				= $folder.'template';

		// return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
		if (method_exists($this, '_ci_object_to_array'))
		{
			return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
		} else {
			return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
		}
	}

	public function user($view, $vars = array(), $return = FALSE)
	{
		$folder = 'user/';

		$vars['view']	= $folder.$view;
		$tpl  				= $folder.'template';

		// return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
		if (method_exists($this, '_ci_object_to_array'))
		{
			return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
		} else {
			return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_prepare_view_vars($vars), '_ci_return' => $return));
		}
	}

	/*
	public function sitetpl($view, $vars = array(), $return = FALSE)
	{
		$CI =& get_instance();

		//$theme				= $CI->config->item('theme_path');
		$theme				= get_option('theme').'/';
		$vars['view']	= $view;
		$tpl  				= 'template';

		$this->_ci_view_paths = array(FCPATH . 'themes/'.$theme => TRUE);
		return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}
	*/

	public function view_employee($view, $vars = array(), $return = FALSE)
	{
		$CI =& get_instance();
		$vars['view']	= 'employee/'.$view;
		$tpl  				= 'employee/template';
		return $this->_ci_load(array('_ci_view' => $tpl, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}

	public function sitetpl($view, $vars = array(), $return = FALSE)
	{
		$CI =& get_instance();

		$theme				= get_option('theme').'/';
		$tpl  				= 'template';

		$this->_ci_view_paths = array(FCPATH . 'themes/'.$theme => TRUE);
		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}

	public function single($view, $vars = array(), $return = FALSE)
	{
		$CI =& get_instance();

		//$theme				= $CI->config->item('theme_path');
		$theme				= get_option('theme').'/';
		//$vars['view']	= $view;
		//$tpl  				= 'template';

		$this->_ci_view_paths = array(FCPATH . 'themes/'.$theme => TRUE);
		return $this->_ci_load(array('_ci_view' => $view, '_ci_vars' => $this->_ci_object_to_array($vars), '_ci_return' => $return));
	}
}
