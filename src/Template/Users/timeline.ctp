<?php
/**
  * @var \App\View\AppView $this
  * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
  */
    $this->assign('title', 'Timeline : Welcome '.$connected['name']);
?>


<!--<div class="linkWebm" style="width:200px;height: 200px;background-color: gray; border:2px solid white;margin-top: 100px;position: absolute;z-index: 100;margin-left: 200px; border-radius: 8px; ">
  <video id="myWebmedia" style="background-color: #9869a9; width: 200px; height: 156px;"></video>
  <button class="webmAccess" style="color: white;margin: -7px 0px 0px 0px; height: 40px;
    width: 196px;">
      <span class="cam-access">Camera</span>|<span class="addPicture">ADD</span>
  </button>
  <canvas id="canvas" width="400" height="400"></canvas>
</div>-->
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



