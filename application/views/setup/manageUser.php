
<form id="userManageForm">
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" aria-describedby="username" value="<?= isset($record['username']) ? $record['username']:"" ?>">
    </div>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="name" value="<?= isset($record['name']) ? $record['name']:"" ?>">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="email" value="<?= isset($record['email']) ? $record['email']:"" ?>">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" aria-describedby="password">
    </div>
    <div class="mb-3">
        <label for="mobile" class="form-label">Cellphone #</label>
        <input type="mobile" class="form-control" id="mobile" name="mobile" aria-describedby="mobile" value="<?= isset($record['mobile']) ? $record['mobile']:"" ?>">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" aria-describedby="address" value="<?= isset($record['address']) ? $record['address']:"" ?>">
    </div>
    <div class="mb-3">
        <label for="age" class="form-label">Age</label>
        <input type="number" class="form-control" id="age" name="age" aria-describedby="age" value="<?= isset($record['age']) ? $record['age']:"" ?>">
    </div>
    <div class="mb-3">
        <label for="gender" class="form-label">Gender</label>
        <select class="form-select" aria-label="gender" name="gender">
            <option value="Male" <?= (isset($record['gender']) && $record['gender'] == "Male")? "selected":"" ?>>Male</option>
            <option value="Female" <?= (isset($record['gender']) && $record['gender'] == "Female")? "selected":"" ?>>Female</option>
      </select>
    </div>
    <div class="mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" aria-label="status" name="status" <?= (isset($record['status']) && $record['status'] == "Verified")? "disabled":"" ?>>
            <option value="Unverified" <?= (isset($record['status']) && $record['status'] == "Unverified")? "selected":"" ?>>Unverified</option>
            <option value="Verified" <?= (isset($record['status']) && $record['status'] == "Verified")? "selected":"" ?>>Verified</option>
        </select>
    </div>
    <?php if ($tableCode == "member"): ?>
        <div class="mb-3">
            <label class="form-label">Share</label>
            <input type="number" class="form-control" name="share" id="share" value="<?= isset($record['share']) ? $record['share']:"" ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Contribution</label>
            <input type="number" class="form-control" name="contribution" id="contribution" value="<?= isset($record['contribution']) ? $record['contribution']:"" ?>" readonly>
        </div>
    <?php endif ?>
    <div class="mb-3">
        <label for="age" class="form-label">Image</label>
        <input type="file" class="form-control" id="file" name="file" aria-describedby="file">
    </div>
    <input type="hidden" name="type" value="<?= $tableCode ?>">
    <input type="hidden" id="code" name="code" value="<?= $code ?>">
</form>

<script type="text/javascript">
    $("#saveModal").unbind().click(function(){
        Swal.fire({
            title: 'Please Wait!',
            html: '',// add html attribute if you want or remove
            allowOutsideClick: false,
            onBeforeOpen: () => {
                Swal.showLoading()
            },
        });
        var formdata = new FormData($('#userManageForm')[0]);
        
        $.ajax({
            type: "POST",
            url: "<?= site_url('setup_/saveUser')?>",
            data: formdata,
            processData: false,
            contentType: false,
            success:function(response){
                $("#modal-view").modal('toggle');
                if ($("#code").val() == "add") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'User has been added successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                }else{
                    Swal.fire({
                        icon: 'success',
                        title: 'Updated!',
                        text: 'User has been updated successfully.',
                        showConfirmButton: true,
                        timer: 2000
                    })
                }

                if ("<?= $tableCode ?>" == "member") {
                    memberSetup();
                }else if("<?= $tableCode ?>" == "treasurer"){
                    treasurerSetup();
                }else if("<?= $tableCode ?>" == "admin"){
                    adminSetup();
                }else{
                    location.reload();
                }
            }
        });
    });


    $("#share").on("blur",  function() {
        var contri = $(this).val() * parseInt("<?= $share ?>");
        $("#contribution").val(contri);
    });
</script>