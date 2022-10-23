</div>
            </main>
         <!--    <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; COSLEM 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer> -->
        </div>
    </div>
    
</body>
<script type="text/javascript">
  $(window).on('load', function(){
     
  });

  $('#modal-view').on('hidden.bs.modal', function (e) {
    $("#saveModal").show();
  })

  $(".menuLink").on("click",  function() {
    var site = $(this).attr("siteName");
    var titlebar = $(this).text();
    var data = $(this).attr("tag");
    $("#mainform").attr("action","<?=site_url("Main_/site")?>");
    $("input[name='sitename']").val(site);
    $("input[name='titlebar']").val(titlebar);
    $("input[name='tag']").val(data);
    if(site) $("#mainform").submit();
  });

  function monthDiff(d1, d2) {
        var months;
        months = (d2.getFullYear() - d1.getFullYear()) * 12;
        months -= d1.getMonth();
        months += d2.getMonth();
        return months <= 0 ? 0 : months;
  }

  function formatDate(date) {
      var d = new Date(date),
          month = '' + (d.getMonth() + 1),
          day = '' + d.getDate(),
          year = d.getFullYear();

      if (month.length < 2) 
          month = '0' + month;
      if (day.length < 2) 
          day = '0' + day;

      return [year, month, day].join('-');
  }

  Date.prototype.addMonths = function (value) {
      var n = this.getDate();
      this.setDate(1);
      this.setMonth(this.getMonth() + value);
      this.setDate(Math.min(n, this.getDaysInMonth()));
      return this;
  };

  Date.isLeapYear = function (year) { 
      return (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0)); 
  };

  Date.getDaysInMonth = function (year, month) {
      return [31, (Date.isLeapYear(year) ? 29 : 28), 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
  };

  Date.prototype.isLeapYear = function () { 
      return Date.isLeapYear(this.getFullYear()); 
  };

  Date.prototype.getDaysInMonth = function () { 
      return Date.getDaysInMonth(this.getFullYear(), this.getMonth());
  };

  function bootstrapForm(form){

    console.log($(form).find('input.validate'))
  $(form).find('select.validate').each(function(idx){
    $(this).parent().find('input').addClass("is-invalid");
    if($(this).val().length == 0){
    throw new Error("Something went badly wrong!");
    }else{
    $(this).parent().find('input').removeClass("is-invalid");
    $(this).parent().find('input').addClass("is-valid");
  }
  });

  $(form).find('input.validate').each(function(idx){
    if($(this).val().length == 0){
    $(this).addClass("is-invalid");
    throw new Error("Something went badly wrong!");
    }else{
    $(this).removeClass("is-invalid").addClass("is-valid");
  }
  });


  $(form).find('textarea.validate').each(function(idx){
    if($(this).val().length == 0){
    $(this).addClass("is-invalid");
    throw new Error("Something went badly wrong!");
    }else{
    $(this).removeClass("is-invalid").addClass("is-valid");
  }
  });
  return true;
  }

  $("#logout").on("click",  function() {
    $.ajax({
        type: "POST",
        url: "<?= site_url('Main_/logout')?>",
        data: {},
        success:function(response){
          window.location.href = '<?= base_url() ?>';
        }
    });
  });

  $(".contribution").on("click",  function() {
    var site = $(this).attr("siteName");
    
    $.ajax({
        type: "POST",
        url: "<?= site_url('Main_/logout')?>",
        data: {},
        success:function(response){
          window.location.href = '<?= base_url() ?>';
        }
    });
  });
</script>
</html>