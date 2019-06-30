<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>
<p> <?php echo('Add comment '); ?> </p>
<p> <?php echo $this->Form->create('Post'); ?> </p>
<p> <?php echo $this->Form->input('body', array('rows' => '3'));  ?> </p> 
<p> <?php echo $this->Form->end('comment'); ?> </p>
