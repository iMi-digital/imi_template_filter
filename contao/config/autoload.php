<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'iMi\TemplateFilter',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	'iMi\TemplateFilter\ImiTemplateFilter' => 'system/modules/imi_template_filter/classes/ImiTemplateFilter.php',
));
