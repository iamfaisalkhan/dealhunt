<h2> Deals </h2>


<table>

<?php foreach($deals as $deal):?>
<tr>
  <td> <img src=<?php echo $deal["image_thumb"];?> /> </i>  </td>
  <td> <?php echo $deal["description"];?> </td>
  <td> <h1><?php echo $deal["discount"];?> </h1> </td>
</tr>

<?php endforeach;?>
</table>
