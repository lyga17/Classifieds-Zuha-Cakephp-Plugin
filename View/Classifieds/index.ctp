<div id="DirectoryIndexView">
<?php if(!empty($classifieds)): ?>
	
	<?php foreach($classifieds as $classified): ?>
	
	<div class="row-fluid">
		<div class="span3">
			<h4><?php echo $classified['Classified']['title']; ?></h4>
			<div class="image"><?php echo $this->Media->display($classified['Media'][0], array('width' => 150, 'height' => 150)); ?></div>
			<p><?php echo $classified['Classified']['price']; ?></p>
			<p><?php echo $classified['Classified']['description']; ?></p>
			<p><?php echo $classified['Classified']['condition']; ?></p>
			<p><?php echo $classified['Classified']['data']; ?></p>
		</div>
		<div class="span3">
			<address>
				<p><?php echo $classified['Classified']['city']; ?>, <?php echo $classified['Classified']['state']; ?> <?php echo $classified['Classified']['zip']; ?></p>
			</address>
		</div>
		<div class="span3">
			<p><?php echo $classified['Classified']['payment_terms']; ?></p>
			<p><?php echo $classified['Classified']['shipping_terms']; ?></p>
			<p><?php echo $classified['Classified']['weight']; ?></p>
			<p><?php echo $classified['Classified']['posted_date']; ?></p>
			<p><?php echo $classified['Classified']['expire_date']; ?></p>
		</div>
		<div class="span3 action-links">
			<?php echo $this->Html->link('View', array('action' => 'view', $classified['Classified']['id']), array('class' => 'btn')); ?>
			<?php echo $this->Html->link('Edit', array('action' => 'edit', $classified['Classified']['id']), array('class' => 'btn')); ?>
			<?php echo $this->Form->postLink('Delete', array('action' => 'delete', $classified['Classified']['id']), array('class' => 'btn'), ('Are you sure you want to delete '.$classified['Classified']['title'].'?')); ?>
		</div>
	</div>	
	
	<?php endforeach; ?>

<?php else: ?>
	
	<h4>No Results Found</h4>
	
<?php endif; ?>
</div>

<?php echo $this->Element('paging'); ?>


<script type="text/javascript">
	(function($) {
    	$('#searchFrom').submit(function(){
            $.get('/phonebooks/phonebooks/search.json', {search: $('#SearchInput').val()}, function(json) {
            	var html = '<h2 style="font-size: 18px">Participating Locations for <span style="color: red; font-style: italic;">'+$('#SearchInput').val()+'</span></h2><p>We found '+json.locations.length+' centers within distance of 50 miles</p><table class="locations" cellpadding="0" cellspacing="0"><thead><tr><th class="name">MATHNASIUM CENTER NAME</th><th class="contact"></th></tr></thead><tbody>';
                
                for(i=0 ; i < json.locations.length ; i++ ) {
                    html += '<tr><td width="320"><b><a href="http://' + json.locations[i].Phonebook.website + '" class="center_name" target="_blank">' + json.locations[i].Phonebook.name + '</a></b><br><br>' + json.locations[i].Phonebook.address_1 + '<br>' + json.locations[i].Phonebook.city + ',' + json.locations[i].Phonebook.state + ' ' + json.locations[i].Phonebook.zip + '          <br>Distance: ' + json.locations[i].Phonebook.distance + ' Miles<br><br><a href="' + json.locations[i].Phonebook.mapurl + '" target="_blank">Map This Address</a><br><br><a href="http://' + json.locations[i].Phonebook.website + '" target="_blank">' + json.locations[i].Phonebook.website + '</a></td><td><div>P: ' + json.locations[i].Phonebook.phone + '<br />';
                    if (json.locations[i].Phonebook.phone2.length > 0) {
                    	html += 'P: ' + json.locations[i].Phonebook.phone2 + '<br />';
                    }
                    html += 'participation date: ' + json.locations[i].Phonebook.description + '</div></td></tr>';

                }
                html += '</tbody></table>';
                $('#SearchResults').html(html);
            });
            return false;
        });
    })(jQuery);
</script>
