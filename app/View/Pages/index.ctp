
<div class="normal_wrapper"> 

<div class="col-md-12">
 
  <div id="contactusform_container">

  		<?php echo $this->Form->create('contactusform');?>
        <div class="clear10"></div>
  		<div class="row">
	        <div class="col-md-2">Name</div>
  			<div class="col-md-6"><?php echo $this->Form->input('User.name',array('label'=>'Name','type'=>'text','div'=>false,'required'=>'required','class'=>'form-control','label'=>false,'value'=>$u_name));?></div>
  		</div>
  		<div class="clear10"></div>
        <div class="row">
	        <div class="col-md-2">Email Address</div>
  			<div class="col-md-6"><?php echo $this->Form->input('User.email',array('label'=>'Email','type'=>'email','div'=>false,'required'=>'required','class'=>'form-control','label'=>false,'value'=>$u_email));?></div>
  		</div>
  		<div class="clear10"></div>
        <div class="row">
	        <div class="col-md-2">Subject</div>
  			<div class="col-md-6">
				<?php echo $this->Form->input('User.subject',array('class'=>'form-control','type'=>'select','empty' =>'Select Subject',
  				'options'=>
  						array(
  						      'General Inquiry' => 'General Inquiry',
  						      'Report Issue' => 'Report Issue',
  						      'Suggestion' => 'Suggestion'
  						      )
  				,
  				'label'=>false,'required'=>'required'));?>	
            </div>
  		</div>
  		<div class="clear10"></div>
  		<div class="row">
	        <div class="col-md-2">Message</div>
  			<div class="col-md-8"><?php echo  $this->Form->textarea('User.message',array(
																	'label' 	 => false, 
																	'required' => 'required',
																	'class' 	 => 'form-control',
																	'style' => 'height:95px;'
																	)); ?></div>
  		</div>
  		<div class="clear10"></div>
        <div class="row">
	        <div class="col-md-2">Security Code</div>
  			<div class="col-md-3">
				<?php echo $this->Form->input('User.security_code',array('label'=>false,'type'=>'text','div'=>false,'required'=>'required','class'=>'form-control','maxlength'=>'5'));?>
            </div>
          <div class="col-md-3 captcha_box marg_top_security_mobile_tab"> 
          <?php 
            echo $this->Html->image('noise.jpg', array('id'=>'security_image','alt'=>'Security Image', 'title'=>'Security Image'));
          ?>&nbsp;&nbsp;<?php echo $this->Html->image('loading_static.png', array('id'=>'reload_captcha','alt'=>'Reload Security Image', 'title'=>'Reload Security Image')); ?>
        </div>
        
  		</div>
  		<div class="clear10"></div>
  		<div class="row">
          <div class="col-md-2">&nbsp;</div>
          <div class="col-md-3"><?php echo $this->Form->button('Send Mail',array('label'=>false,'type'=>'submit','div'=>false,'class'=>'btn btn-primary'));?></div>
        </div>
  		<?php echo $this->Form->end();?>
        <div class="clear20"></div>
        <div class="clear20"></div>
  </div>
  </div>

   </div>
 
</div>  
</div>

<script>
$(document).ready(function(){
  //start recaptcha
  $('#reload_captcha').click(function(){
    $('#reload_captcha').attr('src',APPLICATION_URL+'img/loading.gif?y='+Math.random()*1000);
      $.ajax({ url: APPLICATION_URL + 'Pages/get_captcha_image',
        type: "POST",
        data: ({rand : (Math.random()*1000)}),
        success: function(data){  
          // alert(data);
          $('#security_image').attr('src', APPLICATION_URL+'images/captcha/captcha.jpg?y='+Math.random()*1000);
          $('#reload_captcha').attr('src',APPLICATION_URL+'img/loading_static.png?y='+Math.random()*1000);
      }});
    });
    $('#reload_captcha').trigger('click');
    //end recaptcha

});
</script>