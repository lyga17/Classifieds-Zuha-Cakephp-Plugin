<div id="ClassifiedsAddEdit">
	
	<?php echo $this->Form->create('Classifieds.Classified'); ?>
	
		<?php if(CakePlugin::loaded('Media')) { echo $this->Element('Media.media_selector', array('multiple' => true)); } ?>
		
		<?php if(CakePlugin::loaded('Categories')) {echo $this->Form->checkbox('Category.Category',$categories);} ?>
		
		<?php if(isset($this->request->data['Classified']['id'])) {echo $this->Form->input('Classified.id'); } ?>
		
		<?php echo $this->Form->input('Classified.title', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.description', array('type' => 'textarea')); ?>
		
		<?php echo $this->Form->input('Classified.condition', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.payment_terms', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.shipping_terms', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.price', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.city', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.state', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.zip', array('type' => 'text')); ?>
		
		<?php echo $this->Form->input('Classified.weight', array('type' => 'text')); ?>
	
		<?php echo $this->Form->input('Classified.posted_date'); ?>
		
		<?php echo $this->Form->input('Classified.expire_date'); ?>
		
	<?php echo $this->Form->end('Save'); ?>
</div>
