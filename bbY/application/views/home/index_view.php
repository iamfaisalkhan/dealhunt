<div class="container">
<div class="row">
  <div class="span8">
     <h3> Welcome Super Shopper!</h3>
     
      <p class="lead"> We bring best and focused savings that are customed to your needs.
      These deals are fetched, analysed and matched to your wish lists. The
      heavy loading done by us help you save a TON! of money on your favourite
      items. 
      </p>
      <p class="lead">
      Start by following a quick sign-up using your favourite way below and in
      no time you will be saving money!.
      </p>
      <div class="row">
        <div class="span0">
             <a id="abc" href="#">
               <img alt="login" src="<?php echo base_url();?>assets/img/facebook-signup.png">             
             </a>
          </div>
          <div class="span0">
            <a id="signup-email" href="#">
            <img alt="login" src="<?php echo base_url();?>assets/img/email-signup.png">
          </a>
          </div>
          
       </div>
        
   </div>
 </div>
 </div> <!--  row -->
</div> <!-- /container -->

<!-- Facebook login Dialog -->
<div id="login_dialog_fb" class="modal hide fade" tabindex="-1" 
   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <iframe src="https://www.facebook.com/plugins/registration?
             client_id=<?php echo $appId?>&
             redirect_uri=http://ec2-23-20-245-218.compute-1.amazonaws.com/bbY&
             fields=name,birthday,gender,location,email"
        scrolling="auto"
        frameborder="no"
        style="border:none"
        allowTransparency="true"
        width="100%"
        height="330">
  </iframe>
 </div>

<!--  New User Registration dialog -->
<div id="login_dialog" class="modal hide fade" tabindex="-1" 
   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
     <p style="font-weight: bold"><strong>New user sign up</strong></p>
   </div>
   
   <div class="modal-body">
    <!-- Alert area for the form -->
    <div id="login_form_alert" class="alert alert-error hide">
    </div>
   
   <form class="form-horizontal" id="login_form">
   <div class="control-group">
     <label class="control-label" for="inputName">Name</label>
     <div class="controls">
       <input type="text" name="username" value="faisal" id="inputName" placeholder="Name">
     </div>
   </div>
   <!--  Email -->
   <div class="control-group">
     <label class="control-label" for="inputEmail">Email</label>
     <div class="controls">
       <input type="text" name="email" value="faisal@g.com" id="inputEmail" placeholder="Email">
     </div>
   </div>
   
   <!--  Password -->
   <div class="control-group">
     <label class="control-label" for="inputPassword">Password</label>
     <div class="controls">
       <input type="password" value="abc123$" name="password" id="inputPassword" placeholder="Password">
       <label><small>between 6 and 8 characters</small>
     </div>
   </div>
   
     <!-- Confirm -->
   <div class="control-group">
     <label class="control-label" for="inputPassword2">Confirm Password</label>
     <div class="controls">
       <input type="password" value="abc123$" name="passwordconf" id="inputPassword2" placeholder="Retype Password">
     </div>
   </div>
   
   <div class="control-group">
     <div class="controls">
       <button id="submit_login_form" type="submit" class="btn btn-success">Register</button>
     </div>
   </div>
   </form>
   </div>
   
<!--    <div class="modal-footer"> -->
<!--      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
<!--       <button class="btn btn-primary">Submit</button> -->
<!--    </div> -->
</div>