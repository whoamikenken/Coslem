<?php
$record = $this->setup->getTransactionSetup($code)[0];
// echo"<pre>";print_r($record);die;
$pdf = new \Mpdf\Mpdf(array('mode' => 'utf-8','format' => 'LETTER-P', 'orientation' => 'P'));
// $pdf = new mPDF();
$pdf->SetTitle('Transaction Report');

$info  = "  <style>
                @page{            
                    /*margin-top: 4.35cm;*/
                    margin-top: 3.15cm;
                    odd-header-name: html_Header;
                    odd-footer-name: html_Footer;
                }
                th{
                	color: white;
                }  
                .content{
                    height: 100%;
                    margin-top: 15px;
                }
                table{
                    border-collapse: collapse;
                    font-size: 12px;
                    border-spacing: 5px;
                }
                .content-header{
                    text-align: center;
                    font-size: 12px;
                }
                .content-body{
                    border: 1px solid black;
                    padding-top: 8px;
                    padding-bottom: 8px;
                    padding-left: 8px;
                }

			    .footer{
			    	width: 100%;
			    	text-align: right;
			    }
            </style>";
$info .= "
<htmlpageheader name='Header'>
    <div>
        <table width='60%'  >
            <tr>
                <td rowspan='3' style='text-align: right;' width='60%'><img src='images/logo.png' style='width: 60px;text-align: center;' /></td>
                <td valign='middle' width='90%' style='padding: 0;text-align: center;' width='45%'><span style='font-size: 13px;'><b>COSLEM</b></span></td>
            </tr>
            <tr>
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 13px;' width='45%'><strong>Community-Base Savings and Lending Management System</strong></span></td>
            </tr>
            <tr>
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 13px;' width='45%'><strong>Transaction Report</strong></span></td>
            </tr>
        </table>
    </div>
</htmlpageheader>";
$info .= "

<div class='content'>
    <div class='content-header'>
        <div style='text-align:right'><br><br><br>
            <img src='".$this->setup->getUserImage($record['user_id'])."' style='width: 170px;text-align: left;' />
            <h4 style='text-align:right;margin-right:45px'>User Photo</h4>
        </div><br><br><br>
        <div style='text-align:left'>
            <h3 style='text-align:left;margin-right:45px'>Transaction ID: ".$record['id']."</h3>
            <h3 style='text-align:left;margin-right:45px'>TYPE: ".$record['type']."</h3>
            <h3 style='text-align:left;margin-right:45px'>STATUS: ".$record['status']."</h3>
            <h3 style='text-align:left;margin-right:45px'>AMOUNT: ".$record['amount']."</h3>
            <h3 style='text-align:left;margin-right:45px'>CREATED ON: ".$record['timestamp']."</h3>
            <h3 style='text-align:left;margin-right:45px'>REMARKS:</h3>
            <h3 style='text-align:left;margin-right:45px'>".$record['remarks']."</h3>
        </div>
    </div>
</div>";
$info .= "
	<htmlpagefooter name='Footer'>
		<br>
		<div class='footer'>
			Page : {PAGENO} of {nb}
		</div>
	</htmlpagefooter>
";
$pdf->WriteHTML($info);

$pdf->Output('User List Report .pdf', 'I');
?>



