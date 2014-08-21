<?php

// no direct access
defined('_JEXEC') or die('Restricted access');

class CCExModelsContact extends CCExModelsDefault
{
    
    /**
     * Protected fields
     *
     */
    protected $_contact_id = null;
    protected $_pagination = null;
    protected $_total = null;
    
    function __construct() {
        parent::__construct();
    }
    
    public function getItem() {
        if (!is_numeric($this->_contact_id)) {
            return null;
        }
        
        $contact = parent::getItem();
        
        if ($contact) {
            return CCExHelpersCast::cast('CCExModelsContact', $contact);
        }
    }
    
    /**
     * Builds the query to be used by the Contact model
     * @return   object  Query object
     */
    protected function _buildQuery() {
        $db = JFactory::getDBO();
        $query = $db->getQuery(TRUE);
        
        $query->select('t.contact_id, message, sender_email, recipient_email, sender_organization_id, recipient_organization_id, sender_user_id, recipient_user_id');
        $query->from('#__ccex_contacts as t');
        
        return $query;
    }
    
    /**
     * Builds the filter for the query
     * @param    object  Query object
     * @return   object  Query object
     */
    protected function _buildWhere(&$query) {
        
        if (is_numeric($this->_contact_id)) {
            $query->where('t.contact_id = ' . (int)$this->_contact_id);
        }
        
        return $query;
    }
    
    /**
     * Override the default store
     *
     */
    public function store($data = null) {
        $data = $data ? $data : JRequest::get('post');
        $date = date("Y-m-d H:i:s");
        
        $row_contact = JTable::getInstance('contact', 'Table');
        if (!$row_contact->bind($data)) {
            return null;
        }
        
        $row_contact->modified = $date;
        if (!$row_contact->check()) {
            return null;
        }
        if (!$row_contact->store()) {
            return null;
        }
        
        return true;
    }
    
    /**
     * Delete a Contact
     * @param int      ID of the contact to delete
     * @return boolean True if successfully deleted
     */
    public function delete($id = null) {
        $app = JFactory::getApplication();
        $id = $id ? $id : $app->input->get('contact_id');
        
        if ($id) {
            $contact = JTable::getInstance('contact', 'Table');
            $contact->load($id);
            
            if ($contact->delete()) {
                return true;
            }
        }
        
        return false;
    }

    public function contact($senderOrganizationID, $recipientOrganizationID, $message){
        $data = array();
        $organizationModel = new CCExModelsOrganization();

        $organizations = $organizationModel->listItemsBy("_organization_id", $senderOrganizationID);
        $senderOrganization = array_shift($organizations);
        $senderOrganization = CCExHelpersCast::cast('CCExModelsOrganization', $senderOrganization);

        $organizations = $organizationModel->listItemsBy("_organization_id", $recipientOrganizationID);
        $recipientOrganization = array_shift($organizations);
        $recipientOrganization = CCExHelpersCast::cast('CCExModelsOrganization', $recipientOrganization);

        if($senderOrganization->user() && $recipientOrganization->user()){
          $senderUser = JFactory::getUser($sendSSerOrganization->user_id);
          $recipientUser = JFactory::getUser($recipientOrganization->user_id);
        } else {
          return false;
        }

        $data["sender_organization_id"] = $senderOrganizationID;
        $data["recipient_organization_id"] = $recipientOrganizationID;
        $data["sender_user_id"] = $senderOrganization->user_id;
        $data["recipient_user_id"] = $recipientOrganization->user_id;
        $data["sender_email"] = $senderUser->email;
        $data["recipient_email"] = $recipientUser->email;

        $data["message"] = $message;

        if($this->sendEmail($senderOrganization, $senderUser, $recipientUser, $message)){
            $this->store($data);
            return true;
        }else{
            return false;
        }
    }

    public function sendEmail($senderOrganization, $senderUser, $recipientUser, $message){
        $mailer = JFactory::getMailer();

        $config = JFactory::getConfig();
        $sender = array( 
            $config->get( 'config.mailfrom' ),
            $config->get( 'config.fromname' ) 
        );
         
        $mailer->setSender($sender);
        $mailer->addRecipient($recipientUser->email);

        $body = '<p>Dear ' . htmlspecialchars($recipientUser->name) . ',</p>'
              . '<p>' . htmlspecialchars($senderUser->name) . ' from ' . htmlspecialchars($senderOrganization->name) . ' has indicated that they would like to make contact with you through the <a href="curationexchange.org">Curation Costs Exchange (CCEx)</a>.</p>'
              . '<p>' . htmlspecialchars($senderUser->name) . ' has sent you the following personal message:</p>'
              . '<p><cite>' . nl2br(htmlspecialchars($message)) . '<cite></p>'
              . '<p>Your name and contact details have not been shared. If you would like to make contact with ' . htmlspecialchars($senderUser->name) . ' please email them directly using this address: <a href="mailto:' . htmlspecialchars($senderUser->email) . '">' . htmlspecialchars($senderUser->email) . '</a>'
              . '<br>All further contact with ' . htmlspecialchars($senderUser->name) . ' shall be outside the CCEx, and once you reply your contacts details will be visible to ' . htmlspecialchars($senderUser->name) . '.'
              . '<br>To decline this request please email the CCEx at: <a href="mailto:info@curationexchange.org">info@curationexchange.org</a> to let us know.</p>'
              . '<p>Kind regards'
              . '<br>The CCEx team.</p>';

        $mailer->setSubject('[CCEx] ' . htmlspecialchars($senderOrganization->name) . ' Contact Request');
        $mailer->isHTML(true);
        $mailer->Encoding = 'base64';
        $mailer->setBody($body);

        return $mailer->Send();
    }
}
