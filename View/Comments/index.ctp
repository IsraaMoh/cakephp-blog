<!-- File: /app/View/Posts/index.ctp -->

<h1>Comment of posts</h1>

<table>
    <tr>
        <th>Id</th>
        <th>Title of post</th>
        <th>Actions</th>
        <th>Created</th>
    </tr>

<!-- Here's where we loop through our $posts array, printing out post info -->
     
    <?php foreach ($comms as $c): ?>
    <tr>
        <td><?php echo $c['comment']['comm_id']; ?></td>
        <td>
            <?php
                echo $this->Html->link(
                    $c['comment']['comm_id'],
                    array('action' => 'view', $c['comment']['comm_id'])
                );
            ?>
        </td>
        <td>
            <?php
                echo $this->Form->postLink(
                    'Delete',
                    array('action' => 'delete', $c['comment']['comm_id']),
                    array('confirm' => 'Are you sure?')
                );
            ?>
            <?php
                echo $this->Html->link(
                    'Edit', array('action' => 'edit', $c['comment']['comm_id'])
                );
            ?>
            
        </td>
        <td>
            <?php echo $c['comment']['created']; ?>
        </td>
    </tr>
    <?php endforeach; ?>

</table>