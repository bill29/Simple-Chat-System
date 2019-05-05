
<div class="container">
	<div class="text-center">
		<span class="display-4">Simple chat system A</span>
	</div>

	<form id = "formChat" method = "post"  enctype="multipart/form-data" action = "/chat3/chat/feed">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-1"><label for="email2" class="mb-2 mr-sm-2">Name:</label></div>
		<div class="col-md-9">
			<div class="form-inline">
				<input type="text" class="form-control mb-2 mr-sm-2" name="data[tFeed][name]" value="<?php echo $this->Session->read('User.name')?>" readonly="readonly">
				<?php echo $this->Html->link('LOG OUT', array('controller'=>'User', 'action'=>'logout'), array("class"=>"btn btn-outline-info  mb-2 mr-sm-2" ));?>
				<input type="file" name="data[tFeed][image_file_name]" id="file" class="inputfile" accept="image/*"/>
				<?php echo $this->Html->link('Reload', array('controller'=>'Chat', 'action'=>'feed'), array("class"=>"btn btn-outline-info  mb-2 mr-sm-2" )); ?>
				<?php echo $this->Form->submit('POST',array('div'=>False, "class"=>"btn btn-info  mb-2 mr-sm-2"), array("class"=>"btn btn-outline-info"));?>
			</div>	
		</div>	
	</div>
	<div class="row">
		<div class="col-md-1" style="height: 80%;"></div>
		<div class="col-md-1"><label for="pwd2" class="mb-2 mr-sm-2">Message</label></div>
		<div class="col-md-9 form-inline">
			<?php if(isset($messageEdit)): ?> 
				<textarea rows="2" cols="50" class="form-control" name="data[tFeed][message]" placeholder ='Enter your words...' required="required" style="width: 100%" ><?php echo $messageEdit['tFeed']['message'];?></textarea>
				<input type="text" name="data[tFeed][id]" style="display: none;" value="<?php echo $messageEdit['tFeed']['id'];?>" readonly="readonly" >	
			<?php else: ?>
				<textarea rows="2" cols="50" class="form-control" name="data[tFeed][message]" style="width: 100%" value="" placeholder ="Enter your words..." required="required" ></textarea>
			<?php endif; ?>
		</div>
		<div class="col-md-1"></div>
	</div>
	<?php echo $this->Form->end();?>
</div>

<hr>
<?php 
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-1"></div>
		<div class="col-md-10">
			<?php foreach ($messages as $message): ?>
				<?php 
					if ($message['tFeed']['update_at'] != '0000-00-00 00:00:00') {
						$timeStr = date('d/m/Y H:i:s', strtotime($message['tFeed']['update_at']));
					}else{
						$timeStr = date('d/m/Y H:i:s', strtotime($message['tFeed']['create_at']));
					}	
					if( $message['tUser']['name'] == $this->Session->read('User.name') ){
				?>
				<div class="p-2 my-3" style="border-radius: 20px 20px 20px 0px;border: 3px solid #999999; ">
					<div class="media">
						<div class="media-body">
							<span style="font-weight: bold;">
								<?php echo $message['tUser']['name'] ?>
							</span> &nbsp;&nbsp;
							<?php echo $timeStr ?>
							<br>
							<span style="font-size: 0.9em">
								<?php echo $message['tFeed']['message'] ?>
							</span>
						</div>
						<div class="align-self-center mr-1">
							<?php 
							if (!empty($message['tFeed']['image_file_name'])) {
								$imagePath = 'upload/'.$message['tFeed']['image_file_name'];
								echo $this->Html->image($imagePath,array('width'=>'200px'));
							}
							?>	
						</div>
						<div class="align-self-center mr-1">
							<?php echo $this->Form->postLink('Edit',array('controller'=> 'Chat', 'action' => 'edit', $message['tFeed']['id']) ,array('class'=>'btn btn-outline-secondary px-3')); ?>
						</div>
						<div class="align-self-center mr-1"	>
							<?php echo $this->Form->postLink('Delete',array('controller'=> 'Chat', 'action' => 'delete', $message['tFeed']['id']) ,array('class'=>'btn btn-outline-dark px-3')); ?>
						</div>	
					</div>
				</div>
				<?php 
					}else{ 
				?>
				<div class="p-2 my-3 text-right" style="border-radius: 20px 20px 0px 20px; border: 3px solid #333333;">
					<div class="media">
						<div class="align-self-center mr-1">
							<?php 
							if (!empty($message['tFeed']['image_file_name'])) {
								$imagePath = 'upload/'.$message['tFeed']['image_file_name'];
								echo $this->Html->image($imagePath,array('width'=>'200px'));
							}
							?>	
						</div>
						<div class="media-body">
						
							<?php echo $timeStr ?>&nbsp;&nbsp;
							<span style="font-weight: bold;">
								<?php echo $message['tUser']['name'] ?>
							</span> 
							<br>
							<span style="font-size: 0.9em">
								<?php echo $message['tFeed']['message'] ?>
							</span>
						</div>
					</div>
				</div>
				<?php 
					}
				?>
			<?php endforeach ?>
		</div>
		<div class="col-md-1"></div>
	</div>
</div>
