<button type="button" class="btn btn-primary addbtn"><span style="font-family: Tahoma;"> Add New Annual </span></button><br><br>

<table class="table table-striped table-bordered table-hover table-condensed" id="annualTable">
    <thead>
        <tr>
            <th><b>Actions</b></th>
            <th><b>Per Share</b></th>
            <th><b>Status</b></th>
            <th><b>From Date</b></th>
            <th><b>To Date</b></th>
            <th><b>Created By</b></th>
            <th><b>Date Created</b></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($record as $row) : ?>
            <tr>
                <td class="align_center">
                    <a id="<?= $row['id'] ?>" class="btn btn-primary editbtn" href="#modal-view"><i class="bi bi-pencil-square"></i> Edit</a>&nbsp;&nbsp;
                    <a id="<?= $row['id'] ?>" class="btn btn-danger delbtn"><i class="bi bi-trash"></i> Delete</a>
                    <a code="<?= $row['id'] ?>" class="btn btn-success annual"><i class="bi bi-printer"></i> Print Annual Report</a>
                </td>
                <td><?= $row['share'] ?></td>
                <td><?= $row['status'] ?></td>
                <td><?= $row['from_date'] ?></td>
                <td><?= $row['to_date'] ?></td>
                <td><?= $this->setup->getUserName($row['created_by']) ?></td>
                <td><?= $row['timestamp'] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<form id="reportAnnualTable" action="<?= base_url() ?>index.php/setup_/annualReport" method="POST" target="_blank">
    <input type="hidden" name="code" id="transactionCode">
 </form>

 
<script>
    $(document).ready(function() {
        var table = $('#annualTable').DataTable();
    });

    $(".addbtn").click(function() {
        var code = "add";
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/manageAnnual') ?>",
            data: {
                code: code
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Add Annual");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });

    $("#annualTable").on("click", ".annual", function(){
        $("#transactionCode").val($(this).attr("code"));
        jQuery('#reportAnnualTable').submit();
    });


    $("#annualTable").on("click", ".editbtn", function() {
        var code = $(this).attr('id');
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/manageAnnual') ?>",
            data: {
                code: code
            },
            success: function(response) {
                $("#modal-view").modal('toggle');
                $("#modal-view").find(".modal-title").text("Edit Annual");
                $("#modal-view").find("#modal-display").html(response);
            }
        });
    });

    $("#annualTable").on("click", ".delbtn", function() {
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
                    url: "<?= site_url('setup_/deleteAnnual') ?>",
                    data: {
                        code: code
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Deleted!',
                            text: 'Annual has been deleted successfully.',
                            showConfirmButton: true,
                            timer: 1000
                        })
                        annualList();
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