<?php


namespace iMi\TemplateFilter;

class ImiTemplateFilter
{

    public function loadMountedTemplates($objUser)
    {
        $arrAllMounts = array();

        $arrGroups = deserialize($objUser->groups);
        // merge member group mounts of all user groups we are member in
        foreach($arrGroups as $intGroup) {
            $objGroup = \UserGroupModel::findByPk($intGroup);
            $arrMounts = deserialize($objGroup->template_mounts);
            if (empty($arrMounts)) {
                $arrMounts = array();
            }
            foreach($arrMounts as $strMount) {
                $arrAllMounts[$strMount] = true;
            }

        }
        return $arrAllMounts;
    }

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

        $mountedTemplates = $this->loadMountedTemplates($objUser);

        $groups = $objUser->groups;
        $groupNames = array();

        foreach ($groups as $groupId) {
            $group = \UserGroupModel::findByPk($groupId);
            $groupNames[] = $group->name;
        }
        $result = array();

        foreach($arrTemplates as $key=>$value) {
            if ($strSelected == $key || isset($mountedTemplates[$key])) {
                $result[$key] = $value;
            }
        }
        return $result;
    }

}