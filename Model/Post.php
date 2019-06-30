<?php
class Post extends AppModel {
    public $belongsTo = array(
        'User' => array(
        'className' => 'User'
        ));

        public $hasMany = array(
            'Comment' => array(
                'className' => 'Comment',
                'foreignKey' => 'post_id'));

    public $validate = array
    (
        'title' => array('rule' => 'notBlank'),
        'body' => array('rule' => 'notBlank')
    );
    public function isOwnedBy($post, $user) {
        return $this->field('id', array('id' => $post)) !== false;
    }

   
}

?>