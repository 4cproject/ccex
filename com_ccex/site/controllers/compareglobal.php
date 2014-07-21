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
        $intervals = array();
        $collections = array();
        $organizations = array();

        if (array_key_exists('collectionsSelected', $data) && array_key_exists('collectionsMode', $data) && $data["collectionsMode"] == "separated") {
            $collections = $data['collectionsSelected'];
            $result = $this->getCollectionsIntervals($collections, $data["yearsSelected"]);

            $intervals = $result["intervals"];
            $myLabel = $result["myLabel"];
        } else {
            $organizationYear = $data['organizationYearSelected'];
            $myLabel = "All collections at ";

            if($organizationYear == "all"){
                $myLabel .= "all years";
            }else{
                $myLabel .= $organizationYear;
            }

            $collections = array();
            $intervals = $organization->intervalsOfYear($organizationYear);
        }

        if (array_key_exists('otherOrganisationsCosts', $data)){
            preg_match('/(?P<type>.*)\|(?P<filter>.*)\|(?P<value>.*)\|(?P<title>.*)/', $data["otherOrganisationsCosts"], $matches);
            $otherLabel = $matches["title"];
            if($matches["filter"] != "none"){
                if($matches["type"] == "organization"){
                    $organizations = $compareGlobal->filterOrganizationsBy($matches["filter"],$matches["value"]);
                }
            }
        }

        $series = $compareGlobal->series($intervals, $organizations, array(), $myLabel, $otherLabel);
        
        $return['success'] = true;            
        $return['series'] = $series;
        
        echo json_encode($return);
    }

    private function getCollectionsIntervals($collections, $yearsArray){
        $intervals = array();
        $myLabel = "Selected collections (";

        foreach ($collections as $collectionID) {
            $collectionModel = new CCExModelsCollection();
            $collection = $collectionModel->getItemBy("_collection_id", $collectionID);

            if ($collection) {
                $year = $yearsArray[$collectionID];

                $intervals = array_merge($intervals, $collection->intervalsOfYear($year));
            }
        }

        $myLabel .= count($collections) . ")";

        return array(
            "intervals" => $intervals,
            "myLabel"     => $myLabel
        );
    }
}
