<?php
$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'Login',
);
?>

<div class="row text-left">
	<div class="col-md-12 text-left">
    	<div class="panel panel-default">
        	<div class="panel-heading"><h4 style="color:#006;"><span style="font-size:30px;"><i class="fa fa-unlock-alt"></i></span>  WPD Login</h4></div>
        	<div class="panel-body">
<p>Please fill out the following form with your login credentials:</p>

<div class="form form-group">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<div class="row form-group">
    	
		<?php echo $form->labelEx($model,'username'); ?>&nbsp;&nbsp;&nbsp;
		<?php echo $form->textField($model,'username',array('class' => 'form-control','style' => 'width: 250px;','placeholder' => '')); ?>&nbsp;&nbsp;&nbsp;
		<?php echo $form->error($model,'username'); ?>
        
	</div>

	<div class="row form-group">
		<?php echo $form->labelEx($model,'password'); ?>&nbsp;&nbsp;&nbsp;
		<?php echo $form->passwordField($model,'password',array('class' => 'form-control','style' => 'width: 250px;','placeholder' => '')); ?>&nbsp;&nbsp;&nbsp;
		<?php echo $form->error($model,'password'); ?>
		<!--<p class="hint">
			Hint: You may login with <tt>demo/demo</tt> or <tt>admin/admin</tt>.
		</p>-->
	</div>

	<div class="row rememberMe">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe'); ?>
		<?php echo $form->error($model,'rememberMe'); ?>
	</div>

	<div class="row buttons">
		<?php //echo CHtml::submitButton('Login', array('class' => 'btn btn-success', 'style' => 'width: 120px; border-radius: 5px;')); ?>
        <?php
			echo CHtml::tag('button', array(
				'class' => 'btn btn-info',
				'style' => 'width: 120px; border-radius: 5px;',
        		'name'=>'btnSubmit',
        		'type'=>'submit'
      			), '<i class="fa fa-sign-in"></i> Login');
		?>
        
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->

</div>
        <div class="panel-footer"></div>
    </div>
    
  	</div>
  </div>
