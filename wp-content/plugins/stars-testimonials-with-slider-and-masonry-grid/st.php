<?php
/*
Plugin Name: Stars Testimonials with Slider and Masonry Grid
Description: Display your testimonials beautifully
Plugin URI: https://webcodingplace.com
Author: Rameez
Author URI: http://webcodingplace.com
Version: 2.0
License: GPL2
Text Domain: stars-testimonials
Domain Path: languages
*/

/*

    Copyright (C) 2017  Rameez  help@webcodingplace.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
require 'plugin.class.php';
if (class_exists('Stars_Testimonials')) {
	$st_ob = new Stars_Testimonials;
}
?>