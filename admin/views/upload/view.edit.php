<?php
/**
 * @package		MiwoVideos
 * @copyright	Copyright (C) 2009-2014 Miwisoft, LLC. All rights reserved.
 * @license		GNU General Public License version 2 or later
 */
# No Permission
defined('MIWI') or die ;

class MiwovideosViewUpload extends MiwovideosView {

    public function display($tpl = null) {
        MFactory::getApplication()->redirect('index.php?option=com_miwovideos&view=upload');
	}
}