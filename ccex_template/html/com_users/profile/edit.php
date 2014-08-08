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
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

//load user_profile plugin language
$lang = JFactory::getLanguage();
$lang->load('plg_user_profile', JPATH_ADMINISTRATOR);
?>
<div class="profile-edit<?php echo $this->pageclass_sfx?>">

<form id="member-profile" action="<?php echo JRoute::_('index.php?option=com_users&task=profile.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
		<?php foreach ($this->form->getFieldsets() as $group => $fieldset):// Iterate through the form fieldsets and display each one.?>
			<?php $fields = $this->form->getFieldset($group);?>
			<?php if (count($fields)):?>
			<fieldset>
				<?php if (isset($fieldset->label)):// If the fieldset has a label set, display it as the legend.?>
					<?php if($fieldset->name == "core") { ?>
						<h2><?php echo JText::_($fieldset->label); ?></h2>
					<?php } else { ?>
						<h3><?php echo JText::_($fieldset->label); ?></h3>
					<?php } ?>
				<?php endif;?>
				<?php $permittedFields = array("name", "username", "password1", "password2", "email1", "email2", "timezone", "language", "admin_language"); ?>
				<?php foreach ($fields as $field):// Iterate through the fields in the set and display them.?>
					<?php if (!$field->hidden  && in_array($field->fieldname, $permittedFields)):// If the field is hidden, just display the input.?>
						<div class="form-group">
							<?php $field->class = "form-control"; ?>
							<label class="col-sm-3 control-label" for="organisation_name"><?php echo $field->label; ?></label>
							<div class="col-sm-9">
					            <?php echo $field->input; ?>
					        </div>
					    </div>
					<?php endif;?>
				<?php endforeach;?>
			</fieldset>
			<?php endif;?>
		<?php endforeach;?>
		<br/>
		<div class="form-actions utils row">
			<div class="col-sm-2">
				<button type="submit" class="btn btn-success btn-block validate"><span><?php echo JText::_('JSUBMIT'); ?></span></button>
			</div>
			<div class="col-sm-2 col-sm-offset-8">
				<a class="btn btn-default btn-block btn-border" href="<?php echo JRoute::_('index.php?option=com_users&view=profile'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
			</div>

			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="profile.save" />
			<?php echo JHtml::_('form.token'); ?>
		</div>
	</form>
</div>
