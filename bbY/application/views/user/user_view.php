<div class="container-fluid">
 <div class="row-fluid">

  <div class="span2">
   <!--  Sidebar -->
  </div>

  <div class="span10">
   <!--  Body  -->

   <div class="row">
    <div class="span8">
     <table class="table">
      <tr>
       <?php $count = 0;?>
       <?php foreach ($deals as $deal):?>
       <td style="border: none;">
         <div class="span10 wrap">
          <a href="<?php echo $deal->url;?>">
           <img src="<?php echo $deal->image?>" class="img-polaroid">
          </a>
          <div class="span10">
          <?php echo trim($deal->txt);?>
          </div>
         </div>
       </td>
       <?php $count = $count + 1;?>
       <?php if ( ($count % 4) == 0):?>
      </tr>
      <!-- Start a new row, if there are still more elements -->
      <?php if (count($deals) > $count):?>
      <tr>
      <?php endif;?>
      
      <?php endif;?>

       <?php endforeach;?>
     
     </table>
    </div>
    <div class="span2">
     <form class="form-inline"
      action="<?php echo base_url();?>/index.php/user/add" method="post">
      <table class="table">
       <tr>
        <td style="border-top: none;"><input name="item" type="text"
         placeholder="Tell us what you love!" /></td>
        <td style="border-top: none;"><button type="submit" class="btn">Add</button>
        </td>
       </tr>
       </form>

       <!--  display all user products  -->
       <?php foreach ($products as $product):?>
       <tr>
        <td><?php echo "$product->name"?></td>
        <td style="text-align: right;">
         <a href="<?php echo base_url()?>/user/del/<?php echo $product->id?>"><i
          class="icon-trash"></i> </a>
        </td>
       </tr>
       <?php endforeach;?>

       <!--  if the prodcts list was empty -->
       <?php if (count($products) == 0) : ?>
       <tr>
        <td colspan="2" style="text-align: center;"><small>Add items to
          get great offers</small></td>
       </tr>
       <?php endif;?>
       <!--  for display an extra line at the end of the table. -->
       <tr>
        <td colspan="2"></td>
       </tr>
      </table>
    
    </div>
   </div>
  </div>
  <!-- span10 side bar -->

 </div>
</div>
<!-- /container -->
