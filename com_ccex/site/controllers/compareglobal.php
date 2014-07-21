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

        if (array_key_exists('collectionsSelected', $data) && array_key_exists('collectionsMode', $data) && $data["collectionsMode"] == "separated") {
            $collections = $data['collectionsSelected'];
            $result = $this->getCollectionsIntervals($collections, $data["yearsSelected"]);

            $intervals = $result["intervals"];
            $label = $result["label"];
        } else {
            $organizationYear = $data['organizationYearSelected'];
            $label = "All collections at ";

            if($organizationYear == "all"){
                $label .= "all years";
            }else{
                $label .= $organizationYear;
            }

            $collections = array();
            $intervals = $organization->intervalsOfYear($organizationYear);
        }

        $series = $compareGlobal->series($intervals, array(), array(), $label);
        
        $return['success'] = true;            
        $return['series'] = $series;
        
        echo json_encode($return);
    }

    private function getCollectionsIntervals($collections, $yearsArray){
        $intervals = array();
        $label = "Selected collections (";

        foreach ($collections as $collectionID) {
            $collectionModel = new CCExModelsCollection();
            $collection = $collectionModel->getItemBy("_collection_id", $collectionID);

            if ($collection) {
                $year = $yearsArray[$collectionID];

                $intervals = array_merge($intervals, $collection->intervalsOfYear($year));
            }
        }

        $label .= count($collections) . ")";

        return array(
            "intervals" => $intervals,
            "label"     => $label
        );
    }
}
