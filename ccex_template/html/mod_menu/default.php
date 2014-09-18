<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>
<?php // The menu class is deprecated. Use nav instead. ?>
<nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ccex-navbar">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
    </div>

  
    <div class="collapse navbar-collapse" id="ccex-navbar">
		<ul class="nav navbar-nav menu<?php echo $class_sfx;?>"
			<?php
				$tag = '';

				if ($params->get('tag_id') != null)
				{
					$tag = $params->get('tag_id') . '';
					echo ' id="' . $tag . '"';
				}
			?>>
			<?php
			foreach ($list as $i => &$item)
			{
				if ($item->link == "index.php?option=com_users&view=registration" && !JFactory::getUser()->get('guest')) {
					continue;
				}

				if ($item->link == "index.php?option=com_users&view=profile" || $item->link == "index.php?option=com_ccex&view=user&layout=profile") {
					if (JFactory::getUser()->get('guest')){
						continue;
					}else{
						$name = JFactory::getUser()->get('name', "Profile");
						$item->title = $name;
						$item->anchor_css .= "nav-name-ellipsis";
					}
				}

				$class = 'item-' . $item->id;

				if ($item->id == $active_id)
				{
					$class .= ' current';
				}

				if (in_array($item->id, $path))
				{
					$class .= ' active';
				}
				elseif ($item->type == 'alias')
				{
					$aliasToId = $item->params->get('aliasoptions');

					if (count($path) > 0 && $aliasToId == $path[count($path) - 1])
					{
						$class .= ' active';
					}
					elseif (in_array($aliasToId, $path))
					{
						$class .= ' alias-parent-active';
					}
				}

				if ($item->type == 'separator')
				{
					$class .= ' divider';
				}

				if ($item->deeper)
				{
					$class .= ' deeper';
				}

				if ($item->parent)
				{
					$class .= ' dropdown parent';
				}

				if ($item->link == "index.php?option=com_users&view=login"){
					$class .= ' navbar-right';
				}

				if ($item->link == "index.php?option=com_users&view=registration"){
					$class .= ' navbar-right';
				}

				if ($item->link == "index.php?option=com_users&view=profile" || $item->link == "index.php?option=com_ccex&view=user&layout=profile"){
					$class .= ' navbar-right';
				}

              	if ($item->deeper){ 
              		$class .= " dropdown";
              	}
              
				if (!empty($class))
				{
					$class = ' class="' . trim($class) . '"';
				}
              
				echo '<li' . $class . '>';
				
				if ($item->link == "index.php?option=com_users&view=login" && !JFactory::getUser()->get('guest')){ ?>
					<form action="<?php echo JRoute::_('index.php?option=com_users&task=user.logout'); ?>" method="post" class="form-horizontal">
						<input type="submit" value="Sign out"></input>
						<input type="hidden" name="return" value="<?php echo base64_encode(JRoute::_('index.php?option=com_users&view=login')); ?>" />
						<?php echo JHtml::_('form.token'); ?>
					</form> <?php
				}else{
					// Render the menu item.
					switch ($item->type) :
						case 'separator':
						case 'url':
						case 'component':
						case 'heading':
							require JModuleHelper::getLayoutPath('mod_menu', 'default_' . $item->type);
							break;

						default:
							require JModuleHelper::getLayoutPath('mod_menu', 'default_url');
							break;
					endswitch;
				}
				
				// The next item is deeper.
				if ($item->deeper)
				{
					echo '<ul class="dropdown-menu width-auto" role="menu">';
				}
				elseif ($item->shallower)
				{
					// The next item is shallower.
					echo '</li>';
					echo str_repeat('</ul></li>', $item->level_diff);
				}
				else
				{
					// The next item is on the same level.
					echo '</li>';
				}
			}
			?>
		</ul>
	</div>
</nav>
