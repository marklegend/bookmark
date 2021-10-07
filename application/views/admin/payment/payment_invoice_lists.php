<div class="content-wrapper">

  <!-- Main content -->
  <section class="content container-fluid pt-4 mb-4">

    <div class="card list_area">
      <div class="card-header with-border pl-2">
        <h3 class="card-title"><?php echo trans('payments') ?></h3>
      </div>
    
     
      <div class="col-md-8">
        <div class="card-body table-responsive p-0">
          <table class="table table-hover <?php if(count($payments) > 10){echo "datatable";} ?> cushover" id="dg_table">
              <thead>
                  <tr>
                      <th>#</th>
                      <th><?php echo trans('plan') ?></th>
                      <th><?php echo trans('billing-cycle') ?></th>
                      <th><?php echo trans('price') ?></th>
                      <th><?php echo trans('date') ?></th>
                      <th><?php echo trans('action') ?></th>
                  </tr>
              </thead>
              <tbody>
                <?php $i=1; foreach ($payments as $payment): ?>

                  <?php if ($payment->amount != '0.00'): ?>
                    <tr id="row_<?php echo html_escape($payment->id); ?>">
                        
                        <td><?php echo $i; ?></td>
                        <td><?php echo html_escape($payment->package_name); ?></td>
                        <td><?php echo html_escape($payment->billing_type); ?></td>
                        <td><?php echo html_escape(settings()->currency_symbol) ?><?php echo html_escape($payment->amount); ?></td>
                        <td><?php echo my_date_show($payment->created_at); ?> </td>
                        
                        <td class="actions">
                          <a target="_blank" href="<?php echo base_url('admin/payment/receipt/'.$payment->puid) ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-eye"></i> <?php echo trans('view-invoice') ?></a>
                        </td>
                    </tr>
                  <?php endif ?>
                  
                <?php $i++; endforeach; ?>
              </tbody>
          </table>
        </div>
      </div>

     
    </div>
    

  </section>
</div>
