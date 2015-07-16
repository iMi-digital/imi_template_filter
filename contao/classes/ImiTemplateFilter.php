<?php


namespace iMi\TemplateFilter;

class ImiTemplateFilter
{
    /**
     * Filter list of templates, show only those which contain a user group.
     * That user group is removed from the display name of templates.
     *
     * @param $arrTemplates all templates
     * @param $strSelected selected template to still include in the list
     * @param $objUser current user
     * @return array
     */
    public function filterTemplates($arrTemplates, $strSelected, $objUser)
    {
        if ($objUser->isAdmin) {
            return $arrTemplates;
        }

        $GLOBALS['TL_DCA']['tl_article']['fields']['customTpl']['label'][1] = $GLOBALS['TL_LANG']['iMiTemplateFilterRemark'];

        $groups = $objUser->groups;
        $groupNames = array();

        foreach ($groups as $groupId) {
            $group = \UserGroupModel::findByPk($groupId);
            $groupNames[] = $group->name;
        }
        $result = array();

        foreach($arrTemplates as $key=>$value) {
            $found = false;
            if ($strSelected == $key) {
                $found = true;
                $tag = '';
            }
            if (!$found) {
                foreach($groupNames as $groupName) {
                    $tag = '.' . $groupName;
                    if (strpos($key, $tag) !== false) {
                        $found = true;
                        break;
                    }
                }
            }
            if ($found) {
                $result[$key] = str_replace($tag, '', $value);
            }
        }
        return $result;
    }

}