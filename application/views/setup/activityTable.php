<?php if ($this->session->userdata('type') != "member"): ?>
    <!-- <button type="button" class="btn btn-primary addbtn" ><span style="font-family: Tahoma;"> Add New Transaction </span></button > -->
<?php endif ?>
<!-- <button type="button" class="btn btn-primary printTable" ><span style="font-family: Tahoma;"> <i class="bi bi-printer"></i> Print </span></button > -->
<br><br>

<table class="table table-striped table-bordered table-hover table-condensed" id="activityTable">
    <thead>                          
        <tr>
            <th><b>Actions</b></th>
            <th><b>User</b></th>
            <th><b>Name</b></th>
            <th><b>Amount</b></th>
            <th><b>Remarks</b></th>
            <th><b>Type</b></th>
            <th><b>Approve By</b></th>
            <th><b>Date Created</b></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($record as $row): ?>
            <?php 
            $remark = "";
            if($row['type'] == "Contribution"){
                $remark = $this->setup->getUserName($row['user_id'])." paid a contribution.";
            }elseif($row['type'] == "Loan Payment"){
                $remark = $this->setup->getUserName($row['user_id'])." paid a partial payment for loan.";
            }elseif($row['type'] == "Loan"){
                $remark = $this->setup->getUserName($row['user_id'])." loan request is released.";
            }

            ?>
        <tr <?= ($row['status'] == "PENDING") ? "style='background-color: blue !important;color:white;'":"" ?>>
            <td class="align_center">
                <a id="<?=$row['id']?>" class="btn btn-info viewDetail"><i class="bi bi-eye"></i> View Details</a>
                <?php if ($row['file_id']){ ?>
                    <a id="<?= $row['id'] ?>" class="btn btn-primary viewbtn" link="<?= $this->setup->getFileLink($row['file_id']) ?>"><i class="bi bi-files"></i> View</a>&nbsp;&nbsp;
                <?php } ?>
            </td>
            <td align="center"><img class="rounded " src='<?= $this->setup->getUserImage($row['user_id']) ?>' style='width: 80px;text-align: center;' /></td>
            <td ><?=$this->setup->getUserName($row['user_id'])?></td>
            <td><?=$row['amount']?></td>
            <td><?= $remark ?></td>
            <td><?=$row['type']?></td>
            <td><?=$this->setup->getUserName($row['approve_by'])?></td>
            <td><?=$row['timestamp']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>

<form id="reportFormTable" action="<?= base_url() ?>index.php/setup_/transactionIndiReport" method="POST" target="_blank">
    <input type="hidden" name="code" id="transactionCode">
 </form>
<script>
    
$(document).ready(function(){
    var table = $('#activityTable').DataTable();
    $('.materialboxed').materialbox();
});

$("#activityTable").on("click", ".viewbtn", function(){
    window.open($(this).attr("link"));
});

$("#activityTable").on("click", ".viewDetail", function(){
    var code = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageTransaction')?>",
        data: {code: code, type:"viewing"},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("View Transaction");
            $("#modal-view").find("#modal-display").html(response);
        }
    });
});


</script>