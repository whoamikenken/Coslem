<?php
$record = $this->setup->getAnnualSetup($code)[0];
$getMemberList = $this->setup->getUserList("", "member");
// echo"<pre>";print_r($getMemberList);die;

$share = $record['share'];

$pdf = new \Mpdf\Mpdf(array('mode' => 'utf-8','format' => 'A4-L', 'orientation' => 'L'));
// $pdf = new mPDF();

$interval = $this->setup->monthCouter($record['from_date'], $record['to_date']);
$numberMonths = range(0,$interval);
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
                <td valign='middle' style='padding: 0;text-align: center;'><span style='font-size: 13px;' width='45%'><strong>Annual Report</strong></span></td>
            </tr>
        </table>
    </div>
</htmlpageheader>";
$dataTotalArray = array();
$dataTotalArray["annual"]['loan_amount_remaining'] = 0;

$info .= "

<div class='content'>
    <div class='content-header'>
        <table border=1 width='100%' style='font-size: 9px;' id='datas'>
            <thead>
            <tr style='background-color: black;'>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Image</th>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Name</th>
            <th colspan='".($interval + 1)."' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>No. Shares</th>";


            $annualStart = strtotime($record['from_date']);
            $info .="
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Total Share</th>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Interest Gained</th>";

            // CONTRIBUTION
            foreach ($numberMonths as $key => $value) {
                $monthPlus = $value;
                $firstDayMonth = date("Y F", strtotime("+".$monthPlus." month", $annualStart));
                $lastDayMonth = date("Y F t", strtotime("+".$monthPlus." month", $annualStart));
                $info .="
                <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>".$firstDayMonth."</th>
                ";
                
                $dataTotalArray[date("Y-m-d", strtotime("+".$monthPlus." month", $annualStart))]['total'] =  0;
            }

            $dataTotalArray["annual"]['total'] = $dataTotalArray["annual"]['share'] =  $dataTotalArray["annual"]['loan_amount_total'] = $dataTotalArray["annual"]['loan_amount'] = $dataTotalArray["annual"]['loan_interest'] = $dataTotalArray["annual"]['loan_amount_payed'] = $dataTotalArray["annual"]['interest_gained'] = $dataTotalArray["annual"]['shareOut'] = 0;
            $info .="
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Total Share Amount</th>";

            $info .="
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Loan Amount</th>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Loan Interest</th>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Loan Total</th>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Loan Payed</th>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Remaining Balance</th>
            <th rowspan='2' style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold;'>Share Out Amount</th>";
            $totalLoanInterest = $totalShareAnnual = 0;
            foreach ($getMemberList as $row => $valData) {
                $idEmp = $valData['id'];
                $totalAmount = $totalShare = 0;
                $totalSumLoanUser = $this->setup->getUserLoanTotalAmount($idEmp);
                $SumLoanUser = $this->setup->getUserLoanAmount($idEmp);
                $SumLoanUserInterest = $this->setup->getUserLoanInterest($idEmp);
                $totalSumLoanTransactionPayed = $this->setup->getTotalLoanUser($firstDayMonth, $lastDayMonth, $idEmp);
                $remainingLoanBalance = $this->setup->getUserLoanRemainingBalance($idEmp);

                $getMemberList[$row]['loan_amount_total'] = $totalSumLoanUser;
                $getMemberList[$row]['loan_amount'] = $SumLoanUser;
                $getMemberList[$row]['loan_interest'] = $SumLoanUserInterest;
                $getMemberList[$row]['loan_amount_payed'] = $totalSumLoanTransactionPayed;
                $getMemberList[$row]['loan_amount_remaining'] = $remainingLoanBalance;

                $totalLoanInterest += $SumLoanUserInterest;

                foreach ($numberMonths as $key => $value) {
                    $monthPlus = $value;
                    $firstDayMonth = date("Y-m-d", strtotime("+".$monthPlus." month", $annualStart));
                    $lastDayMonth = date("Y-m-t", strtotime("+".$monthPlus." month", $annualStart));

                    $totalSumAmountTransaction = $this->setup->getTotalContributionUser($firstDayMonth, $lastDayMonth, $idEmp);

                    $getMemberList[$row][$firstDayMonth]['total'] = $totalSumAmountTransaction;
                    $getMemberList[$row][$firstDayMonth]['share'] = $totalSumAmountTransaction / $share;
                    $totalAmount += $totalSumAmountTransaction;
                    $totalShare += $totalSumAmountTransaction / $share;
                    $getMemberList[$row]['total'] = $totalAmount;
                    $getMemberList[$row]['share'] = $totalShare;
                    $totalShareAnnual += $totalShare;
                }
            }

            if (doubleval($totalLoanInterest) == 0.0) {
                $totalLoanInterest = 1;
            }

            if (doubleval($totalShareAnnual) == 0.0) {
                $totalShareAnnual = 1;
            }

            $interestPerShare = $totalLoanInterest / $totalShareAnnual;
            
            $info .="</tr>
                    <tr>";

            // SHARE
            foreach ($numberMonths as $key => $value) {
                $monthPlus = $value;
                $firstDayMonth = date("Y F", strtotime("+".$monthPlus." month", $annualStart));
                $lastDayMonth = date("Y F t", strtotime("+".$monthPlus." month", $annualStart));
                $info .="
                <th style='padding: 5px;text-align: center;font-size: 20px;font-weight: bold; background-color:black;'>".($value + 1)."</th>
                ";
                
                $dataTotalArray[date("Y-m-d", strtotime("+".$monthPlus." month", $annualStart))]['share'] =  0;
            }

            $info .="</tr>";

$info .= "</thead>";
$info .= "<tbody>";
            foreach($getMemberList as $emp){
                    $info .= "<tr>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'><img src='".$this->setup->getUserImage($emp['id'])."' style='width: 60px;text-align: center;' /></td>
                            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$this->setup->getUserName($emp['id'])."</td>";
            //SHARE
            foreach ($numberMonths as $key => $value) {
                $monthPlus = $value;
                $firstDayMonth = date("Y-m-d", strtotime("+".$monthPlus." month", $annualStart));
                $info .="
                <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp[$firstDayMonth]['share']."</td>
                ";
                $dataTotalArray[$firstDayMonth]['share'] +=  $emp[$firstDayMonth]['share'];
            }

            $dataTotalArray["annual"]['share'] += $emp['share'];
            $info .="
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['share']."</td>
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".round($emp['share'] * $interestPerShare)."</td>";
            $dataTotalArray["annual"]['interest_gained'] += $emp['share'] * $interestPerShare;

            //CONTRIBUTION
            foreach ($numberMonths as $key => $value) {
                $monthPlus = $value;
                $firstDayMonth = date("Y-m-d", strtotime("+".$monthPlus." month", $annualStart));
                $info .="
                <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp[$firstDayMonth]['total']."</td>
                ";
                $dataTotalArray[$firstDayMonth]['total'] +=  $emp[$firstDayMonth]['total'];
            }
            $dataTotalArray["annual"]['total'] += $emp['total'];
            $info .="
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['total']."</td>";

            // LOAN
            $info .="
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['loan_amount']."</td>
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['loan_interest']."</td>
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['loan_amount_total']."</td>
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['loan_amount_payed']."</td>
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".$emp['loan_amount_remaining']."</td>
            <td style='padding: 2px;text-align: center;font-size: 13px;'>".round(($emp['total'] - $emp['loan_amount_remaining']) + ($emp['share'] * $interestPerShare))."</td>";

            $dataTotalArray["annual"]['loan_amount'] += $emp['loan_amount'];
            $dataTotalArray["annual"]['loan_interest'] += $emp['loan_interest'];
            $dataTotalArray["annual"]['loan_amount_total'] += $emp['loan_amount_total'];
            $dataTotalArray["annual"]['loan_amount_payed'] += $emp['loan_amount_payed'];
            $dataTotalArray["annual"]['loan_amount_remaining'] += $emp['loan_amount_remaining'];
            $dataTotalArray["annual"]['shareOut'] += round(($emp['total'] - $emp['loan_amount_remaining']) + ($emp['share'] * $interestPerShare));

                        
$info .= "</tr>";
}

$info .= "<tr>
<td style='padding: 2px;text-align: center;font-size: 13px;'></td>
<td style='padding: 2px;text-align: center;font-size: 13px;'>TOTAL:</td>";

foreach ($numberMonths as $key => $value) {
    $monthPlus = $value;
    $firstDayMonth = date("Y-m-d", strtotime("+".$monthPlus." month", $annualStart));

    $info .= "
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray[$firstDayMonth]['share']."</td>";

}
$info .= "
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['share']."</td>
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".round($dataTotalArray["annual"]['interest_gained'])."</td>";

foreach ($numberMonths as $key => $value) {
    $monthPlus = $value;
    $firstDayMonth = date("Y-m-d", strtotime("+".$monthPlus." month", $annualStart));

    $info .= "
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray[$firstDayMonth]['total']."</td>";

}
$info .= "
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['total']."</td>";

    $info .= "
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['loan_amount']."</td>
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['loan_interest']."</td>
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['loan_amount_total']."</td>
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['loan_amount_payed']."</td>
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['loan_amount_remaining']."</td>
    <td style='padding: 2px;text-align: center;font-size: 13px;'>".$dataTotalArray["annual"]['shareOut']."</td>";


$info .= "</tr>";
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
// echo "<pre>";
// print_r($info);
// die;

$pdf->Output('Annual List Report .pdf', 'I');
?>



