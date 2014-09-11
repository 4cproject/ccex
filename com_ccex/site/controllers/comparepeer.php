<?php
defined('_JEXEC') or die('Restricted access');

class CCExControllersComparepeer extends JControllerBase
{
    public function execute() {
        $app = JFactory::getApplication();
        $return = array('success' => false);
        
        $userModel = new CCExModelsUser();
        $organization = $userModel->organization();
        $data = JRequest::get('post');
        $mode = $data['collectionsMode'];
        $comparePeer = new CCExModelsComparepeer();
        $comparePeer->set("_organization", $organization);
        $myCollectionsIDs = array();
        $filter = null;

        $organizationModel = new CCExModelsOrganization();
        $currentPeerID = $data["currentPeer"];
        $currentPeer = $organizationModel->getItemUnrestrictedBy("_organization_id", $currentPeerID);

        if (array_key_exists('collectionsSelected', $data) && array_key_exists('collectionsMode', $data) && $data["collectionsMode"] == "separated") {
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

        $series = $comparePeer->series($currentPeer, $myCollectionsIDs, $myYear, $filter);
        
        $return['success'] = true;            
        $return['series'] = $series;
        
        echo json_encode($return);
    }
}
