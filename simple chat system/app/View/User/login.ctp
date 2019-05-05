
<style type="text/css">
	.form-message{
		margin-top: 200px;
		padding: 15px;
		border-radius: 10px;
		border: 1px solid #1f1f1f;
	}
	.error-message{
		display: none;
	}
</style>
<div class="container">
	<?php echo $this->Session->flash('auth'); ?>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			
			<div class="form-message">
			<div class="text-center">
				<b>Đăng nhập hệ thống</b>
			</div>
			<?php echo $this->Form->create('tUser'); ?>
				<div>
					<?php echo $this->Form->input('e-mail', array("class"=>"form-control", "type"=>"text"));?>
				</div>
				<div>
					<?php echo $this->Form->input('password', array("class"=>"form-control"));?>
				</div>
				<div style="text-align: center; padding: 5px;">
					<?php echo $this->Form->submit('Login',array('div'=>False, "class"=>"btn btn-outline-primary"));?>
					<?php echo $this->Html->link('Regist', array('controller'=>'User', 'action'=>'regist'), array("class"=>"btn btn-outline-info"));?>
				</div>
			<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
