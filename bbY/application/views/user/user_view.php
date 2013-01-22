<div class="container">
 <div class="row">
  <div class="span2">
   <!--  Sidebar -->
  </div>
  <div class="span10">
   <!--  Body  -->
   <div class="span4">
    <form class="form-inline" action="<?php echo base_url();?>/index.php/user/add"  method="post">
     <table class="table">
      <tr>
       <td style="border-top:none;"><input name="item" type="text" placeholder="Tell us what you love!" /> </td>
       <td  style="border-top:none;"><button type="submit" class="btn">Add</button> </td>
      </tr>
     </form>

     <!--  display all user products  -->
     <?php foreach ($products as $product):?>
     <tr>
      <td><?php echo $product->name?> </td>
      <td style="text-align: right;">
         <!--<a href="<?php echo base_url()?>/user/edit/<?php echo $product->id?>"><i class="icon-pencil"></i></a> 
          &nbsp;-->
          <a href="<?php echo base_url()?>/user/del/<?php echo $product->id?>"><i class="icon-trash"></i> </a>
      </td>
     </tr>
     <?php endforeach;?>
     
     <!--  if the prodcts list was empty -->
     <?php if (count($products) == 0) : ?>
     <tr>
      <td colspan="2" center
      ><small>Add your favourite itesm to get great offers</small></td>
     </tr>
     <?php endif;?>
     <!--  for display an extra line at the end of the table. -->
     <tr>
      <td colspan="2"></td>
     </tr>
    </table>

   </div>
  </div>  <!-- span10 side bar -->

 </div>
</div> <!-- /container -->
