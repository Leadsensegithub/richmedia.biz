<?php
$camdata=array();
$compaignstype=array(
  'banner'=>1,
  'pop'=>2,
  'video'=>3,
  'push'=>4,
  'push'=>4,
  'native'=>5
);
if(isset($_REQUEST['token'])){
  $camdata=$this->getAllCampaignsByEncriptGroupId($_REQUEST['token']); 
}
?>
<section class="content">
  <div class="white-wapper">
    <div class="white-layer">
      <h4 class="white-layer-title"><?php echo $_REQUEST['type'] ?> - Campaign Details</h4>
      <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
          <div class="stepwizard-step col-xs-2">
            <a type="button" href="?step=1&token=<?php echo $_REQUEST['token'] ?>" class="btn btn-default btn-circle">1</a>
            <p><small>Campaign Details</small></p>
          </div>
          <div class="stepwizard-step col-xs-2">
            <a type="button" href="?step=2&token=<?php echo $_REQUEST['token'] ?>" class="btn btn-default btn-circle">2</a>
            <p><small>Targeting</small></p>
          </div>
          <div class="stepwizard-step col-xs-2">
            <a type="button" href="?step=3&token=<?php echo $_REQUEST['token'] ?>" class="btn btn-default btn-circle">3</a>
            <p><small>Campaign Type</small></p>
          </div>
          <div class="stepwizard-step col-xs-2">
            <a type="button" href="?step=5&type=<?php echo $_REQUEST['type'] ?>&token=<?php echo $_REQUEST['token'] ?>" class="btn btn-default btn-circle">4</a>
            <p><small>Creative Details</small></p>
          </div>
          <div class="stepwizard-step col-xs-2">
            <a type="button" class="active btn btn-default btn-circle">5</a>
            <p><small>Pricing</small></p>
          </div>
          <div class="stepwizard-step col-xs-2">
            <a type="button" class="btn btn-default btn-circle" disabled="disabled">6</a>
            <p><small>Scheduling</small></p>
          </div>
        </div>
      </div>
      <form method="post" class="theme-fields-form" enctype="multipart/form-data">
      	<div class="row">
          <div class="col-md-12">
            <div class="white-box pt-5 pl-5 pr-5">
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-8">
                    <h4 class="white-box-sub-titile">Pricing:</h4>
                  </div>
                  <div class="col-sm-4">
                  <button type="button" class="btn btn-sm btn-warning pull-right" onclick="addNewCountry()"><i class="fa fa-plus"></i></button>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="tableFixHead">
                      <table id="countries_table">
                        <thead>
                          <tr>
                            <th>Country</th>
                            <th>Model</th>
                            <th>Min. Bid</th>
                            <th>Max. Bid</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (!empty($camdata)) {
                            foreach ($camdata as $key => $cam) {
                          ?>
                              <tr>
                                <td colspan="4" class="text-center">There were some core modification on this campaign. The old records will be vanished based on this update.</td>
                              </tr>
                              <tr <?php if($cam['model']!=$_REQUEST['model']){ ?>style="opacity: 0.5" <?php } ?>>
                                <td>
                                  <select class="form-control" name="country[]" disabled>
                                    <option value="">Select Country</option>
                                  <?php
                                  $cam['typeid'];

                                  $countries_bids=$this->pricing->getAllPricesCountriesByType($compaignstype[$cam['type']],$cam['model']);
                                  if(!empty($countries_bids)){
                                    foreach ($countries_bids as $key => $bid) {
                                  ?>
                                    <option <?php echo selectOption($cam['country'],$bid['country_id']) ?> data-minbid="<?php echo $bid['min_bid'] ?>" data-maxbid="<?php echo $bid['max_bid'] ?>" value="<?php echo $bid['country_id'] ?>"><?php echo $bid['name'] ?></option>
                                  <?php
                                    }
                                  }
                                  ?>
                                  </select>
                                </td>
                                <td>
                                  <?php $model=$this->models->getModelByID($cam['model']); echo $model['name'] ?>
                                </td>
                                <td class="minbid">
                                  <input type="number" class="form-control" value="<?php echo $cam['min_bid'] ?>" disabled>
                                </td>
                                <td class="maxbid">
                                  <input type="number" class="form-control" value="<?php echo $cam['max_bid'] ?>" disabled>
                                </td>
                              </tr>
                          <?php
                            }
                          }
                          ?>
                          <tr>
                            <td>
                              <select class="form-control" name="country[]" onchange="selectContry(this)" required>
                                <option value="">Select Country</option>
                              <?php
                              $countries_bids=$this->pricing->getAllPricesCountriesByType($_REQUEST['typeid'],$_REQUEST['model']);
                              if(!empty($countries_bids)){
                                foreach ($countries_bids as $key => $bid) {
                              ?>
                                <option data-minbid="<?php echo $bid['min_bid'] ?>" data-maxbid="<?php echo $bid['max_bid'] ?>" value="<?php echo $bid['country_id'] ?>"><?php echo $bid['name'] ?></option>
                              <?php
                                }
                              }
                              ?>
                              </select>
                            </td>
                            <td>
                              <?php $model=$this->models->getModelByID($_REQUEST['model']); echo $model['name'] ?>
                            </td>
                            <td class="minbid"></td>
                            <td class="maxbid"></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-12">
            <br/>
            <input type="hidden" name="step" value="6">
            <input type="hidden" name="type" value="<?php echo $_REQUEST['type'] ?>">
            <input type="hidden" name="typeid" value="1">
            <input type="submit" value="Next" name="save" class="btn btn-warning pull-right">
            <a class="btn btn-warning pull-left" href="<?php echo baseurl ?>/advertiser/new-campaign.php?step=5&type=<?php echo $_REQUEST['type'] ?>&token=<?php echo $_REQUEST['token'] ?>">Back</a>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>
<style type="text/css">
.imagepreview-cover{
  width:100%;
  height:150px;
  background:#b1b1b1;
  text-align: center;
}
#blah{
  max-height: 100%;
  max-width: 100%;
  margin: 0 auto;
}
.tableFixHead          { overflow-y: auto; height: 305px; }
.tableFixHead thead th { position: sticky; top: 0; }

/* Just common table stuff. Really. */
table  { border-collapse: collapse; width: 100%; }
th, td { padding: 8px 16px; }
th     { background:#eee; }
</style>
<script type="text/javascript">
  function selectContry(ele) {
  var min=$(ele).find(':selected').attr('data-minbid');
  var max=$(ele).find(':selected').attr('data-maxbid');
  var minbid='<input type="number" class="form-control" name="min_bid['+ele.value+']" min="'+min+'" max="'+max+'" required>';
  var maxbid='<input type="number" class="form-control" name="max_bid['+ele.value+']" min="'+min+'" max="'+max+'" required> <button type="button" class="remove-btn float-remove btn btn-sm btn-danger pull-right" onclick="removeCountry(this)"><i class="fa fa-minus"></i></button>';
  $(ele).parents('tr').children('.minbid').html(minbid);
  $(ele).parents('tr').children('.maxbid').html(maxbid);
}

function addNewCountry() {
  var html = '<tr>';
      html += '<td>';
      html += '<select class="form-control" name="country[]" onchange="selectContry(this)">';
      html += '<option value="">Select Country</option>';
      <?php
      $countries_bids=$this->pricing->getAllPricesCountriesByType($_REQUEST['typeid'],$_REQUEST['model']);
      if(!empty($countries_bids)){
        foreach ($countries_bids as $key => $bid) {
      ?>
      html += '<option data-minbid="<?php echo $bid['min_bid'] ?>" data-maxbid="<?php echo $bid['max_bid'] ?>" value="<?php echo $bid['country_id'] ?>"><?php echo $bid['name'] ?></option>';
    <?php
      }
    }
    ?>
    html += '</select>';
  html += '</td>';
  html += '<td><?php $model=$this->models->getModelByID($_REQUEST['model']); echo $model['name'] ?></td>';
  html += '<td class="minbid"></td>';
  html += '<td class="maxbid"><button type="button" class="remove-btn btn btn-sm btn-warning pull-right" onclick="removeCountry(this)"><i class="fa fa-minus"></i></button></td>';
  html += '</tr>';
  $('#countries_table tbody').append(html);
}
function removeCountry(ele) {
  $(ele).parents('tr').remove();
}
</script>