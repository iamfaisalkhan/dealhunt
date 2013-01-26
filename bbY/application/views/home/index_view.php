<div class="container-fluid">
 <div class="span12 offset3"> 
  <div class="span6">
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
      <p>
          <?php if (@$user_profile): ?>
        <pre>
            <?php echo print_r($user_profile, TRUE) ?>
        </pre>
        <a href="<?php echo $logout_url ?>">Logout of this thing</a>
        <?php else: ?>
          <a href="<?php echo $login_url;?>">
            <img alt="login" src="<?php echo base_url();?>assets/img/facebook-signin.png">
          </a>
        <?php endif; ?> 
      </p>
   </div>
 </div>
</div> <!-- /container -->
