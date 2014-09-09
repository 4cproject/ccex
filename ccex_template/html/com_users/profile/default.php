<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_users
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication(); 
$app->redirect('/profile'); 
?>
<div class="profile <?php echo $this->pageclass_sfx?>">

    <?php echo $this->loadTemplate('core'); ?>
    <?php echo $this->loadTemplate('params'); ?>
    <?php echo $this->loadTemplate('custom'); ?>
    
    <br/>
    <?php if (JFactory::getUser()->id == $this->data->id) : ?>
        <div class="utils">
            <div class="col-sm-2">
                <a class="btn btn-primary btn-block" href="<?php echo JRoute::_('index.php?option=com_users&task=profile.edit&user_id='.(int) $this->data->id);?>">
                    <?php echo JText::_('COM_USERS_EDIT_PROFILE'); ?>
                </a>
            </div>
            <div class="col-sm-2 col-sm-offset-8">
                <form action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post" class="form-horizontal">
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" class="btn btn-danger btn-block"><span class="icon-arrow-left icon-white"></span> <?php echo JText::_('JLOGOUT'); ?></button>
                        </div>
                    </div>
                    <input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_users&view=login')); ?>" />
                    <?php echo JHtml::_('form.token'); ?>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
