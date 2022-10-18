<?php if ($this->session->userdata('type') != "member"): ?>
    <button type="button" class="btn btn-primary addbtn" ><span style="font-family: Tahoma;"> Add New Transaction </span></button >
<?php endif ?>
<button type="button" class="btn btn-primary printTable" ><span style="font-family: Tahoma;"> <i class="bi bi-printer"></i> Print </span></button >
<br><br>

<table class="table table-striped table-bordered table-hover table-condensed" id="transactionTable">
    <thead>                          
        <tr>
            <th><b>Actions</b></th>
            <th><b>Name</b></th>
            <th><b>Amount</b></th>
            <th><b>Remarks</b></th>
            <th><b>Type</b></th>
            <th><b>Status</b></th>
            <th><b>Approve By</b></th>
            <th><b>Date Created</b></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($record as $row): ?>
        <tr <?= ($row['status'] == "PENDING") ? "style='background-color: blue !important;color:white;'":"" ?>>
            <td class="align_center">
                <a id="<?=$row['id']?>" class="btn btn-info viewDetail"><i class="bi bi-eye"></i> View Details</a>
                <a id="<?=$row['id']?>" class="btn btn-info printDetail"><i class="bi bi-printer"></i> Print Details</a>
                <?php if ($row['status'] == "PENDING" && $this->session->userdata("type") != "member"): ?>
                    <a id="<?= $row['id'] ?>" class="btn btn-success approvebtn"><i class="bi bi-check"></i> Approve</a>
                <?php endif ?>
                <?php if ($row['file_id']){ ?>
                    <a id="<?= $row['id'] ?>" class="btn btn-primary viewbtn" link="<?= $this->setup->getFileLink($row['file_id']) ?>"><i class="bi bi-files"></i> View</a>&nbsp;&nbsp;
                <?php }else{ ?>
                    <br><br>
                    <form action="#">
                        <input class="form-control" id="fileProof" type="file" tag="<?= $row['id'] ?>" user_id="<?= $row['user_id'] ?>">
                    </form>
                <?php } ?>
            </td>
            <td><?=$this->setup->getUserName($row['user_id'])?></td>
            <td><?=$row['amount']?></td>
            <td><?=$row['remarks']?></td>
            <td><?=$row['type']?></td>
            <td><?=$row['status']?></td>
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
    var table = $('#transactionTable').DataTable();
});

$("#transactionTable").on("click", ".viewbtn", function(){
    window.open($(this).attr("link"));
});

$("input:file").change(function() { // bCheck is a input type button

    var transactionID = $(this).attr("tag");
    var formdata = new FormData();
    formdata.append("file", $(this)[0].files[0]);
    formdata.append("user_id", $(this).attr("user_id"));
    formdata.append("transactionID", transactionID);
    // return;

    swal.fire({
        html: '<h4>Uploading Please Wait.</h4>',
        onRender: function() {
            $('.swal2-content').prepend(sweet_loader);
        }
    });
    // return;
    $.ajax({
        url: "<?=site_url("setup_/addTransactionFile")?>",
        data : formdata,
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success : function(response){
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'File has been save successfully.',
                timer: 2500,
                onClose: () => {

                }
            })
            transactionList();
        }
    });
});

$(".addbtn").click(function() {
    var code = "add";
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageTransaction')?>",
        data: {code: code},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("Create Transaction");
            $("#modal-view").find("#modal-display").html(response);
        }
    });
});

$("#transactionTable").on("click", ".printDetail", function(){
    $("#transactionCode").val($(this).attr("id"));
    jQuery('#reportFormTable').submit();
});


$("#transactionTable").on("click", ".viewDetail", function(){
    var code = $(this).attr('id');      
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageTransaction')?>",
        data: {code: code},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("Edit Loan");
            $("#modal-view").find("#modal-display").html(response);
        }
    });
});

$(".printTable").click(function () {
    $('#modalReport').modal('show');
    $("#modal-title").text("Print User List Report");
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/PDFprint')?>",
        data: {
            link: "<?= base_url() ?>index.php/setup_/transactionReport",
            desc: "transaction"
        },
        success: function (response) {
            $("#modal-print-display").html(response);
        }
    });
});

$("#transactionTable").on("click", ".viewDetail", function(){
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


$("#transactionTable").on("click", ".approvebtn", function() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, proceed!',
        cancelButtonText: 'No, cancel!',
        reverseButtons: true
    }).then((result) => {
        if (result.value) {
            var code = $(this).attr('id');
            $.ajax({
                type: "POST",
                url: "<?= site_url('setup_/updateTransactionStatus') ?>",
                data: {
                    code: code
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Transaction approved.',
                        showConfirmButton: true,
                        timer: 1000
                    })
                    transactionList();
                }
            });

        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelled',
                'Data is safe.',
                'error'
            )
        }
    })
});

$("#transactionTable").on("click", ".delbtn", function(){
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, proceed!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
    }).then((result) => {
      if (result.value) {

        var code = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/deleteLoan')?>",
            data: {code: code},
            success:function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'Loan request has been deleted successfully.',
                    showConfirmButton: true,
                    timer: 1000
                })

                loanList();
            }
        });

      } else if (
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire(
          'Cancelled',
          'Data is safe.',
          'error'
        )
      }
    })
});

</script>