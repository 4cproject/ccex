<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
?>

<div class="col-md-offset-1 col-md-10">
	<h1>Sign Up</h1>
	<p>Please fill out the following fields to create your account. Already have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=login'); ?>">Sign In Here</a></p>
	<form class="form-horizontal" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" role="form">
		<div class="form-group">
		    <label class="col-sm-3 control-label" for="organisation_name">Name</label>
		    <div class="col-sm-6">
		        <input class="form-control" type="text" name="jform[name]" id="jform_name">
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label" for="organisation_name">Username</label>
		    <div class="col-sm-6">
		        <input class="form-control" type="text" name="jform[username]" id="jform_username"> 
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label" for="organisation_name">Password</label>
		    <div class="col-sm-6">
		        <input class="form-control" type="password" name="jform[password1]" id="jform_password1" value="" autocomplete="off"> 
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label" for="organisation_name">Confirm Password</label>
		    <div class="col-sm-6">
		        <input class="form-control"  type="password" name="jform[password2]" id="jform_password2" value="" autocomplete="off"> 
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label" for="organisation_name">Email Address</label>
		    <div class="col-sm-6">
		        <input class="form-control" type="email" name="jform[email1]" class="validate-email" id="jform_email1"> 
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-3 control-label" for="organisation_name">Confirm Email Address</label>
		    <div class="col-sm-6">
		        <input class="form-control" type="email" name="jform[email2]" class="validate-email" id="jform_email2"> 
		    </div>
		</div>
	    <div class="form-group">
	        <div class="col-md-offset-6 col-sm-3">
	            <input class="btn btn-success btn-block" type="submit" value="<?php echo JText::_('JREGISTER');?>"/>
	    </div>
	    <input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('/')); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
