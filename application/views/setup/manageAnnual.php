<form id="annualManageForm">
    <div class="mb-3">
        <label for="from_date" class="form-label">Date From</label>
        <input type="text" class="datepicker form-control validate" id="from_date" name="from_date" aria-describedby="from_date" value="<?= isset($record['from_date']) ? $record['from_date'] : "" ?>">
    </div>
    <div class="mb-3">
        <label for="to_date" class="form-label">Date To</label>
        <input type="text" class="datepicker form-control validate" id="to_date" name="to_date" aria-describedby="to_date" value="<?= isset($record['to_date']) ? $record['to_date'] : "" ?>">
    </div>
    <div class="mb-3">
        <label for="share" class="form-label">Per Share</label>
        <select class="form-select validate" aria-label="share" name="share" <?= (isset($record['share']) && $record['share'] == "100") ? "disabled" : "" ?>>
            <option value="100" <?= (isset($record['share']) && $record['share'] == "Unverified") ? "selected" : "" ?>>100</option>
            <option value="200" <?= (isset($record['share']) && $record['share'] == "200") ? "selected" : "" ?>>200</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select validate" aria-label="status" name="status" <?= (isset($record['status']) && $record['status'] == "ACTIVE") ? "disabled" : "" ?>>
            <option value="ACTIVE" <?= (isset($record['status']) && $record['status'] == "Unverified") ? "selected" : "" ?>>ACTIVE</option>
            <option value="INACTIVE" <?= (isset($record['status']) && $record['status'] == "INACTIVE") ? "selected" : "" ?>>INACTIVE</option>
        </select>
    </div>
    <input type="hidden" id="code" name="code" value="<?= $code ?>">
 </form>

<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });

    $("#saveModal").unbind().click(function() {
        // if(monthDiff(new Date($("#from_date").val()), new Date($("#to_date").val())) != 12){
        //     Swal.fire({
        //         icon: 'warning',
        //         title: 'Warning!',
        //         text: 'Annual date must be a 12 months span.',
        //         showConfirmButton: true,
        //         timer: 4000
        //     }) 
        //     return false;
        // }
        bootstrapForm($("#annualManageForm"));
        swal.fire({
            html: '<h4>Loading...</h4>',
            onRender: function() {
                $('.swal2-content').prepend(sweet_loader);
            }
        });
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/saveAnnual') ?>",
            data: $('#annualManageForm').serialize(),
            success: function(response) {
                $("#modal-view").modal('toggle');
                if ($("#code").val() == "add") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Annual Date has been added successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Annual Date has been updated successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                }

                annualList();
            }
        });
    });
</script>