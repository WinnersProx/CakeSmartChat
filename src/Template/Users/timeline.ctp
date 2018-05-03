<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Timeline : Welcome '.$connected['name']);
?>



<div class="container-customized">
    <div class="col-md-3">
        <div id="left-p" class="left-one">
            <?= $this->element('Inc/left_menu');?>
        </div>
    </div>
    <div class="col-md-6">
        <div  id="main-p">
            <?= $this->element('Inc/main_menu');?>
            
            
        </div>
    </div>
    <div class="col-md-2 ">
        <div id="side-p" class="side-one">
           <?= $this->element('Inc/side_menu');?>
        </div>
    </div>
    <script>
          /*var socket = io("localhost:8765");
          socket.on('connection', function (socket) {
                console.log("New connection");
          });

          socket.on('reconnect_error', function () {
            console.log('attempt to reconnect has failed');
          });
          */

    </script>



