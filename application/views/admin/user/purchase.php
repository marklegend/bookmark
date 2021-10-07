
<?php $settings = get_settings(); ?>
<?php
    $paypal_url = ($settings->paypal_mode == 'sandbox')?'https://www.sandbox.paypal.com/cgi-bin/webscr':'https://www.paypal.com/cgi-bin/webscr';
    $paypal_id= html_escape($settings->paypal_email);
?>

<div class="content-wrapper">
    <div class="content">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6 m-auto">

                    
                    <?php if ($billing_type == 'monthly'): ?>
                        <?php 
                            $price = number_format($package->monthly_price, 2); 
                            $frequency = 'Per month';
                            $billing_type = 'monthly';
                        ?>
                    <?php else: ?>
                        <?php 
                            $price = number_format($package->price, 2); 
                            $frequency = 'Per year';
                            $billing_type = 'yearly';
                        ?>
                    <?php endif ?>
                    <?php $price = get_tax($price, settings()->tax_value); ?>

                    <ul class="nav nav-pills mb-3 mt-5 justify-content-center" id="pills-tab" role="tablist">
                        <?php if (settings()->paypal_payment == 1): ?>
                            <li class="nav-item">
                                <a class="nav-link active" id="paypal-tab" data-toggle="pill" href="#paypal" role="tab" aria-controls="paypal" aria-selected="true"><?php echo trans('paypal') ?></a>
                            </li>
                        <?php endif; ?>

                        <?php if (settings()->stripe_payment == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(settings()->stripe_payment == 1 && settings()->paypal_payment == 0){echo "active";} ?>" id="stripe-tab" data-toggle="pill" href="#stripe" role="tab" aria-controls="stripe" aria-selected="false"><?php echo trans('stripe') ?></a>
                        </li>
                        <?php endif; ?>

                        <?php if (settings()->enable_offline_payment == 1): ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(settings()->stripe_payment == 0 && settings()->paypal_payment == 0){echo "active";} ?>" id="offline-tab" data-toggle="pill" href="#offline" role="tab" aria-controls="offline" aria-selected="false"><?php echo trans('offline-payment') ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>

                    <div class="card mt-4">
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show <?php if (settings()->stripe_payment == 0){echo "active";} ?> <?php if (settings()->stripe_payment == 1 && settings()->paypal_payment == 1){echo "active";} ?>" id="paypal" role="tabpanel" aria-labelledby="paypal-tab">

                                    <p class="mb-0 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> </p>
                                    <p class="mb-0"><strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> </strong> <small><?php echo html_escape($frequency) ?></small></p>

                                    <?php if (settings()->tax_value != '' && settings()->tax_value != 0): ?>
                                        <p class="small"><?php echo settings()->tax_name ?> (<?php echo settings()->tax_value ?>%)</p>
                                    <?php endif ?>


                                    <!-- PRICE ITEM -->
                                    <form action="<?php echo html_escape($paypal_url); ?>" method="post" name="frmPayPal1">
                                    
                                        <input type="hidden" name="business" value="<?php echo html_escape($paypal_id); ?>" readonly>
                                        <input type="hidden" name="cmd" value="_xclick">
                                        <input type="hidden" name="item_name" value="<?php echo html_escape($package->name);?>">
                                        <input type="hidden" name="item_number" value="1">
                                        <input type="hidden" name="amount" value="<?php echo html_escape($price) ?>" readonly>
                                        <input type="hidden" name="no_shipping" value="1">
                                        <input type="hidden" name="currency_code" value="<?php echo html_escape($settings->currency_code);?>">
                                        <input type="hidden" name="cancel_return" value="<?php echo base_url('admin/subscription/payment_cancel/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">
                                        <input type="hidden" name="return" value="<?php echo base_url('admin/subscription/payment_success/'.$billing_type.'/'.html_escape($package->id).'/'.html_escape($payment_id)) ?>">  
                                        
                                        <div class="mt-4">
                                            <button class="btn btn-primary paypal-btn btn-block" href="#"><?php echo trans('pay-now') ?></button>
                                        </div>
                                        
                                    </form>
                                    <!-- /PRICE ITEM -->
                                </div>

                                <div class="tab-pane fade show <?php if (settings()->paypal_payment == 0){echo "active";} ?>" id="stripe" role="tabpanel" aria-labelledby="stripe-tab">
                                    <div class="credit-card-box">
                                        <div class="d-flex justify-content-between">
                                            <div class="pt-1"><h5><?php echo trans('card-details') ?></h5> </div>
                                            <div>
                                                <i class="text-primary fab fa-cc-visa fa-2x"></i> 
                                                <i class="text-primary fab fa-cc-mastercard fa-2x"></i> 
                                                <i class="text-primary fab fa-cc-discover fa-2x"></i> 
                                                <i class="text-primary fab fa-cc-amex fa-2x"></i>
                                            </div>
                                        </div><hr>
                                       
                                        <div class="box-body p-0">
                            
                                            <form role="form" action="<?php echo base_url('admin/subscription/stripe_payment') ?>" method="post" class="require-validation stripe_form" data-cc-on-file="false" data-stripe-publishable-key="<?php echo html_escape($settings->publish_key); ?>" id="payment-form">
                                                
                                                <div class='row'>
                                                    <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                    </div>
                                                    <div class='col-xs-12 col-md-6 form-group required text-left'>
                                                    </div>
                                                </div>

                                                <div class='row'>
                                                    <div class='col-xs-12 col-md-12 form-group required text-left'>
                                                        <label class='control-label'><?php echo trans('card-number') ?></label> 
                                                        <input autocomplete='off' class='textfield textfield--grey card-number'
                                                            type='text' value="" size='6'>
                                                    </div>
                                                    <div class='col-xs-12 col-md-12 form-group required text-left'>
                                                        <label class='control-label'><?php echo trans('cardholders-name') ?></label> 
                                                        <input class='textfield textfield--grey' type='text' value="" size='6'>
                                                    </div>
                                                </div>
                                    

                                                <div class='form-row row'>
                                                    <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                        <label class='control-label'><?php echo trans('month') ?></label> <input
                                                            class='textfield textfield--grey card-expiry-month' placeholder='MM' size='2'
                                                            type='text' value="">
                                                    </div>
                                                    <div class='col-xs-12 col-md-4 form-group expiration required text-left'>
                                                        <label class='control-label'><?php echo trans('year') ?></label> <input
                                                            class='textfield textfield--grey card-expiry-year' placeholder='YYYY' size='4'
                                                            type='text' value="">
                                                    </div>
                                                    <div class='col-xs-12 col-md-4 form-group cvc required text-left'>
                                                        <label class='control-label'>CVC</label> <input autocomplete='off'
                                                            class='textfield textfield--grey card-cvc' placeholder='ex. 311' size='4'
                                                            type='text' value="">
                                                    </div>
                                                </div>

                                                <!-- csrf token -->
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                                <input type="hidden" name="billing_type" value="<?php echo html_escape($billing_type); ?>" readonly>
                                                <input type="hidden" name="package_id" value="<?php echo html_escape($package->id); ?>" readonly>
                                                <input type="hidden" name="payment_id" value="<?php echo html_escape($payment_id); ?>" readonly>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p class="mb-0 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> </p>
                                                        <p class="mb-0"><strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> </strong> <small><?php echo html_escape($frequency) ?></small></p>
                                                        <?php if (settings()->tax_value != '' && settings()->tax_value != 0): ?>
                                                            <p class="small"><?php echo settings()->tax_name ?> (<?php echo settings()->tax_value ?>%)</p>
                                                        <?php endif ?>
                                                        
                                                        <div class="text-center text-success">
                                                            <div class="payment_loader hide"><i class="fa fa-spinner fa-spin"></i> <?php echo trans('loading') ?>....</div><br>
                                                        </div>
                                                        <button class="btn btn-primary payment_btn btn-block" type="submit"><?php echo trans('pay-now') ?></button>
                                                    </div>
                                                </div>
                                                        
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade show <?php if(settings()->stripe_payment == 0 && settings()->paypal_payment == 0){echo "active";} ?>" id="offline" role="tabpanel" aria-labelledby="offline-tab">
                                   
                                        <div class="box-body p-0">

                                            <div class="row">
                                                <div class="col-md-12 mb-4">
                                                    <p class="text-left"><?php echo trans('offline-payment-instructions') ?></p>
                                                    <div class="bg-light p-4"><p><?php echo $settings->offline_details ?></p></div>
                                                </div>

                                                <div class="col-md-12">
                                                    <p class="mb-0 text-center"><?php echo trans('plan') ?>: <?php echo html_escape($package->name);?> </p>
                                                    <p class="mb-0"><strong><?php echo html_escape($settings->currency_symbol); ?><?php echo html_escape($price) ?> </strong> <small><?php echo html_escape($frequency) ?></small></p>
                                                    <?php if (settings()->tax_value != '' && settings()->tax_value != 0): ?>
                                                        <p class="small"><?php echo settings()->tax_name ?> (<?php echo settings()->tax_value ?>%)</p>
                                                    <?php endif ?>
                                                    
                                                    <div class="text-center text-success">
                                                        <div class="payment_loader hide"><i class="fa fa-spinner fa-spin"></i> <?php echo trans('loading') ?>....</div><br>
                                                    </div>
                                                </div>
                                            </div>
                            
                                            <form enctype="multipart/form-data" action="<?php echo base_url('admin/subscription/offline_payment') ?>" method="post" class="form-horizontal">
                                                
                                                <div class="form-group">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" name="file" aria-invalid="false" required>
                                                        <label class="custom-file-label" for="customFile"><?php echo trans('upload-payment-proof') ?></label>
                                                    </div>
                                                </div>
                                    
                                                <!-- csrf token -->
                                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                                                <input type="hidden" name="billing_type" value="<?php echo html_escape($billing_type); ?>" readonly>
                                                <input type="hidden" name="package_id" value="<?php echo html_escape($package->id); ?>" readonly>
                                                <input type="hidden" name="payment_id" value="<?php echo html_escape($payment_id); ?>" readonly>
                                                
                                                <button class="btn btn-primary btn-block" type="submit"><?php echo trans('submit') ?></button>
                                            </form>
                                        </div>
                               
                                </div>

                            </div>
                        </div>
                    </div>
               
                </div>
            </div>
        </div>
    </div>
</div>