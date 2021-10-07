<div class="col-lg-3">
	<div class="card">
		<div class="card-body">
			<ul class="nav nav-pills flex-column" id="myTab" role="tablist">
				<li class="nav-item">
					<a class="nav-link <?php if(isset($page_title) && $page_title == "System Settings"){echo "active";} ?>" href="<?php echo base_url('admin/settings/company') ?>"><i class="lni lni-home mr-1"></i> <?php echo trans('company-settings') ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if(isset($page_title) && $page_title == "Working Hours"){echo "active";} ?>" href="<?php echo base_url('admin/settings/working_hours') ?>"><i class="far fa-clock mr-1"></i> <?php echo trans('working-hours') ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link <?php if(isset($page_title) && $page_title == "SMS Settings"){echo "active";} ?>" href="<?php echo base_url('admin/settings/sms') ?>"><i class="far fa-comment-dots mr-1"></i> Twillo <?php echo trans('sms-settings') ?></a>
				</li>

				<?php if(get_user_info() == TRUE){$uval = 'd-show';}else{$uval = 'd-hide';} ?>
				<?php if (check_feature_access('get-online-payments') == TRUE): ?>
					<li class="nav-item <?= $uval; ?>">
						<a class="nav-link <?php if(isset($page_title) && $page_title == "Payment Settings"){echo "active";} ?>" href="<?php echo base_url('admin/payment/user') ?>"><i class="lni lni-coin mr-1"></i> <?php echo trans('payment-settings') ?></a>
					</li>
				<?php endif; ?>

				<li class="nav-item d-hide">
					<a class="nav-link <?php if(isset($page_title) && $page_title == "Embedded Settings"){echo "active";} ?>" href="<?php echo base_url('admin/settings/embedded_code') ?>"><i class="fas fa-laptop-code mr-1"></i> <?php echo trans('embedded-code') ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link <?php if(isset($page_title) && $page_title == "QR Settings"){echo "active";} ?>" href="<?php echo base_url('admin/settings/qr_code') ?>"><i class="fas fa-qrcode ml-1 mr-1"></i> <?php echo trans('qr-code') ?></a>
				</li>

				<li class="nav-item">
					<a class="nav-link <?php if(isset($page_title) && $page_title == "Profile"){echo "active";} ?>" href="<?php echo base_url('admin/settings/profile') ?>"><i class="lnib lni-user mr-1"></i> <?php echo trans('manage-profile') ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if(isset($page_title) && $page_title == "Change Password"){echo "active";} ?>" href="<?php echo base_url('admin/settings/change_password') ?>"><i class="lnib lni-lock mr-1"></i> <?php echo trans('change-password') ?></a>
				</li>
			</ul>
		</div>
	</div>
</div>