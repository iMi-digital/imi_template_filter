<?php


namespace iMi\TemplateFilter;

$GLOBALS['TL_DCA']['tl_article']['fields']['customTpl']['options_callback'] = array('iMi\TemplateFilter\tl_article_template_filter', 'getArticleTemplates');


class tl_article_template_filter extends \tl_article
{
    public function getArticleTemplates($objDca)
    {
        $model = \ArticleModel::findByPk($objDca->id);
        $filter = new \ImiTemplateFilter();

        return $filter->filterTemplates(parent::getArticleTemplates(), $model->customTpl, $this->User);
    }

}
