<div class="row">
	<div class="header">
		<!-- logo -->
		<div class="col-md-4">
			<?php echo $this->Html->image('/admin/logo.png',array('class'=>'img-responsive admin-logo'))?>
		</div>

		<!-- auth -->
		<div class="col-md-8">
		<?php if(!empty($auth_status)):?>
			<div class="auth-user-action pull-right">
				
				<div class="dropdown">
					<div  data-toggle="dropdown">
						<span>
							<?php 
								
								$img_file = WWW_ROOT."img".DS."site".DS."avatars".DS.$auth_user['id'].".png";
								if(file_exists($img_file)):
									echo $this->Html->image("site/avatars/{$auth_user['id']}.png",array('class'=>'img-responsive pull-left avatar'));
								endif;
							?>
							<span class="auth_user_short_details">	
							<?php 
								$user_details = json_decode($auth_user['personal_details'],true);
								echo "  ". $user_details['first_name']." ".$user_details['last_name'];
							?>
							</span>
							
							
						</span>
						<span class="caret"></span>
					</div>
					<ul class="dropdown-menu" >
						<li>
							<?php echo $this->Html->link('Porfile',array('controller'=>'users','action'=>'edit',$auth_user['id'],'admin'=>true,'plugin'=>false))?>
						</li>
							
						<li>
							<?php echo $this->Html->link('Change Password',array('controller'=>'users','action'=>'change_password','admin'=>true,'plugin'=>false))?>
						</li>
						<li class="divider"></li>
						
						<li>
							<?php echo $this->Html->link('Sign Out',array('controller'=>'users','action'=>'signout','admin'=>true,'plugin'=>false))?>
						</li>
					</ul>
				</div>
			</div>
		<?php endif;?>
		</div>
	</div>
</div>

<style>
	.avatar{
		margin-right: 10px;
		margin-top: -8px;
		border-radius : 5%;
		
		border: 1px solid #ccc;
		
	}	
	.auth_user_short_details{
		font-weight: bold;
	}									
</style>
