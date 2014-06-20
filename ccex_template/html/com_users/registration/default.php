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
<!-- <div class="registration<?php echo $this->pageclass_sfx?>">
<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1><?php echo $this->escape($this->params->get('page_heading')); ?></h1>
	</div>
<?php endif; ?>

	<form id="member-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=registration.register'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
<?php foreach ($this->form->getFieldsets() as $fieldset): // Iterate through the form fieldsets and display each one.?>
	<?php $fields = $this->form->getFieldset($fieldset->name);?>
	<?php if (count($fields)):?>
		<fieldset>
		<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.
		?>
			<legend><?php echo JText::_($fieldset->label);?></legend>
		<?php endif;?>
		<?php foreach ($fields as $field) :// Iterate through the fields in the set and display them.?>
			<?php if ($field->hidden):// If the field is hidden, just display the input.?>
				<?php echo $field->input;?>
			<?php else:?>
				<div class="control-group">
					<div class="control-label">
					<?php echo $field->label; ?>
					<?php if (!$field->required && $field->type != 'Spacer') : ?>
						<span class="optional"><?php echo JText::_('COM_USERS_OPTIONAL');?></span>
					<?php endif; ?>
					</div>
					<div class="controls">
						<?php echo $field->input;?>
					</div>
				</div>
			<?php endif;?>
		<?php endforeach;?>
		</fieldset>
	<?php endif;?>
<?php endforeach;?>
		<div class="form-actions">
			<button type="submit" class="btn btn-primary validate"><?php echo JText::_('JREGISTER');?></button>
			<a class="btn" href="<?php echo JRoute::_('');?>" title="<?php echo JText::_('JCANCEL');?>"><?php echo JText::_('JCANCEL');?></a>
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="registration.register" />
			<?php echo JHtml::_('form.token');?>
		</div>
	</form>
</div>
 -->
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
	    <input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('/ccex/')); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
