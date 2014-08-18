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
?>
<div class="reset <?php echo $this->pageclass_sfx?>">
	<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<h1>
			<?php echo $this->escape($this->params->get('page_heading')); ?>
		</h1>
	</div>
	<?php endif; ?>

	<form id="user-registration" action="<?php echo JRoute::_('index.php?option=com_users&task=reset.request'); ?>" method="post" class="form-validate form-horizontal">
		<div class="col-md-offset-1 col-md-10">
			<h1>Forgot your password?</h1>
			<?php foreach ($this->form->getFieldsets() as $fieldset) : ?>
			<p><?php echo JText::_($fieldset->label); ?></p>
			<fieldset style="padding: 0 0 25px 0;">
				<?php foreach ($this->form->getFieldset($fieldset->name) as $name => $field) : ?>
					<?php $field->class = "form-control"; ?>

					<div class="control-group">
						<div class="control-label">
							<div class="col-md-3 control-label" style="text-align:right">
								<?php echo $field->label; ?>
							</div>
						</div>
						<div class="controls">
							<div class="col-md-6">
								<?php echo $field->input; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</fieldset>
			<?php endforeach; ?>
			<div class="form-actions">
				<div class="col-md-offset-6 col-md-3">
					<button type="submit" class="btn btn-primary validate btn-block"><?php echo JText::_('JSUBMIT'); ?></button>
				</div>
				<?php echo JHtml::_('form.token'); ?>
			</div>
		</div>
	</form>
</div>
