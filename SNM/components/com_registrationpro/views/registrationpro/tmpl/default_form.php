<?php
/**
* @version		v.3.2 registrationpro $
* @package		registrationpro
* @copyright	Copyright © 2009 - All rights reserved.
* @license  	GNU/GPL		
* @author		JoomlaShowroom.com
* @author mail	info@JoomlaShowroom.com
* @website		www.JoomlaShowroom.com
*
*/

// no direct access
defined('_JEXEC') or die('Restricted access');

?>
<script type="text/javascript">
<!--
	function validateForm( frm ) {
		var valid = document.formvalidator.isValid(frm);
		if (valid == false) {
			// do field validation
			// your custom code here
			return false;
		} else {
			frm.submit();
		}
	}
// -->
</script>
<?php
if ( $this->params->def( 'show_page_title', 1 ) && $this->params->get('page_title') ) {
?>
<div class="contentheading<?php echo $this->params->get( 'pageclass_sfx' ); ?>">
	<?php
	$page_title = ($this->params->get('page_title'))? $this->escape($this->params->get('page_title')) : '' ;
	echo $page_title;
	?>
</div>
<?php
}
?>
<form action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm" id="adminForm" class="form-validate">
<!-- YOUR CUSTOM FORM HERE -->
<!-- --------------------- -->
<!-- --------------------- -->
<!-- --------------------- -->
<button class="button validate" type="submit"><?php echo JText::_('Send'); ?></button>
<input type="hidden" name="option" value="com_registrationpro" />
<input type="hidden" name="task" value="submit" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>
<?php
?>