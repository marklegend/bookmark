<section class="pt-6">
    <div class="container h-100vh">

        <div class="card">
            <div class="card-body">
                <div class="col-12 text-center">
                    <div class="service-banner-img border-1" style="background-image:url('<?php echo base_url($service->image) ?>')">
                    </div>

                     <a href="<?php echo base_url('booking/'.$company->slug) ?>" class="btn mt-4 btn-light-secondary rounded-pill position-absulate bottom-0"><?php echo trans('book-now') ?></a>
                </div>
              
                <div class="d-flex justify-content-between align-items-center pt-3 pl-3 pr-3">
                    <div class="col-md-6s">
                    <h2 class="h2 font-weight-normal pt-2"><?php echo html_escape($service->name) ?></h2>
                    </div>

                    <div class="col-md-6s">
                        <span class="pr-3">
                            
                            <?php if ($service->price == 0): ?>
                                <?php echo trans('price') ?>: <?php echo trans('free') ?>
                            <?php else: ?>
                                <?php echo trans('price') ?>: <?php echo get_currency_by_country($company->country)->currency_symbol; ?> <?php echo html_escape($service->price) ?>
                            <?php endif ?>
                        </span>
                        <span class="pr-3"><?php echo trans('duration') ?>: <?php echo html_escape($service->duration) ?> min</span>
                    </div>
                </div>

                <div class="row p-3">
                    <div class="col-md-12 text-left">
                        <p class="h5 font-weight-normal"><?php echo trans('staffs') ?></p>
                        <?php $staffs = json_decode($service->staffs);?>
                        <?php if (!empty($staffs)): ?>
                            <div class="staffs-list2 align-items-left">
                                <?php foreach ($staffs as $staff): ?>
                                    <img class="staff-avatar" src="<?php echo base_url(get_by_id($staff, 'staffs')->thumb) ?>" data-toggle="tooltip" data-placement="top" title="<?php echo get_by_id($staff, 'staffs')->name; ?>">
                                <?php endforeach ?>
                            </div>
                        <?php endif ?>
                    </div>

                    <div class="col-md-12 text-left mt-6">
                        <?php echo $service->details ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>