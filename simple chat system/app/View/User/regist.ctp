
<style type="text/css">
	.form-message{
		margin-top: 150px;
		padding: 15px;
		border-radius: 10px;
		border: 1px solid #1f1f1f;
	}
	.error-message{
		color: red;
	}
</style>

<div class="container">
	<?php echo $this->Session->flash('auth'); ?>
	<div class="row">
		<div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="form-message">
			<div class="text-center">
				<b>Đăng kí tài khoản</b>
			</div>
			<?php echo $this->Form->create('tUser'); ?>
				<div>
					<?php echo $this->Form->input('name', array("class"=>"form-control", "type"=>"text"));?>
				</div>
				<div>
					<?php echo $this->Form->input('e-mail', array("class"=>"form-control", "type"=>"text"));?>
				</div>
				<div>
					<?php echo $this->Form->input('password', array("class"=>"form-control"));?>
				</div>
				<div style="text-align: center; padding: 5px;">
					<?php echo $this->Form->submit('Regist',array('div'=>False, "class"=>"btn btn-outline-primary"));?>
					<?php echo $this->Html->link('Login system', array('controller'=>'User', 'action'=>'login'), array("style"=>"float: right;"));?>
				</div>
			<?php echo $this->Form->end(); ?>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</div>
