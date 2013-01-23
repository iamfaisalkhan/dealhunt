<div class="container-fluid">
 <div class="row-fluid">

  <div class="span2">
   <!--  Sidebar -->
  </div>

  <div class="span10">
   <!--  Body  -->
   
   <div class="row">
   
   <div class="span8">
     <div class="row">
       <?php $count = 0;?>
       <?php foreach ($deals as $deal):?>
       <div class="span3">
         <a href="<?php echo $deal->url;?>">
          <img style="width : 100%; height: auto;" src="<?php echo $deal->image?>" class="img-polaroid">
         </a>
         <?php echo trim($deal->txt);?>
         <p></p>
       </div>
       <?php $count = $count + 1;?>
       <?php if ( ($count % 4) == 0):?>
       </div>
       <!-- Start a new row, if there are still more elements -->
       <?php if (count($deals) > $count):?>
       <div class="row">
       <?php endif;?>
      
       <?php endif;?>
       <?php endforeach;?>
     
       <!--  At the end of the foreach, if we didn't close the div close it! -->
       <?php if ( ($count % 4) != 0):?>
         </div>
       <?php endif;?>
   </div> <!--  span8 -->
      
      
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
    </div> <!--  span2 last column -->
    
    <div class="span2"><!--  empty column --></div>
    
    
  </div> <!--  Inner row -->
  
 </div>   <!-- span10 side bar -->
 
</div> <!--  top row -->
</div> <!-- /container -->
