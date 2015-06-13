<?php
/**
* @version		v.3.2 registrationpro $
* @package		registrationpro
* @copyright	Copyright � 2009 - All rights reserved.
* @license  	GNU/GPL		
* @author		JoomlaShowroom.com
* @author mail	info@JoomlaShowroom.com
* @website		www.JoomlaShowroom.com
*
*/

defined('_JEXEC') or die('Restricted access');

JHTML::_('behavior.tooltip');

$n 	= count($this->rows);
$i	= 0;
$k 	= 0;

if($this->discount_name == "G"){
	$toggle_func 		= "paymentcheckAll_discount_group";	
}else{
	$toggle_func 		= "paymentcheckAll_discount_early";
}

?>
<table border="1" cellpadding="0" cellspacing="0" class="adminform">
		
	<tr>
		<td width="10px"><input type="checkbox" name="toggle" value="" onClick="<?php echo $toggle_func; ?>(<?php echo count( $this->rows); ?>);" /></td>
		<td width="150px" style="text-align:center"><strong>
			<?php
			if($this->discount_name == "G"){
				echo JText::_('ADMIN_EVENTS_GROUP_MINIMUM_TICKETS'); 
			}else if($this->discount_name == "E"){
				echo JText::_('ADMIN_EVENTS_EARLY_DISCOUNT_DATE'); 
			}?>
			</strong>
		</td>										
		<td width="150px" style="text-align:center"><strong><?php echo JText::_('ADMIN_EVENTS_EARLY_DISCOUNT_PER_TICKET'); ?></strong></td>
	</tr>

<?php		
	//foreach ($this->rows as $product)
	for ($i=0, $n=count( $this->rows ); $i < $n; $i++) 
	{
		$discount = $this->rows[$i];
		//echo "<pre>"; print_r($discount); exit;
		
		if($this->discount_name == $discount->discount_name){														
			$pchecked 	= JHTML::_('grid.checkedout',   $discount, $i );
	?>
			<tr> 												
				<td><?php echo $pchecked;?></td>
				<td style="text-align:center">
					<?php						
						if($discount->discount_name == "G"){
							echo $discount->min_tickets;
						}else if($discount->discount_name == "E"){
							echo $discount->early_discount_date;
						}
					?>
				</td>
				<td style="text-align:center">
					<?php
						if($discount->discount_type == 'A'){
							echo $this->regpro_config['currency_sign']."&nbsp;".$discount->discount_amount;
						}else{
							echo $discount->discount_amount."&nbsp;%";
						}
					?>
				</td>											
			</tr>
	<?php
		}												
	}
	
	if(count($this->rows) <= 0){
		echo "<tr><td colspan='3' style='text-align:center'>No Record Found</td></tr>";
	}
	
	if(intval($this->event_id) > 0){
		echo "<input type='hidden' name='event_id' value='".$this->event_id."' />";
	}
	?>		
</table>