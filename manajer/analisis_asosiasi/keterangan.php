<?php 
include_once('../../_config/config.php');
$query_mysql = mysqli_query($con, "SELECT id, item, supcount, support FROM tb_eliminasi order by support asc") or die (mysqli_error($con));
?>
<div class="modal-dialog modal-lg">
  <div class="modal-content">
    <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModalLabel">PRODUK KURANG LAKU</h4>
    </div>
    <div class="modal-body">
      <form action="#" name="modal_popup" method="POST" target="_BLANK">
        <div class="form-group">
          <div class="alert alert-info" role="alert">
             <div style="font-size: 16px; font-family: cursive;">
                <span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span><strong> Produk didapat dari nilai minimum support L1 yang tidak terpenuhi </strong><span class="glyphicon glyphicon-asterisk" aria-hidden="true"></span>
             </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-striped table-bordered table-hover" id="datatables">
              <thead>
                  <tr>
                      <td>No. </td>
                      <td>Itemset</td>
                      <td>Support Count</td>
                      <td>Support</td>
                  </tr>
              </thead>
              
              <?php
              $no=0;
              while($r = mysqli_fetch_array($query_mysql)) {
              $no++; ?>
              
              <tbody>
                  <tr>
                      <td><?php echo $no?></td>
                      <td><?php echo $r['item'];?></td>
                      <td><?php echo $r['supcount'];?></td>
                      <td><?php echo $r['support'];?> %</td>
                  </tr> <?php } ?>
              </tbody>
          </table>
        </div>
      </form>
    </div>  
  </div>
</div>
