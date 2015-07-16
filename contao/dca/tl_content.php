<?php


namespace iMi\TemplateFilter;

$GLOBALS['TL_DCA']['tl_content']['fields']['customTpl']['options_callback'] = array('iMi\TemplateFilter\tl_content_template_filter', 'getElementTemplates');
$GLOBALS['TL_DCA']['tl_content']['fields']['galleryTpl']['options_callback'] = array('iMi\TemplateFilter\tl_content_template_filter', 'getGalleryTemplates');


class tl_content_template_filter extends \tl_content
{
    public function getElementTemplates($objDca)
    {
        $model = \ContentModel::findByPk($objDca->id);
        $filter = new \ImiTemplateFilter();

        return $filter->filterTemplates(parent::getElementTemplates(), $model->customTpl, $this->User);
    }

    public function getGalleryTemplates($objDca)
    {
        $model = \ContentModel::findByPk($objDca->id);
        $filter = new \ImiTemplateFilter();

        return $filter->filterTemplates(parent::getGalleryTemplates(), $model->galleryTpl, $this->User);
    }


}
