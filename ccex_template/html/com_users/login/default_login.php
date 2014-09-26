<?php
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');

$redirect_url = JRoute::_('/');

$app = JFactory::getApplication();
$redirect = $app->input->get('redirect_url', null);
$navbar = $app->input->get('navbar', null);

if($redirect){
    if($redirect == "analyseglobal"){
       $redirect_url = JRoute::_('/compare-costs?view=analyse&layout=global');
    }else if($redirect == "analysepeer"){
       $redirect_url = JRoute::_('/compare-costs?view=analyse&layout=peer');
    }else if($redirect == "analyseself"){
       $redirect_url = JRoute::_('/compare-costs?view=analyse&layout=self');
    }
}

?>

<?php if($redirect && $redirect == "analyseglobal"){ ?>
    <ul class="nav nav-pills nav-wizard" style="margin-bottom: 30px;">
        <li class="active">
            <a href="javascript:void(0)" class="wizard-label">
                <span class="wizard-number">1</span> 
                Sign in
                <i class="fa fa-check icon-status"></i>
            </a>
            <div class="nav-arrow"></div>
        </li>
        <li class="wizard-li-lock">
            <div class="nav-wedge"></div>
            <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
                <span class="wizard-number">2</span> 
                Organisation profile 
                <i class="fa fa-lock icon-status"></i>
            </a>
            <div class="nav-arrow"></div>
        </li>
        <li class="wizard-li-lock">
            <div class="nav-wedge"></div>
            <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
                <span class="wizard-number">3</span> 
                Cost data sets 
                <i class="fa fa-lock icon-status"></i>
            </a>
            <div class="nav-arrow"></div>
        </li>
        <li class="wizard-li-lock">
            <div class="nav-wedge"></div>
            <a href="javascript:void(0)" class="wizard-label wizard-label-lock">
                <span class="wizard-number">4</span> 
                Compare costs 
                <i class="fa fa-lock icon-status"></i>
            </a>
        </li>
    </ul>
<?php } ?>

<div class="col-md-offset-1 col-md-10">
	<h1>Sign In</h1>
	<p>Please fill out the following fields to access your account. Don't have an account? <a href="<?php echo JRoute::_('index.php?option=com_users&view=registration'); ?>">Sign Up Here</a></p>
	<form class="form-horizontal" action="<?php echo JRoute::_('index.php?option=com_users&task=user.login'); ?>" method="post" role="form">
		<div class="form-group">
		    <label class="col-sm-2 control-label" for="organisation_name">Username</label>
		    <div class="col-sm-6">
		        <input class="form-control" type="text" name="username" id="username" type="text">
		    </div>
		    <div class="col-sm-2" style="padding-top: 7px;margin-left: -15px;">
		        <a style="color: grey" href="<?php echo JRoute::_('index.php?option=com_users&view=remind'); ?>" alt="<?php echo JText::_('COM_USERS_LOGIN_REMIND'); ?>">Forgot?</a>
		    </div>
		</div>
		<div class="form-group">
		    <label class="col-sm-2 control-label" for="organisation_name">Password</label>
		    <div class="col-sm-6">
		        <input class="form-control" type="password" name="password" id="password"> 
		    </div>
		    <div class="col-sm-2" style="padding-top: 7px;margin-left: -15px;">
		        <a style="color: grey" href="<?php echo JRoute::_('index.php?option=com_users&view=reset'); ?>" alt="<?php echo JText::_('COM_USERS_LOGIN_RESET'); ?>">Forgot?</a>
		    </div>
		</div>
	    <div class="form-group">
	        <div class="col-md-offset-5 col-sm-3">
	            <input class="btn btn-success btn-block" type="submit" value="<?php echo JText::_('JLOGIN'); ?>"/>
	    	</div>
	    </div>
	    <input type="hidden" name="return" value="<?php echo base64_encode($redirect_url); ?>" />
		<?php echo JHtml::_('form.token'); ?>
	</form>
</div>
