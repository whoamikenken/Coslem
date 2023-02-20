<?php 
$readonly = "";
if($type == "viewing") $readonly = "readonly";

?>
<form id="loanManageForm">
    <div class="mb-3">
        <label for="user_id" class="form-label">User</label>
        <select class="form-select validate" aria-label="user_id" name="user_id" <?= $readonly ?>>
            <?php foreach ($user_list as $key => $value): ?>  
                <option value="<?= $value['id'] ?>" <?= (isset($record['user_id']) && $value['id'] == $record['user_id'])? "selected":"" ?>><?= $value['name'] ?></option>
            <?php endforeach ?>
      </select>
    </div>
    <div class="mb-3">
        <label for="amount" class="form-label">Amount </label>
        <input type="number" class="form-control validate" id="amount" name="amount" aria-describedby="amount" value="<?= isset($record['amount']) ? $record['amount']:"" ?>" <?= $readonly ?>>
    </div>
    <div class="mb-3">
        <label for="months_period" class="form-label">Months To Pay</label>
        <input type="number" class="form-control validate" id="months_period" name="months_period" aria-describedby="months_period" value="<?= isset($record['months_period']) ? $record['months_period']:"" ?>" <?= $readonly ?> >
    </div>
    <div class="mb-3">
        <label for="from_date" class="form-label">Date From</label>
        <input type="text" class="datepicker form-control validate" id="from_date" name="from_date" aria-describedby="from_date" value="<?= isset($record['from_date']) ? $record['from_date']:"" ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="to_date" class="form-label">Date To</label>
        <input type="text" class="datepicker form-control validate" id="to_date" name="to_date" aria-describedby="to_date" value="<?= isset($record['to_date']) ? $record['to_date']:"" ?>" readonly>
    </div>
    <div class="mb-3">
        <label for="remarks" class="form-label">Remarks</label>
        <input type="text" class="form-control validate" id="remarks" name="remarks" aria-describedby="remarks" value="<?= isset($record['remarks']) ? $record['remarks']:"" ?>" <?= $readonly ?>>
    </div>
    <div class="mb-3">
        <label for="monthly" class="form-label">Monthly</label>
        <input type="number" class="form-control validate" id="monthly" name="monthly" aria-describedby="monthly" value="<?= isset($record['monthly']) ? $record['monthly']:"" ?>" <?= $readonly ?>>
    </div>
    <?php if ($this->session->userdata("type") != "member"): ?>
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select validate" aria-label="status" name="status" <?= (isset($record['status']) && $record['status'] == "Verified")? "disabled":"" ?> <?= $readonly ?>>
                <option value="PENDING" <?= (isset($record['status']) && $record['status'] == "PENDING")? "selected":"" ?>>PENDING</option>
                <option value="APPROVED" <?= (isset($record['status']) && $record['status'] == "APPROVED")? "selected":"" ?>>APPROVED</option>
                <option value="DISAPPROVED" <?= (isset($record['status']) && $record['status'] == "DISAPPROVED")? "selected":"" ?>>DISAPPROVED</option>
            </select>
        </div>
    <?php endif ?>

    <input type="hidden" id="code" name="code" value="<?= $code ?>">
</form>
<input type="hidden" id="available" name="available" value="<?= $user_funds[0]['available'] ?>">
<script type="text/javascript">
    $(document).ready(function(){
       if("<?= $readonly ?>" == "readonly"){
           $("#saveModal").hide();
       }
    });

    $("#amount").blur(function() {
      if (Number($(this).val()) > Number($("#available").val())) {
        Swal.fire({
            icon: 'info',
            title: 'Warning!',
            text: 'The total amount of funds available is '+ $("#available").val(),
            showConfirmButton: true,
            timer: 2000
        })
        $("#amount").val("");
        $("#amount").focus();
      }
    });

    $("#months_period").blur(function() {
      if ($("#amount").val() == "") {
        Swal.fire({
            icon: 'info',
            title: 'Warning!',
            text: 'Please input an amount',
            showConfirmButton: true,
            timer: 2000
        })
        $("#amount").focus();
      }else{
        var amount = $("#amount").val();
        var period = $("#months_period").val();
        var monthly = Number(amount) / Number(period);
        var monthlyPercentage = Number(monthly) + (Number(5 / 100) * monthly);
        var interest = Number(amount) - Number(monthlyPercentage) * monthly;
        $("#monthly").val(monthlyPercentage);

        var d = new Date();
        var year = d.getFullYear();
        var month = d.getMonth();
        var day = d.getDate();
        var date_from = new Date(year, month, 01);
        var date_to = new Date(year, month+1, 0);
        date_from = date_from.addMonths(1);
        date_to = date_to.addMonths(Number(period) - Number(1));
        $("#from_date").val(formatDate(date_from));
        $("#to_date").val(formatDate(date_to));
      }
    });

    $("#saveModal").unbind().click(function(){
        bootstrapForm($("#loanManageForm"));
        swal.fire({
            html: '<h4>Loading...</h4>',
            onRender: function() {
                $('.swal2-content').prepend(sweet_loader);
            }
        });
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/saveLoan')?>",
            data: $('#loanManageForm').serialize(),
            success:function(response){
                $("#modal-view").modal('toggle');
                if ($("#code").val() == "add") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Loan has been added successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'Loan has been updated successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                }
                
                loanList();
            }
        });
    });
</script>