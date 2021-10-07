<div class="content-wrapper">
    
    <!-- Content Header (Page header) -->
    <?php $this->load->view('admin/include/breadcrumb'); ?>

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
        
            <?php $this->load->view('admin/user/include/settings_menu.php'); ?>

            <div class="col-lg-9 pl-3">
                <div class="card">
                    <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_company') ?>" role="form" class="form-horizontal pl-20">
                        <div class="card-body">
                             
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mih-100">
                                            <?php if (!empty($company->logo)):?>
                                                <img class="m-auto" width="100px" src="<?php echo base_url($company->logo); ?>">
                                            <?php else: ?>
                                               <p class="m-auto text-muted"><?php echo trans('upload-company-logo') ?></p>
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="photo1" id="customFile">
                                                <label class="custom-file-label" for="customFile"><?php echo trans('upload-logo') ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="mih-100">
                                            <?php if (!empty($company->image)):?>
                                                <img class="m-auto" width="100px" src="<?php echo base_url($company->thumb); ?>">
                                            <?php else: ?>
                                                <img class="m-auto" width="100px" src="<?php echo base_url('assets/front/img/vericla-cover.jpg'); ?>">
                                            <?php endif; ?>
                                        </div>

                                        <div class="form-group">
                                            <div class="custom-file">
                                            <input type="file" name="photo" class="custom-file-input" id="customFiles">
                                            <label class="custom-file-label" for="customFiles"><?php echo trans('banner-image') ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo trans('company-name') ?></label>
                                        <input type="text" name="name" value="<?php echo html_escape($company->name); ?>" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo trans('company-title') ?></label>
                                        <input type="text" name="title" value="<?php echo html_escape($company->title); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo trans('email') ?></label>
                                        <input type="text" name="email" value="<?php echo html_escape($company->email); ?>" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label><?php echo trans('phone') ?></label>
                                        <input type="text" name="phone" value="<?php echo html_escape($company->phone); ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label><?php echo trans('currency') ?></label>
                                <select class="form-control" name="country">
                                    <option value=""><?php echo trans('select') ?></option>
                                    <?php foreach ($currencies as $currency): ?>
                                        <?php if (!empty($currency->currency_name)): ?>
                                          <option value="<?php echo html_escape($currency->id); ?>" 
                                            <?php echo ($this->business->country == $currency->id) ? 'selected' : ''; ?>>
                                            <?php echo html_escape($currency->name.'  -  '.$currency->currency_code.' ('.$currency->currency_symbol.')'); ?>
                                          </option>
                                        <?php endif ?>
                                    <?php endforeach ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label><?php echo trans('details') ?></label>
                                <textarea class="form-control" name="details" rows="4"><?php echo html_escape($company->details); ?></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label><?php echo trans('address') ?></label>
                                <textarea class="form-control" name="address" rows="2"><?php echo html_escape($company->address); ?></textarea>
                            </div>

                            <div class="form-group mb-4">
                                <label><?php echo trans('date-format') ?></label>
                                <select class="form-control" name="date_format">
                                    <option value=""><?php echo trans('select') ?></option>
                                    <option <?php echo ($this->business->date_format == 'd-m-Y') ? 'selected' : ''; ?> value="d-m-Y"><?php echo date('d-m-Y') ?> (d-m-Y)</option>
                                    <option <?php echo ($this->business->date_format == 'Y-m-d') ? 'selected' : ''; ?> value="Y-m-d"><?php echo date('Y-m-d') ?> (Y-m-d)</option>
                                    <option <?php echo ($this->business->date_format == 'd/m/Y') ? 'selected' : ''; ?> value="d/m/Y"><?php echo date('d/m/Y') ?> (d/m/Y)</option>
                                    <option <?php echo ($this->business->date_format == 'Y/m/d') ? 'selected' : ''; ?> value="Y/m/d"><?php echo date('Y/m/d') ?> (Y/m/d)</option>
                                    <option <?php echo ($this->business->date_format == 'd.m.Y') ? 'selected' : ''; ?> value="d.m.Y"><?php echo date('d.m.Y') ?> (d.m.Y)</option>
                                    <option <?php echo ($this->business->date_format == 'Y.m.d') ? 'selected' : ''; ?> value="Y.m.d"><?php echo date('Y.m.d') ?> (Y.m.d)</option>
                                    <option <?php echo ($this->business->date_format == 'd M Y') ? 'selected' : ''; ?> value="d M Y"><?php echo date('d M Y') ?> (d M Y)</option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                                <label><?php echo trans('time-format') ?></label>
                                <select class="form-control" name="time_format">
                                    <option value=""><?php echo trans('select') ?></option>
                                    <option <?php echo ($this->business->time_format == 'hh') ? 'selected' : ''; ?> value="hh"> 12 <?php echo trans('hours') ?></option>
                                    <option <?php echo ($this->business->time_format == 'HH') ? 'selected' : ''; ?> value="HH">24 <?php echo trans('hours') ?></option>
                                </select>
                            </div>

                            <div class="form-group mb-4">
                              <label><?php echo trans('time-interval') ?> </label>
                              <div class="input-group">
                                <input type="number" class="form-control" name="time_interval" value="<?php echo $company->time_interval ?>">
                                <div class="input-group-append">
                                  <span class="input-group-text"><?php echo trans('minutes') ?></span>
                                </div>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" id="checkboxPrimary1" name="enable_staff" value="1" <?php if($company->enable_staff == 1){echo "checked";}; ?>>
                                <label for="checkboxPrimary1"> <span class="smalls"><?php echo trans('enable-staff') ?> </span>
                                    <p><small><?php echo trans('enable-staff-title') ?></small></p>
                                </label>
                              </div>
                            </div>

                            <div class="form-group">
                              <div class="icheck-success d-inline">
                                <input type="checkbox" id="checkboxPrimary2" name="enable_gallery" value="1" <?php if($company->enable_gallery == 1){echo "checked";}; ?>>
                                <label for="checkboxPrimary2"> <span class="smalls"><?php echo trans('enable-gallery') ?> </span>
                                    <p><small><?php echo trans('enable-gallery-title') ?></small></p>
                                </label>
                              </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <input type="hidden" name="id" value="<?php echo html_escape($company->id); ?>">
                            <!-- csrf token -->
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                            <button type="submit" class="btn btn-primary mt-2"><?php echo trans('save-changes') ?></button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
