<?php

$content = '
<style type="text/css">
.tabel { border-collapse:collapse; }
.header { padding:4mm; background-color:#31B0D5; border:1px solid; text-align: center;}
.tabel th { padding:10px 5px; background-color:#D9EDF7; color:black; font-size:14px; text-align:center; }
.tabel td { padding: 5px 5px; background-color:#ffffff; color:black; font-size:12px; text-align:center;}
</style>';

$content .= '
<page>
  <div class="header">
  		<strong><span style="font-size:25px;">APOTEK MITRA SEHAT</span></strong>
      <br><br>
      <span style="font-size:25px;">Aturan Assosiasi</span>
  </div>
  <br>';

    require_once("../../../_config/config.php");

  	$content .= ' 
          <table cellspacing="0" cellpadding="0" border="1" class="tabel">
            <tr>
              <th style="width:25px;">No. </th>
              <th style="width:545px;">Item (A U B)</th>
              <th style="width:45px;">Level</th>
              <th style="width:125px;">Support (A U B)</th>
              <th style="width:110px;">Support (B)</th>
              <th style="width:95px;">Confidence </th>
            </tr>';
            $no=1;
            $sql_kombinasi = mysqli_query($con, "SELECT * FROM tb_assosiasi where level='L2' order by confidence desc") or die (Mysqli_error($con));
            while($data = mysqli_fetch_array($sql_kombinasi)) {
            $content .= '
            <tr>
              <td>' .$no++. '</td>
              <td>' .$data['item']. '</td>
              <td>' .$data['level']. '</td>
              <td>' .$data['support1']. '</td>
              <td>' .$data['support2']. '</td>
              <td>' .$data['confidence']. '</td>
            </tr>';
          }
            $content .= '
          </table>

          <br>

          <table cellspacing="0" cellpadding="0" border="1" class="tabel">
            <tr>
              <th style="width:25px;">No. </th>
              <th style="width:545px;">Item (A U B)</th>
              <th style="width:45px;">Level</th>
              <th style="width:125px;">Support (A U B)</th>
              <th style="width:110px;">Support (B)</th>
              <th style="width:95px;">Confidence </th>
            </tr>';
            $no=1;
            $sql_kombinasi = mysqli_query($con, "SELECT * FROM tb_assosiasi where level='L3' order by confidence desc") or die (Mysqli_error($con));
            while($data = mysqli_fetch_array($sql_kombinasi)) {
            $content .= '
            <tr>
              <td>' .$no++. '</td>
              <td>' .$data['item']. '</td>
              <td>' .$data['level']. '</td>
              <td>' .$data['support1']. '</td>
              <td>' .$data['support2']. '</td>
              <td>' .$data['confidence']. '</td>
            </tr>';
          }
            $content .= '
          </table>

          <br>

          <table cellspacing="0" cellpadding="0" border="1" class="tabel">
            <tr>
              <th style="width:25px;">No. </th>
              <th style="width:545px;">Item (A U B)</th>
              <th style="width:45px;">Level</th>
              <th style="width:125px;">Support (A U B)</th>
              <th style="width:110px;">Support (B)</th>
              <th style="width:95px;">Confidence </th>
            </tr>';
            $no=1;
            $sql_kombinasi = mysqli_query($con, "SELECT * FROM tb_assosiasi where level='L4' order by confidence desc") or die (Mysqli_error($con));
            while($data = mysqli_fetch_array($sql_kombinasi)) {
            $content .= '
            <tr>
              <td>' .$no++. '</td>
              <td>' .$data['item']. '</td>
              <td>' .$data['level']. '</td>
              <td>' .$data['support1']. '</td>
              <td>' .$data['support2']. '</td>
              <td>' .$data['confidence']. '</td>
            </tr>';
          }
            $content .= '
          </table>
</page>';


require_once('../../../_assets/libs/vendor/autoload.php');

use Spipu\Html2Pdf\Html2Pdf;

$html2pdf = new Html2Pdf('L','A4','en');
$html2pdf->pdf->SetDisplayMode('fullpage');
$html2pdf->writeHTML($content);
$html2pdf->output('aturan_assosiasi.pdf');
?>