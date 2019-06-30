<?php
class Comment extends AppModel {
    public $belongsTo = array(
        'Post' => array(
        'className' => 'Post'));

    public $hasOne = array(
        'User' => array('className' => 'User')
    );

    public $validate = array
    (
        'commentArray' => array('rule' => 'notBlank')
    );
    //public function isOwnedBy($post, $comm) {
     //   return $this->field('id', array('id' => $post)) !== false;
   // }

   
}

?>