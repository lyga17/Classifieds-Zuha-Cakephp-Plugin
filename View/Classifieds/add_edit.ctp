<div id="ClassifiedsAddEdit">
	
	<?php echo $this->Form->create('Classifieds.Classified'); ?>
	
		<?php if(CakePlugin::loaded('Media')) { echo $this->Element('Media.media_selector', array('multiple' => false)); } ?>
		
		<?php echo $this->Form->input('Classified.title'); ?>
		
		<?php echo $this->Form->input('Classified.description', array('type' => 'textarea')); ?>
		
		<?php echo $this->Form->input('Classified.condition'); ?>
		
		<?php echo $this->Form->input('Classified.payment_terms'); ?>
		
		<?php echo $this->Form->input('Classified.shipping_terms'); ?>
		
		<?php echo $this->Form->input('Classified.price'); ?>
		
		<?php echo $this->Form->input('Classified.city'); ?>
		
		<?php echo $this->Form->input('Classified.state'); ?>
		
		<?php echo $this->Form->input('Classified.zip'); ?>
		
		<?php echo $this->Form->input('Classified.weight'); ?>
	
		<?php echo $this->Form->input('Classified.posted_date'); ?>
		
		<?php echo $this->Form->input('Classified.expire_date'); ?>
	
		<?php echo $this->Form->input('Classified.data'); ?>
		
	<?php echo $this->Form->end('Save'); ?>
</div>
