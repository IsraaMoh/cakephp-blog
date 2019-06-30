<?php
class CommentsController extends AppController 
{
    public $helpers = array('Html', 'Form');
    public function index() 
    {
        // posts this is vairable and the second section is the value of this virable like this maybe ( $x= set('z',4))
        $this->set('comms', $this->Comment->find('all')); // find all >> this method get all things from data base 
    }
 
    public function view($id = null) 
    {
        if (!$id) {
            throw new NotFoundException(__('Invalid post'));
        }

        $comm = $this->Comment->findById($id);
        if (!$comm) {
            throw new NotFoundException(__('Invalid post'));
        }
        $this->set('comms', $comm);
    }

    public function add() 
    {
        if ($this->request->is('post')) { 
            //Added this line
           // debug( $this->request->data) ; exit ;
           $this->request->data['Comment']['user_id'] = $this->Auth->user('id'); //  $this->request->data this is line save the data 
            $pId =$this->request->data['Comment']['post_id'];
           // $this->Comment->create(); // we should write this before save to identical choice 
            if ($this->Comment->save($this->request->data)) {
                $this->Flash ->Success(__('Your comment has been saved.'));
                return $this->redirect(array('controller' => 'Posts','action' => 'view',$pId ));
            }
        }
    }

    public function edit($id = null) {
        if (!$id) {
            throw new NotFoundException(__('Invalid Comment'));
        }
    
        $comm = $this->Comment->findById($id);
        if (!$comm) {
            throw new NotFoundException(__('Invalid Comment'));
        }
    
        if ($this->request->is(array('comms', 'put'))) {
            $this->Comment->comm_id = $id;
            if ($this->Comment->save($this->request->data)) {
                $this->Flash->success(__('Your Comment has been updated.'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Flash->error(__('Unable to update your Comment.'));
        }
    
        if (!$this->request->data) { // write this after check cos we want to waite until the user writing 
            $this->request->data = $comm;
        }
    }

    public function delete($id) {
        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }
    
        if ($this->Comment->delete($id)) {
            $this->Flash->success(
                __('The Comment with id: %s has been deleted.', h($id))
            );
        } else {
            $this->Flash->error(
                __('The Comment with id: %s could not be deleted.', h($id))
            );
        }
    
        return $this->redirect(array('action' => 'index'));
    }
    


public function isAuthorized($comms) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $comm_Id = (int) $this->request->params['pass'][0];
        if ($this->Comment->isOwnedBy($comm_Id, $comms['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($comms);
}


}


?>
