<div class="col-lg-12 animate__animated animate__fadeInRight">
  <h1><i class="bi bi-person-lines-fill"></i></i> Member Setup</h1>
  <hr />
</div>
<div class="card sm-12 border-primary animate__animated animate__fadeInRight">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-chart-area me-1"></i>
        Member list 
    </div>
    <div class="card-body" id="table-container">

    </div>
</div>

</div>

<script>
    memberSetup();

    function memberSetup(){
        var code_table = "member";
        $.ajax({
            type: "POST",
            url: "<?= site_url('Setup_/loadUserTable')?>",
            data: {type:"member"},
            success:function(response){
                $("#table-container").html(response);
            }
        });
    }
</script>