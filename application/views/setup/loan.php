<div class="col-lg-12 animate__animated animate__fadeInRight">
  <h1><i class="bi bi-bank2"></i></i> Loan</h1>
  <hr />
</div>
<div class="card sm-12 border-primary animate__animated animate__fadeInRight">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-chart-area me-1"></i>
        Loan Request list 
    </div>
    <div class="card-body" id="table-container">

    </div>
</div>

</div>

<script>
    loanList();

    function loanList(){
        $.ajax({
            type: "POST",
            url: "<?= site_url('Setup_/loadLoanTable')?>",
            data: {},
            success:function(response){
                $("#table-container").html(response);
            }
        });
    }
</script>