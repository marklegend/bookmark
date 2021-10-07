<div class="col-md-6 col-lg-4 mb-7" data-aos="fade-up" data-aos-delay="<?php echo $i * 100; ?>">

    <div class="card rounded-lg shadow-hover border-1 transition-hover h-100">
        <a href="<?php echo base_url('service/'.$service->id.'/'.$slug) ?>">
            <div class="cop-bg-img" style="background-image: url(<?php echo base_url($service->image) ?>)">
            </div>
        </a>

        <div class="card-body">

            <div class="mb-6">
                <h5 class="font-weight-normal"><?php echo html_escape($service->name) ?></h5>
            </div>

            <div class="d-flex justify-content-between align-items-center">
                <div class="bg-primary-10 py-1 px-2 rounded-pill text-primary small">
                    <?php if ($service->price == 0): ?>
                        Free
                    <?php else: ?>
                        <?php echo get_currency_by_country($company->country)->currency_symbol; ?> <?php echo html_escape($service->price) ?>
                    <?php endif ?>
                </div>

                <div class="d-flex align-items-center">
                    <?php $staffs = json_decode($service->staffs);?>
                    <?php if (!empty($staffs)): ?>
                    <div class="staffs-list align-items-left pl-3">
                        <?php foreach ($staffs as $staff): ?>
                        <img class="staff-avatar <?php if(count($staffs) < 2){echo "ml-0";} ?>"
                            src="<?php echo base_url(get_by_id($staff, 'staffs')->thumb) ?>"
                            data-toggle="tooltip" data-placement="top"
                            title="<?php echo get_by_id($staff, 'staffs')->name; ?>">
                        <?php endforeach ?>
                    </div>
                    <?php endif ?>
                </div>

            </div>
            <a href="<?php echo base_url('booking/'.$company->slug) ?>" class="btn d-block mt-5 btn-light-secondary"><?php echo trans('book-now') ?></a>
        </div>

    </div>

</div>