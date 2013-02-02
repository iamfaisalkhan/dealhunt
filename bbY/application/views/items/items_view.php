 <div class="container">
   <div class="row">
     <div class="span3">
      <div class="alert alert-error" id="message" style="visibility:hidden">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      Oops! something went wrong. Please try again. 
    </div>
      <div class="accordion" id="accordion2">
      <?php $flag = true; foreach($categories as $category):?>
        <div class="accordion-group">
          <div class="accordion-heading">
            <a class="accordion-toggle" data-toggle="collapse" 
                 data-parent="#accordion2" href="#collapse<?php echo $category?>">
              <?php echo $category?>
            </a>
          </div>
          <div id="collapse<?php echo $category?>" class="accordion-body collapse <?php if ($flag) echo "in"; $flag = false;?>">
            <div class="accordion-inner">
              <table>
                <tr><td> Test Item </td></tr>
                <tr><td> <a href="#" id="<?php echo $category?>" class="add_item">
                      <i class="icon-plus-sign"> </i><em> add </em> </a></td></tr>
              </table>
            </div>
          </div>
        </div>
        <?php endforeach;?>
      </div>
    </div> <!-- span3-->
    
    <div class="span9">
    <ul class="thumbnails">
      <?php foreach ($deals as $deal):?>
      <li class="span3">
        <div class="thumbnail fixed-height">
          <!-- <img class="deal_img" data-src="<?php echo base_url()?>assets/js/holder.js/300x200">-->
          <img style="width:300px; height:200px;" class="deal_img" src="<?php echo $deal->image;?>">
          <h3></h3>
          <span><?php echo $deal->txt?></span>
        </div>
      </li>
      <?php endforeach;?>
    </ul>
    </div> <!--  Last Column -->
   </div> <!--  Top row -->
</div> <!-- /container -->

