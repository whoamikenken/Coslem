<?php
$record = $this->setup->getTransactionSetup("","",$user_id, $type);
// echo"<pre>";print_r($record);die;
$pdf = new \Mpdf\Mpdf(array('mode' => 'utf-8','format' => 'LETTER-L', 'orientation' => 'L'));
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
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 13px;' width='45%'><strong>Community-managed Savings and Credit Association</strong></span></td>
            </tr>
            <tr>
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 13px;' width='45%'><strong>Transaction List Report</strong></span></td>
            </tr>
        </table>
    </div>
</htmlpageheader>";
$info .= "

<div class='content'>
    <div class='content-header'>
        <table border=1 width='100%' style='font-size: 9px;' id='datas'>
            <thead>
            <tr style='background-color: black;'>
            <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Transaction ID</th>
            <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Name</th>
            <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Type</th>
            <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Amount</th>
            <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Status</th>
            <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Remarks</th>
            <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Created On</th>
            ";
$info .= "</thead>";
$info .= "<tbody>";
            foreach($record as $emp){
                    $info .= "<tr>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['id']."</td>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$this->setup->getUserName($emp['user_id'])."</td>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['type']."</td>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['amount']."</td>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['status']."</td>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['remarks']."</td>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['timestamp']."</td>";
                        
$info .= "</tr>";
}
$info .= "      
            </tbody>
        </table>
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



