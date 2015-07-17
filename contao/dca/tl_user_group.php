<?php

namespace iMi\TemplateFilter;

/**
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] =
	str_replace('{filemounts_legend}', '{template_mounts_legend},template_mounts;{filemounts_legend}',
		$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default']);


$GLOBALS['TL_DCA']['tl_user_group']['fields']['template_mounts'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user_group']['template_mounts'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_user_group.name',
	'eval'                    => array('multiple'=>true),
	'sql'                     => "blob NULL",
	'options_callback' 		  => array('iMi\TemplateFilter\tl_user_group', 'loadTemplates')
);

class tl_user_group extends \tl_user_group
{
	public function loadTemplates()
	{
		return $this->getTemplateGroup('');
	}
}