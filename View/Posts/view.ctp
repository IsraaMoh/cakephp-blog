<!-- File: /app/View/Posts/view.ctp -->

<h1><?php echo h($post['Post']['title']); ?></h1>

<p><small>Created: <?php echo $post['Post']['created']; ?></small></p>

<p><?php echo h($post['Post']['body']); ?></p>
<p> <?php 
          echo $this->Form->create( 'Comment', [
            'url' => [
                'controller' => 'Comments',
                'action' => 'add'
            ]
        ]);?> </p>

<p> <?php echo $this->Form->input('comment', array('rows' => '4')); ?> </p> 
<p> <?php echo $this->Form->input('post_id', array('type' => 'hidden', 'value'=> $post['Post']['id'])); ?> </p>
<p> <?php echo $this->Form->input('user_id', array('type' => 'hidden', 'value'=> $post['Post']['user_id'])); ?> </p> 
<p> <?php echo $this->Form->end('comment');  ?> </p>

<p> <?php foreach($post['Comment'] as $s ) : ?>
    <p> <?php echo $post['User']['role']; 
              echo ':  ';
              echo $post['User']['username']; ?> </p> 
    <p> <?php echo $s['comment'];?> </p> 
    <p> <?php echo $s['created'];?> </p> 
    <p> <?php echo ('-------------------------------------')?> </p> 
<?php endforeach; ?>