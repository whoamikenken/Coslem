
<style type="text/css">
    .card.mb-4 {
        height: 400px;
    }
</style>
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<?php if ($this->session->userdata("type") == "admin"): ?>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white sm-4">
                <div class="card-body"><span>Member</span><br><?= $memberCount ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link menuLink" type="button" tag="member" siteName="setup/member" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white sm-4">
                <div class="card-body"><span>Treasurer</span> <br><?= $treasurerCount ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link menuLink" href="#" type="button" tag="tresurer" siteName="setup/tresurer">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white sm-4">
                <div class="card-body"><span>Admin Account</span><br> <?= $adminCount ?></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link menuLink" href="#" type="button" tag="admin" siteName="setup/admin">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white sm-4">
                <div class="card-body"><span>Transactions</span><br><span><?= $transactionCount ?></span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="#">View Details</a>
                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
        </div>
    </div>
    <br><br>
<?php endif ?>
<div class="row">
    <?php if ($this->session->userdata("type") == "admin"){ ?>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Funds 
                </div>
                <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
            </div>
        </div>
    <?php }elseif($this->session->userdata("type") == "member"){ ?>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Funds 
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Available Funds: <?= $user_funds[0]['available'].".00" ?></li>
                        <li class="list-group-item">Total Contributions: <?= $user_funds[0]['contribution'].".00" ?></li>
                        <li class="list-group-item">Pending Balance: <?= $user_funds[0]['balance'].".00" ?></li>
                        <?php if ($loanAmountMontly): ?>
                            <li class="list-group-item">
                                Monthly: <?= $loanAmountMontly.".00" ?>
                            </li>
                        <?php endif ?>
                        <?php if ($loanAmountMontly): ?>
                            <li class="list-group-item">
                                Remain Loan Balance: <?= $remainingBalance.".00" ?>
                            </li>
                        <?php endif ?>
                    </ul>
                    <div class="card-footer text-muted">
                        <!-- <a href="#" id="createLoan" class="btn btn-primary">Request loan</a> -->
                    </div>
                </div>
            </div>
        </div>
    <?php }else{ ?>
        
    <?php } ?>
    <div class="col-xl-6">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-chart-bar me-1"></i>
                Total Contributions
            </div>
            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
        </div>
    </div>
</div>
<div class="card mb-4">
    <div class="card-header">
        <i class="bi bi-list-columns-reverse"></i>
        Recent Transaction
    </div>
    <div class="card-body" id="recent">
        
    </div>
</div>
                   
<script src="<?= base_url() ?>js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#datatablesSimple').DataTable();
        getUserContributionChart();
        getUserTransactions();
        getFundsData();
    });

    function getUserTransactions(){
        $.ajax({
            type: "POST",
            url: "<?= site_url('Setup_/loadRecentTransaction')?>",
            data: {},
            success:function(response){
                $("#recent").html(response);
            }
        });
    }


    function getFundsData(){
        $.ajax({
            type: "POST",
            url: "<?= site_url('Setup_/getTotalFunds')?>",
            data: $('#userManageForm').serialize(),
            dataType: "json",
            success:function(response){
              // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#292b2c';

                // Bar Chart Example
                var ctx = document.getElementById("myAreaChart");
                var myLineChart = new Chart(ctx, {
                  type: 'pie',
                  data: {
                    labels: ['Total Funds', 'Current Funds', 'Loan', 'Unpaid Funds'],
                    datasets: [{
                      label: 'Funds',
                      backgroundColor: ['#4dc9f6','#537bc4','#f53794','#f67019','#D53343'],
                      data: JSON.parse(response.data),
                    }],
                  },
                  options: {
                    responsive: true,
                    plugins: {
                      legend: {
                        position: 'top',
                      },
                      title: {
                        display: true,
                        text: 'Funds Total'
                      }
                    }
                  }
                });
            }
        });
    }

    function getUserContributionChart(){
        $.ajax({
            type: "POST",
            url: "<?= site_url('Setup_/getUserTransactionPerMonth')?>",
            data: $('#userManageForm').serialize(),
            dataType: "json",
            success:function(response){
                // Set new default font family and font color to mimic Bootstrap's default styling
                Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
                Chart.defaults.global.defaultFontColor = '#292b2c';

                // Bar Chart Example
                var ctx = document.getElementById("myBarChart");
                var myLineChart = new Chart(ctx, {
                  type: 'bar',
                  data: {
                    labels: JSON.parse(response.month),
                    datasets: [{
                      label: "Contribution",
                      backgroundColor: "rgba(2,117,216,1)",
                      borderColor: "rgba(2,117,216,1)",
                      data: JSON.parse(response.data),
                    }],
                  },
                  options: {
                    scales: {
                      xAxes: [{
                        time: {
                          unit: 'month'
                        },
                        gridLines: {
                          display: false
                        }
                      }],
                      yAxes: [{
                        ticks: {
                          min: 0,
                          max: 15000,
                          maxTicksLimit: 5
                        },
                        gridLines: {
                          display: true
                        }
                      }],
                    },
                    legend: {
                      display: false
                    }
                  }
                });

            }
        });
    }
</script>