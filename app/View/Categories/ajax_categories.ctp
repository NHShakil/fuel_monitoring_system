
<div class="content-wrapper">
    <section class="content">
       <!--  <div class="box box-primary"> -->

       <div class= "row">
    		<div class="col-md-12">
    			<?php
					$this->Html->script('prototype', array('inline' => false));
					echo $this->Form->create('Category');

					echo $this->Form->input('Category.id',array('id'=>'Category.id','label'=>'Parent',
					'empty' => '-- Pick a category --' ,'options' => $options));

					 echo $this->Form->input('Subcategory',array('id' =>
					'Subcategory','label'=>'Subcategory', 'empty' => '-- Pick a subcategory --' ));

					 echo $this->Form->input('name',array('label'=>'Name'));

					 echo $this->Form->end('Add');

					 echo  $this->Js->get('#Category.id')->event(
					'change', $this->Js->request(
					    array('controller'=>'categories','action'=>'ajax_categories'),
					    array('update' => '#Subcategory', 'dataExpression' => true, 'data'
					            =>'$("#Category.id").serialize()')
					)
					);
				?>
			</div>
		</div>
	</section>
</div>