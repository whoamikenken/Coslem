<div class="col-lg-12 animate__animated animate__fadeInRight">
  <h1><i class="bi bi-person-lines-fill"></i></i> Treasurer Setup</h1>
  <hr />
</div>
<div class="card sm-12 border-primary animate__animated animate__fadeInRight">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-chart-area me-1"></i>
        Treasurer list 
    </div>
    <div class="card-body" id="table-container">

    </div>
</div>

</div>

<script>
    treasurerSetup();

    function treasurerSetup(){
        var code_table = "treasurer";
        $.ajax({
            type: "POST",
            url: "<?= site_url('Setup_/loadUserTable')?>",
            data: {type:"treasurer"},
            success:function(response){
                $("#table-container").html(response);
            }
        });
    }
</script>