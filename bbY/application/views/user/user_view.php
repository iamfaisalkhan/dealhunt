<div class="container">
   <div class="row-fluid">
      
      <div class="span2">
      <!--  Sidebar -->
      </div> 
      
      <div class="span10">
       
       <!--  Body  -->
       <div class="span6">
          <h4> I am looking for best offers on : </h4>
          <form class="form-inline" action="<?php echo base_url();?>/index.php/user/add" method="post">
             <fieldset>
                <input class="span10" name="item" type="text" placeholder="e.g. Samsung TV 72 inches">
                <button type="submit" class="btn">Add</button>
               </fieldset>
            </form> 
            <table class="table">
            <tbody>
               
               <!--  display all user products  -->
               <?php foreach ($products as $product):?>
               <tr><td> <?php echo $product->name?> </td></tr>
               <?php endforeach;?>
               
               <!--  if the prodcts list was empty -->
               <?php if (count($products) == 0) : ?>
               <tr><td> Add your favourite itesm to get great offers </td></tr>
               <?php endif;?>
                
               <!--  for display an extra line at the end of the table. -->
               <tr><td></td></tr>
               
            </tbody>
            </table>
         </div>
      </div>
   </div>

<footer>
   <p>&copy; Company 2012</p>
</footer>

</div> <!-- /container -->
