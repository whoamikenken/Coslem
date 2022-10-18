<?php 


?>
<form id="reportForm" action="<?= $link ?>" method="POST" target="_blank">
    <?php if ($desc == "user"): ?>
        <div class="mb-3">
            <label for="status" class="form-label">User Type</label>
            <select class="form-select validate" aria-label="type" name="usertype">
                <option value="">All</option>
                <option value="member">Member</option>
                <option value="treasurer">Treasurer</option>
                <option value="admin">Admin</option>
            </select>
        </div>
    <?php endif ?>

    <?php if ($desc == "transaction"): ?>
        <div class="mb-3">
            <label for="status" class="form-label">Transaction Type</label>
            <select class="form-select validate" aria-label="type" name="type">
                <option value="">All</option>
                <option value="Contribution">Contribution</option>
                <option value="Loan">Loan</option>
            </select>
        </div>
        <?php if ($this->session->userdata("type") != "member"): ?>
            <div class="mb-3">
                <label for="status" class="form-label">User</label>
                <select class="form-select validate" aria-label="user_id" name="user_id">
                    <option value="">All</option>
                    <?php foreach ($user_list as $key => $value): ?>
                        <option value="<?= $value['id'] ?>"><?= $value['name'] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
        <?php endif ?>
    <?php endif ?>
 </form>

<script type="text/javascript">
    $("#printPDF").unbind("click").click(function(){
        jQuery('#reportForm').submit();
    });
</script>