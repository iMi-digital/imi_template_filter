<?php


namespace iMi\TemplateFilter;

$GLOBALS['TL_DCA']['tl_form_field']['fields']['customTpl']['options_callback'] = array('iMi\TemplateFilter\tl_form_field_template_filter', 'getFormFieldTemplates');


class tl_form_field_template_filter extends \tl_form_field
{
    public function getFormFieldTemplates($objDca)
    {
        $model = \FormFieldModel::findByPk($objDca->id);
        $filter = new \ImiTemplateFilter();

        return $filter->filterTemplates(parent::getFormFieldTemplates(), $model->customTpl, $this->User);

    }

}
