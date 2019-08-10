<div class="row">
<h5>Select Your Plan</h5>
</div><div class="row">
    <p>Based on your Requirement Add Pack</p>
    <hr>
</div>
<div class="row">
          <div class="col-lg-4 col-md-6 col-sm-6">
          <a href="javascript:selectplan(1)"><div class='planover' id="plan1"></div></a>
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-globe text-warning"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Plan 1</p>
                      <p class="card-title">&euro; 100<p>
                    </div>
                  </div>
                </div>
              </div>
              <hr style="margin-bottom: 0px;">
  <div style="font-size: 20px;height: 30px;">
    <div style="float: left;text-align: center;background-color: #ffffff;width: 50%;font-weight: bold;"> X 1</div>
    <a href="javascript:addpack(1)"><div style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 50%;"> ADD</div></a>
  </div>
  <hr style="margin-top: 0px;">
              <div class="card-footer ">
               
                <div class="stats" style="font-weight: bold;color: black;">
                  <img src="invest.png" style="width: 34px;"> Total 100
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-4 col-md-6 col-sm-6">
          <a href="javascript:selectplan(2)"><div class='planover' id="plan2"></div></a>
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-money-coins text-success"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Plan 1</p>
                      <p class="card-title">&euro; 1000
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <hr style="margin-bottom: 0px;">
  <div style="font-size: 20px;height: 30px;">
    <div  style="float: left;text-align: center;background-color: #ffffff;width: 50%;font-weight: bold;"> X 1</div>
    <a href="javascript:addpack(2)"><div style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 50%;"> ADD</div></a>
  </div>
  <hr style="margin-top: 0px;">
              <div class="card-footer ">
               
                <div class="stats" style="font-weight: bold;color: black;">
                  <img src="invest.png" style="width: 34px;"> Total 1000
                </div>
              </div>
            </div>
          </div>


          <div class="col-lg-4 col-md-6 col-sm-6">
          <a href="javascript:selectplan(3)"><div class='planover' id="plan3"></div></a>
            <div class="card card-stats">
              <div class="card-body ">
                <div class="row">
                  <div class="col-5 col-md-4">
                    <div class="icon-big text-center icon-warning">
                      <i class="nc-icon nc-vector text-danger"></i>
                    </div>
                  </div>
                  <div class="col-7 col-md-8">
                    <div class="numbers">
                      <p class="card-category">Plan 1</p>
                      <p class="card-title">&euro; 10,000
                        <p>
                    </div>
                  </div>
                </div>
              </div>
              <hr style="margin-bottom: 0px;">
  <div style="font-size: 20px;height: 30px;">
    <div id="packno3" style="float: left;text-align: center;background-color: #ffffff;width: 50%;font-weight: bold;"> X 1</div>
    <a href="javascript:addpack(3)"><div style="color: white;float: right;text-align: center;font-weight: 800;background-color: #5ccbcf;width: 50%;"> ADD</div></a>
  </div>
  <hr style="margin-top: 0px;">
              <div class="card-footer ">
               
                <div class="stats" style="font-weight: bold;color: black;">
                  <img src="invest.png" style="width: 34px;"><span id="packno3txt"> Total 10,000</span>
                </div>
              </div>
            </div>
          </div>
          
          
   
        
        </div>   

        <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Proceed</button>
                    </div>
                  </div>
                  <style>
                    .planover{

    position: absolute;
    background-color: #00000047;
    width: 91%;
    height: 90%;
    border-radius: 12px;
    box-shadow: 0 6px 10px -4px rgba(0, 0, 0, 0.15);
    /* background-color: #FFFFFF; */
    color: #252422;
    margin-bottom: 20px;
    /* position: relative; */
    z-index: 101;
    border: 0 none;
                    }
                    </style>
                    <script>
                      function selectplan(plan){
                        pack1=1;
                        pack2=1;
                        pack3=1;
                        for (var i=1;i<=3;i++)
                        {
                          $("#plan"+i).show();
                        }
                        $("#plan"+plan).hide();
                      }
                      var pack1=0;
                      var pack2=0;
                      var pack3=0;
                      function addpack(plan)
                      {
                        var val =0;
                        var val1=0;
                        if (plan==1)
                        {
                          pack1++;val = pack1;val1=100;
                        }else if (plan==2)
                        {
                          pack2++;val = pack2;val1=1000;
                        }else if (plan==3)
                        {
                          pack3++;val = pack3;val1=10000;
                        }
                        
                        if (val <10){
                        
                        $("#packno"+plan).html("X "+val);
                        $("#packno"+plan+"txt").html(val*val1);
                        }
                        
                      }
                      </script>