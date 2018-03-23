<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Profile : '.$connected['name']);
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
        <div  id="main-p">
           Profile <?=$connected['name']?>
           <?= $this->Html->link('Edit Profile', ['controller' => 'Users', 'action' => 'edit',$connected['id']])?>
        </div>
    </div>
    <div class="col-md-3">
        <div id="side-p">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
</div>


