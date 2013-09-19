<div>
	<h1>Classifieds by category</h1>
	<hr />
	<ul class="thumbnails">
<?php foreach ($this->request->data as $category) : ?>

	  <li class="span4">
	  	<h3>
	  		<?php echo $this->Html->link($category['Category']['name'], array('action' => 'index', '?' => array('categories' => $category['Category']['name']))) ?>
	  		<small>(<?php echo $category['Category']['record_count'] ?>)</small>
	  	</h3>
	  	<p><?php echo $category['Category']['description'] ?></p>
	  </li>

<?php endforeach; ?>
	</ul>
</div>
