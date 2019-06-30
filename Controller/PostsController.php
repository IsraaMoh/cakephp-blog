<?php
class PostsController extends AppController 
{
    public $helpers = array('Html', 'Form');
    public function index() 
    {
        // posts this is vairable and the second section is the value of this virable like this maybe ( $x= set('z',4))
        $this->set('posts', $this->Post->find('all'));
        // find all >> this method get all things from data base 
    }
 
    public function view($id = null) 
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('post', $post);
        //debug ($post); exit;
    }
  //--------------------------------------------------------------
  
  public function getall($id = null) 
  {
    $this->autoRender = false;
    //$id=$_GET['id'];
   $id= $this->request->query['id'];
      if (!$id) {
         echo json_encode(['Invalid post']);
      }

      $post = $this->Post->findById($id);
      if (!$post) {
        echo json_encode(['Invalid post']);
      }
     echo json_encode($post);
    }
      //--------------------------------------------------------

    public function add() 
    {
        if ($this->request->is('post')) { 
            //Added this line
            //debug( $this->request->data) ; exit ;
            $this->request->data['Post']['user_id'] = $this->Auth->user('id'); //  $this->request->data this is line save the data 
            $this->Post->create(); // we should write this before save to identical choice 
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been saved.'));
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }
    
        $post = $this->Post->findById($id);
        if (!$post) {
            throw new NotFoundException(__('Invalid post'));
        }
    
        if ($this->request->is(array('post', 'put'))) {
            $this->Post->id = $id;
            if ($this->Post->save($this->request->data)) {
                $this->Flash->success(__('Your post has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your post.'));
        }
    
        if (!$this->request->data) { // write this after check cos we want to waite until the user writing 
            $this->request->data = $post;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
    
        if ($this->Post->delete($id)) {
            $this->Flash->success(
                __('The post with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The post with id: %s could not be deleted.', h($id))
            );
        }
    
        return $this->redirect(array('action' => 'index'));
    }
    


public function isAuthorized($user) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $postId = (int) $this->request->params['pass'][0];
        if ($this->Post->isOwnedBy($postId, $user['id'])) {
            return true; 
        }
    }

    return parent::isAuthorized($user);
}


}


?>
