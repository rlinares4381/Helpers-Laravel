<?php

/**
 *-------------------------------------------------------------------------
 * IIWEB
 *-------------------------------------------------------------------------
 * Open Source developer api
 *
 * @package		PmsDir.php
 * @author		ING Ramón A Linares Febles
 * @copyright	Copyright (c) 2013 - 2015, IIWEB.DO, Inc.
 * @license		http://www.iiweb.do
 * @link		http://www.iiweb.do
 * @since		Version 1.0
 * @filesource
 *
 */

class PmsDir
{
	public static function info()
	{
		return 'GDIR V-1.0';
	}

	// Directory map
	public static function map($source, $depth=0, $hidden=false)
	{
		if($fp = @opendir($source))
		{

			$data		= array();
			$new_depth	= $depth -1;
			$source 	= rtrim($source, DIRECTORY_SEPARATOR).DIRECTORY_SEPARATOR;


			while (false !== ($file = readdir($fp))) 
			{
				if ( !trim($file, '.') OR ($hidden == false && $file[0] == '.'))
				{
					continue;
				}

				if (($depth < 1 OR $new_depth > 0) && @is_dir($source.$file))
				{
					$data[$file] = PmsDir::map($source.$file.DIRECTORY_SEPARATOR, $new_depth, $hidden);
				}
				else
				{
					$data[] = $file;
				}
			}

			closedir($fp);
			return $data;

		}
		return false;
	}
}

/* End of helper PmsDir.php */