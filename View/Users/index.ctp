<!-- File: /app/View/Posts/index.ctp -->
<div class="users form">
    <h1>Users</h1>
    <table>
        <thead>
            <tr>
                <th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll',  'id' => 'CheckAll')); ?></th>
                <th><?php echo $this->Paginator->sort('username', 'Username');?>  </th> 
                <th><?php echo $this->Paginator->sort('created', 'Created');?></th> 
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>                       
            <?php $count=0; ?>
            <?php foreach($users as $user): ?>                
            <?php $count ++;?>
            <?php if($count % 2): echo '<tr>'; else: echo '<tr class="zebra">' ?>
            <?php endif; ?>
                <td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>
                <td><?php echo $this->Html->link( $user['User']['username']  ,   array('action'=>'edit', $user['User']['id']),array('escape' => false) );?></td>
                <td style="text-align: center;"><?php echo $this->Time->niceShort($user['User']['created']); ?></td>
                <td >
                <?php echo $this->Html->link(    "Edit",   array('action'=>'edit', $user['User']['id']) ); ?> | 
               
                <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $user['User']['id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
                </td>
            </tr>
            <?php endforeach; ?>
            <?php unset($user); ?>
        </tbody>
    </table>
    </div>                
    <?php echo $this->Html->link( "Add A New User.",   array('action'=>'add'),array('escape' => false) ); ?>
    <br/>
    <?php 
    echo $this->Html->link( "Logout",   array('action'=>'logout') ); 
    ?>