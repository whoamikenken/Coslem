<button type="button" class="btn btn-primary addbtn" ><span style="font-family: Tahoma;"> Add New </span></button >
<button type="button" class="btn btn-primary printTable" ><span style="font-family: Tahoma;"> Print </span></button ><br><br>

<table class="table table-striped table-bordered table-hover table-condensed" id="userTable">
    <thead>                          
        <tr>
            <th><b>Actions</b></th>
            <th><b>Username</b></th>
            <th><b>Full Name</b></th>
            <th><b>Email</b></th>
            <!-- <th><b>Type</b></th> -->
            <th><b>Gender</b></th>
            <th><b>Status</b></th>
            <th><b>Date Created</b></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($record as $row): ?>
        <tr>
            <td class="align_center">
                <a id="<?=$row['id']?>" class="btn btn-primary editbtn" href="#modal-view" ><i class="bi bi-pencil-square"></i> Edit</a>&nbsp;&nbsp;
                <a id="<?=$row['id']?>" class="btn btn-danger delbtn"><i class="bi bi-trash"></i> Delete</a>
            </td>
            <td><?=$row['username']?></td>
            <td><?=$row['name']?></td>
            <td><?=$row['email']?></td>
            <!-- <td><?=$row['type']?></td> -->
            <td><?=$row['gender']?></td>
            <td><?=$row['status']?></td>
            <td><?=$row['timestamp']?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<input type="hidden" id="tableCode" value="<?= $type ?>">
<script>
$(document).ready(function(){
    var table = $('#userTable').DataTable();
});

$(".addbtn").click(function() {
    var code = "add";
    var tableCode = $("#tableCode").val();
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageUser')?>",
        data: {code: code, tableCode: tableCode},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("Add User Setup");
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
            link: "<?= base_url() ?>index.php/setup_/userReport",
            desc: "user"
        },
        success: function (response) {
            $("#modal-print-display").html(response);
        }
    });
});

$("#userTable").on("click", ".editbtn", function(){
    var code = $(this).attr('id');
    var tableCode = $("#tableCode").val();
    $.ajax({
        type: "POST",
        url: "<?= site_url('setup_/manageUser')?>",
        data: {code: code, tableCode: tableCode},
        success:function(response){
            $("#modal-view").modal('toggle');
            $("#modal-view").find(".modal-title").text("Edit User Setup");
            $("#modal-view").find("#modal-display").html(response);
        }
    });
});

$("#userTable").on("click", ".delbtn", function(){
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
        var tableCode = $("#tableCode").val();
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/deleteUser')?>",
            data: {code: code},
            success:function(response){
                Swal.fire({
                    icon: 'success',
                    title: 'Deleted!',
                    text: 'User has been deleted successfully.',
                    showConfirmButton: true,
                    timer: 1000
                })
                if (tableCode == "member") {
                    memberSetup();
                }else if(tableCode == "treasurer"){
                    treasurerSetup();
                }else if(tableCode == "admin"){
                    adminSetup();
                }else{
                    location.reload();
                }
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