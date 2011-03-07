<?php

/*
=============================================================
 PHP Functions Plugin
 by: Jonathan Kelly, Jesse Bunch - Paramore|Redd Online Marketing
 http://paramoreredd.com/
 Copyright (c) Paramore|Redd Online Marketing
=============================================================
	 THIS IS COPYRIGHTED SOFTWARE
-------------------------------------------------------------
	This software is based upon and derived from
	EllisLab ExpressionEngine software protected under
	copyright dated 2004 - 2007. Please see
	www.expressionengine.com/docs/license.html 
=============================================================
	File:           pi.php_functions.php 
-------------------------------------------------------------
	Compatibility:  ExpressionEngine 1.6+ 
-------------------------------------------------------------
	Purpose:        Call PHP Functions w/out enabling PHP
					inside EE templates
=============================================================
*/

// For the EE CP 
$plugin_info = array(
	'pi_name'        => 'PHP Functions',
	'pi_version'     => '1.0',
	'pi_author'      => 'Jonathan W. Kelly',
	'pi_author_url'  => 'http://paramoreredd.com',
	'pi_description' => 'Allows native PHP functions to be called via EE tags, without having PHP be enabled within the template.',
	'pi_usage'       => PHP_Functions::Usage()
);

class PHP_Functions {

	/**
	 * @var _TMPL object
	 * Inherited TMPL object
	 **/
	var $_TMPL;

	/**
	 * Constructor class (for PHP4-PHP5)
	 * Gets the object ready to use by performing basic functions
	 * @access public
	 * @param void
	 * @return void
	 * @author Jonathan W. Kelly
	 **/ 
	public function PHP_Functions() {

		global $TMPL;

		$this->_TMPL = $TMPL;

		return;
		
	} # END METHOD PHP_Functions()
	
	/**
	 * PHP str_replace() alias. See php.net/str_replace for documentation.
	 * USAGE: {exp:php_functions:__str_replace search="%%VARIABLE%%" replace="{embed='includes/.content'}"}{custom_field_name}{/exp:php_functions:__str_replace}
	 * @access public
	 * @param void
	 * @return string
	 * @author Jonathan W. Kelly
	 **/
	public function __str_replace() {
		
		$search = $this->_TMPL->fetch_param("search");
		$replace = $this->_TMPL->fetch_param("replace");
		
		return str_replace($search, $replace, $this->_TMPL->tagdata);
		
	} # END METHOD __str_replace()
	
	/**
	 * PHP strpos() alias.
	 * USAGE: {exp:php_functions:__strpos needle="my" haystack="mystring"}
	 * @access public
	 * @param void
	 * @return string The index of the first occurrence of the needle
	 * @author Jesse Bunch
	 */
	public function __strpos() {
		
		$strHaystack = $this->_TMPL->fetch_param("haystack");
		$strNeedle = $this->_TMPL->fetch_param("needle");
		
		return strpos($strHaystack, $strNeedle);
		
	} # END METHOD __strpos()

	/**
	 * This function describes how the plugin is used.
	 * Make sure and use output buffering
	 * @access public
	 * @param void
	 * @return string Output buffer contents
	 * @author Jonathan W. Kelly
	 **/
	public function Usage() {

		ob_start();
		?>
This plugin allows you to use call certain PHP functions vicariously through EE templates, and pass in as parameters the arguments for the function.

--------------------------------

String Replace : Alias of str_replace()

{exp:php_functions:__str_replace search="foo" replace="barr"}search subject goes here{exp:php_functions:__str_replace}

OR

{exp:php_functions:__str_replace search="%%VARIABLE%%" replace="{embed='includes/content-tpl'}"}{custom_field_name}{/exp:php_functions:__str_replace}

--------------------------------

String Position : Alias of strpos()

{exp:php_functions:__strpos needle="my" haystack="mystring"}

		<?php
		$buffer = ob_get_contents();

		ob_end_clean(); 

		return $buffer;

	} # END METHOD Usage()

} # END CLASS PHP_Functions()

/* End of file pi.php_functions.php */
/* Location: ./system/plugins/pi.php_functions.php */
	
