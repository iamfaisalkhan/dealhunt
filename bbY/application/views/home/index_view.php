<div class="container">
<div class="row">
  <div class="span8">
     <h3> Welcome Super Shopper</h3>
     
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
          <!--  <a href="<?php echo $login_url;?>">
            <img alt="login" src="<?php echo base_url();?>assets/img/facebook-signup.png">
          </a>-->
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

<div id="login_dialog" class="modal hide fade" tabindex="-1" 
   role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   
   <div class="modal-header">
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
     <h3>New User</h3>
   </div>
   
   <div class="modal-body">
   <form class="form-horizontal">
   <!--  Email -->
   <div class="control-group">
     <label class="control-label" for="inputEmail">Email</label>
     <div class="controls">
       <input type="text" id="inputEmail" placeholder="Email">
     </div>
   </div>
   
   <!--  Password -->
   <div class="control-group">
     <label class="control-label" for="inputPassword">Password</label>
     <div class="controls">
       <input type="password" id="inputPassword" placeholder="Password">
     </div>
   </div>
   
     <!-- Confirm -->
   <div class="control-group">
     <label class="control-label" for="inputPassword2">Confirm Password</label>
     <div class="controls">
       <input type="password" id="inputPassword2" placeholder="Retype Password">
     </div>
   </div>
   
   <div class="control-group">
     <div class="controls">
       <button id="new_user" type="submit" class="btn">Sing-up</button>
     </div>
   </div>
   
   </form>
   </div>
   
<!--    <div class="modal-footer"> -->
<!--      <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button> -->
<!--       <button class="btn btn-primary">Submit</button> -->
<!--    </div> -->
</div>