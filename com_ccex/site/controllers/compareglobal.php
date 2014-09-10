<?php
defined('_JEXEC') or die('Restricted access');

class CCExControllersCompareglobal extends JControllerBase
{
    public function execute() {
        $app = JFactory::getApplication();
        $return = array('success' => false);
        
        $userModel = new CCExModelsUser();
        $organization = $userModel->organization();
        $data = JRequest::get('post');
        $mode = $data['collectionsMode'];
        $compareGlobal = new CCExModelsCompareglobal();
        $compareGlobal->set("_organization", $organization);
        $myCollectionsIDs = array();
        $organizations = array(); 
        $collections = array();
        $otherLabel = "List all organisations";
        $filter = null;

        if (array_key_exists('collectionsSelected', $data) && array_key_exists('collectionsMode', $data)) {
            if ($data["collectionsMode"] == "separated") {
                $myCollectionsIDs = $data['collectionsSelected'];
                $myYear = $data["yearsSelected"];
            } else {
                $myCollectionsIDs = array();

                if($data["collectionsMode"] == "combinedFinal"){
                    $myYear = $data['organizationYearSelectedFinal'];
                    $filter = "final";
                } else {
                    $myYear = $data['organizationYearSelectedAll'];
                }
            }
        }

        if (array_key_exists('otherOrganisationsCosts', $data)){
            preg_match('/(?P<type>.*)\|(?P<filter>.*)\|(?P<value>.*)\|(?P<title>.*)/', $data["otherOrganisationsCosts"], $matches);
            $otherLabel = $matches["title"];
            if($matches["filter"] != "none"){
                if($matches["type"] == "organization"){
                    $organizations = $compareGlobal->filterOrganizationsBy($matches["filter"],$matches["value"]);
                }elseif($matches["type"] == "collection"){
                    $collections = $compareGlobal->filterCollectionsBy($matches["filter"],$matches["value"]);
                }
            }
        }

        $series = $compareGlobal->series($myCollectionsIDs, $myYear, $organizations, $collections, $otherLabel, $filter);
        
        $return['success'] = true;            
        $return['series'] = $series;
        
        echo json_encode($return);
    }
}
