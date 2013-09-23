<div class="classifieds form">
	<?php echo $this->Form->create('Classifieds.Classified'); ?>
		<div class="row-fluid">
			<div class="span4">
				<?php echo $this->Form->input('Classified.title', array('type' => 'text')); ?>
			</div>
			<div class="span4">
				<?php echo $this->Form->input('Classified.expire_date', array('label' => 'Expiration Date', 'type' => 'datetimepicker')); ?>
			</div>
			<div class="span4">
				<?php if(CakePlugin::loaded('Media')) : ?>
					<?php echo $this->Element('Media.media_selector', array('media' => $this->request->data['Media'], 'multiple' => true)); ?>
				<?php endif; ?>
			</div>
		</div>
		
		<div class="row-fluid">
			<?php echo $this->Form->input('Classified.description', array('type' => 'textarea')); ?>
		</div>		
		
		<div class="row-fluid">
			<div class="span3">
				<?php echo $this->Form->input('Classified.price', array('type' => 'text')); ?>
			</div>
			<div class="span3">
				<?php echo $this->Form->input('Classified.condition', array('type' => 'text')); ?>
			</div>
			<div class="span3">
				<?php echo $this->Form->input('Classified.payment_terms', array('type' => 'text')); ?>
			</div>
			<div class="span3">
				<?php echo $this->Form->input('Classified.shipping_terms', array('type' => 'text')); ?>
			</div>
		</div>
		
		<div class="row-fluid">
			<div class="span3">
				<?php if (CakePlugin::loaded('Categories')) : ?>
					<?php echo $this->Form->input('Category.Category', array('type' => 'select', 'options' => $categories, 'multiple' => 'checkbox', 'limit' => 3)); ?>
				<?php endif; ?>
			</div>
			<div class="span3">				
				<?php echo $this->Form->input('Classified.city', array('type' => 'text')); ?>
			</div>
			<div class="span3">				
				<?php echo $this->Form->input('Classified.state', array('empty' => '- choose -', 'options' => states())); ?>
			</div>
			<div class="span3">			
				<?php echo $this->Form->input('Classified.zip', array('type' => 'text')); ?>
			</div>				
		</div>
	<?php //echo $this->Form->input('Classified.weight', array('type' => 'text')); ?>
	<?php echo $this->Form->end('Save'); ?>
</div>
