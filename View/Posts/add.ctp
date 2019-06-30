<!-- File: /app/View/Posts/add.ctp -->

<h1>Add Post</h1>
<?php
echo $this->Form->create('Post'); // creat form atuomatik 
echo $this->Form->input('title'); 
echo $this->Form->input('body', array('rows' => '3')); // empty box to write >> input 
echo $this->Form->end('Save Post'); //end .. this for save button
?>