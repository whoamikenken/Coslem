<?php
$readonly = "";
if ($type == "viewing") $readonly = "readonly";

?>
<form id="TransactionManageForm">
    <div class="mb-3">
        <label for="user_id" class="form-label">User</label>
        <select class="form-select validate" aria-label="user_id" name="user_id" <?= $readonly ?> id="user_id">
            <?php foreach ($user_list as $key => $value) : ?>
                <option value="<?= $value['id'] ?>" <?= (isset($value['id']) && $value['id'] == $user_id) ? "selected" : "" ?>><?= $value['name'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Amount </label>
        <input type="number" class="form-control validate" id="amount" name="amount" aria-describedby="amount" value="<?= isset($record['amount']) ? $record['amount'] : "" ?>" <?= $readonly ?>>
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">Type </label>
        <select class="form-select validate" aria-label="type" name="type" id="type">
            <option value="Contribution">Contribution</option>
            <option value="Loan">Loan</option>
            <option value="Loan Payment">Loan Payment</option>
        </select>
    </div>
    <div class="mb-3" id="loanInput" style="display:none;">
        <label for="base_id" class="form-label">Loan List</label>
        <select class="form-select validate" aria-label="base_id" name="base_id" <?= $readonly ?>>
            <option value="">Select Loan</option>
            <?php foreach ($user_loan as $key => $value) : ?>
                <option class="userloan<?= $value['user_id'] ?> userloanOption" value="<?= $value['id'] ?>"><?= $value['remarks'] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="timestamp" class="form-label">Date</label>
        <input type="text" class="datepicker form-control validate" id="timestamp" name="timestamp" aria-describedby="timestamp" value="<?= isset($record['timestamp']) ? $record['timestamp'] : "" ?>">
    </div>
    <!-- <div class="mb-3">
        <label for="amount" class="form-label">Status </label>
        <select class="form-select validate" aria-label="status" name="status">
            <option value="PENDING" <?php echo (isset($record['status']) && $record['status'] == "PENDING") ? "selected" : "" ?>>PENDING</option>
            <option value="APPROVED" <?php echo (isset($record['status']) && $record['status'] == "APPROVED") ? "selected" : "" ?>>APPROVED</option>
        </select>
    </div> -->
    <div class="mb-3">
        <label for="remarks" class="form-label">Remarks</label>
        <input type="text" class="form-control validate" id="remarks" name="remarks" aria-describedby="remarks" value="<?= isset($record['remarks']) ? $record['remarks'] : "" ?>" <?= $readonly ?>>
    </div>
    <input type="hidden" id="code" name="code" value="<?= $code ?>">
</form>
<script type="text/javascript">
    $(document).ready(function() {
        if ("<?= $readonly ?>" == "readonly") {
            $("#saveModal").hide();
        }

        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });
    });

    $("#user_id").change(function() {
        $("#type").trigger('change');
    });

    $("#type").change(function() {
        if ($(this).val() == "Loan Payment") {
            $("#loanInput").show();
            var userIDselected = $("#user_id").val();
            $(".userloanOption").hide();
            $(".userloan" + userIDselected).show();
        } else {
            $("#loanInput").hide();
            $(".userloanOption").show();
        }
    });

    $("#saveModal").unbind().click(function() {
        bootstrapForm($("#TransactionManageForm"));
        swal.fire({
            html: '<h4>Loading...</h4>',
            onRender: function() {
                $('.swal2-content').prepend(sweet_loader);
            }
        });
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/saveTransaction') ?>",
            data: $('#TransactionManageForm').serialize(),
            success: function(response) {
                $("#modal-view").modal('toggle');
                if ($("#code").val() == "add") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Transaction has been created successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                } else {
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Transaction has been updated successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                }

                transactionList();
            }
        });
    });
</script>