<button type="button" class="btn btn-primary addbtn" ><span style="font-family: Tahoma;"> Add New Loan </span></button ><br><br>

<table class="table table-striped table-bordered table-hover table-condensed" id="loanTable">
    <thead>                          
        <tr>
            <th><b>Actions</b></th>
            <th><b>Name</b></th>
            <th><b>Amount</b></th>
            <th><b>Status</b></th>
            <th><b>Requested By</b></th>
            <th><b>Approve By</b></th>
            <th><b>Date Created</b></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($record as $row): ?>
        <tr>
            <td class="align_center">
                <?php if ($row['status'] == "PENDING"): ?>  
                    <a id="<?=$row['id']?>" class="btn btn-primary editbtn" href="#modal-view" ><i class="bi bi-pencil-square"></i> Edit</a>&nbsp;&nbsp;
                    <a id="<?=$row['id']?>" class="btn btn-danger delbtn"><i class="bi bi-trash"></i> Delete</a>
                <?php endif ?>&nbsp;&nbsp;
                <a id="<?=$row['id']?>" class="btn btn-info viewDetail"><i class="bi bi-eye"></i> View Detail</a>
            </td>
            <td><?=$this->setup->getUserName($row['user_id'])?></td>
            <td><?=$row['amount']?></td>
            <td><?=$row['status']?></td>
            <td><?=$this->setup->getUserName($row['requested_by'])?></td>
            <td><?=$this->setup->getUserName($row['approve_by'])?></td>
            <td><?=$row['timestamp']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<script>
$(document).ready(function(){
    var table = $('#loanTable').DataTable();
});

$(".addbtn").click(function() {
    var code = "add";
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageLoan')?>",
        data: {code: code},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("Add Loan");
            $("#modal-view").find("#modal-display").html(response);
        }
    });
});


$("#loanTable").on("click", ".editbtn", function(){
    var code = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageLoan')?>",
        data: {code: code},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("Edit Loan");
            $("#modal-view").find("#modal-display").html(response);
        }
    });
});

$("#loanTable").on("click", ".viewDetail", function(){
    var code = $(this).attr('id');
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageLoan')?>",
        data: {code: code, type:"viewing"},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("View Loan");
            $("#modal-view").find("#modal-display").html(response);
        }
    });
});

$("#loanTable").on("click", ".delbtn", function(){
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