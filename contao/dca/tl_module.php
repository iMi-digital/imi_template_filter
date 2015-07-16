<?php


namespace iMi\TemplateFilter;

$GLOBALS['TL_DCA']['tl_module']['fields']['customTpl']['options_callback'] = array('iMi\TemplateFilter\tl_module_template_filter', 'getModuleTemplates');


class tl_module_template_filter extends \tl_module
{
    public function getModuleTemplates($objDca)
    {
        $model = \ModuleModel::findByPk($objDca->id);
        $filter = new \ImiTemplateFilter();

        return $filter->filterTemplates(parent::getModuleTemplates(), $model->customTpl, $this->User);
    }

}
