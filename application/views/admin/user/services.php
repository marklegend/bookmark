<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <?php $this->load->view('admin/include/breadcrumb'); ?>

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        
        <?php if (isset($page_title) && $page_title != "Edit"): ?>
          <div class="col-md-4 pr-4">
              <div class="card add_area2 <?php if(isset($page_title) && $page_title == "Edit Category"){echo "d-block";}else{echo "hide";} ?>">
                
                <div class="card-header">
                  <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?></h3>
                  <?php else: ?>
                    <h3 class="card-title pt-2"><?php echo trans('create-new-category') ?></h3>
                  <?php endif; ?>

                  <div class="card-tools pull-right">
                    <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                      <?php $required = ''; ?>
                      <a href="<?php echo base_url('admin/services') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                    <?php else: ?>
                      <?php $required = 'required'; ?>
                      <a href="#" class="text-right btn btn-secondary btn-sm cancel_btn2"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                    <?php endif; ?>
                  </div>
                </div>

                <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/services/add_category')?>" role="form" novalidate>

                  <div class="card-body">
                      <div class="form-group">
                          <label><?php echo trans('name') ?></label>
                          <input type="text" class="form-control" name="name" value="<?php if(isset($category[0]['name'])){echo html_escape($category[0]['name']);} ?>" <?php echo html_escape($required); ?>>
                      </div>

                      <div class="form-group">
                          <label><?php echo trans('order') ?></label>
                          <input type="number" placeholder="Ex: 1 2 3" class="form-control" name="orders" value="<?php if(isset($category[0]['orders'])){echo html_escape($category[0]['orders']);} ?>" >
                      </div>

                      <div class="form-group clearfix">
                          <label><?php echo trans('status') ?></label><br>

                          <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                            <input type="radio" id="radioPrimary1" value="1" name="status" <?php if(isset($category[0]['status']) && $category[0]['status'] == 1){echo "checked";} ?>>
                            <label for="radioPrimary1"> <?php echo trans('show') ?>
                            </label>
                          </div>

                          <div class="icheck-primary radio radio-inline d-inline">
                            <input type="radio" id="radioPrimary2" value="2" name="status" <?php if(isset($category[0]['status']) && $category[0]['status'] == 2){echo "checked";} ?>>
                            <label for="radioPrimary2"> <?php echo trans('hide') ?>
                            </label>
                          </div>
                      </div>
                  </div>

                  <div class="card-footer">
                    <input type="hidden" name="id" value="<?php if(isset($category[0]['id'])){echo html_escape($category[0]['id']);} ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                      <button type="submit" class="btn btn-primary pull-left"><?php echo trans('save-changes') ?></button>
                    <?php else: ?>
                      <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save') ?></button>
                    <?php endif; ?>
                  </div>

                </form>
                
              </div>


              <?php if (isset($page_title) && $page_title != "Edit Category"): ?>
                <div class="card list_area2">

                  <div class="card-header">
                    <?php if (isset($page_title) && $page_title == "Edit Category"): ?>
                      <h3 class="card-title pt-2">Edit <a href="<?php echo base_url('admin/services/edit_category') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                    <?php else: ?>
                      <h3 class="card-title pt-2"><?php echo trans('categories') ?></h3>
                    <?php endif; ?>

                    <div class="card-tools pull-right">
                      <a href="#" class="pull-right btn btn-secondary btn-sm add_btn2"><i class="fa fa-plus"></i> <?php echo trans('create-new-category') ?></a>
                    </div>
                  </div>

                  <div class="card-body table-responsive p-0">
                      <table class="table table-hover text-nowrap <?php if(count($categories) > 10){echo "datatable";} ?>">
                          <thead>
                              <tr>
                                  <th>#</th>
                                  <th><?php echo trans('name') ?></th>
                                  <th><?php echo trans('status') ?></th>
                                  <th><?php echo trans('orders') ?></th>
                                  <th class="text-right"><?php echo trans('action') ?></th>
                              </tr>
                          </thead>
                          <tbody>
                            <?php $i=1; foreach ($categories as $row): ?>
                              <tr id="row_<?php echo ($row->id); ?>">
                                  
                                  <td><?= $i; ?></td>
                                  <td><?php echo html_escape($row->name); ?></td>
                                  <td>
                                    <?php if ($row->status == 1): ?>
                                      <span class="badge badge-success"><i class="fas fa-check-circle"></i> <?php echo trans('active') ?></span>
                                    <?php else: ?>
                                      <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> <?php echo trans('hidden') ?></span>
                                    <?php endif ?>
                                  </td> 

                                  <td>
                                      <span class="badge badge-secondary"> <?php echo html_escape($row->orders); ?></span>
                                  </td> 

                                  <td class="actions text-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
                                          <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu" >
                                          <a href="<?php echo base_url('admin/services/edit_category/'.html_escape($row->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                          <a data-val="Category" data-id="<?php echo html_escape($row->id); ?>" href="<?php echo base_url('admin/services/delete_category/'.html_escape($row->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
                                        </div>
                                    </div>
                                  </td>
                              </tr>
                            <?php $i++; endforeach; ?>
                          </tbody>
                      </table>
                  </div>

                </div>
              <?php endif; ?>
          </div>
        <?php endif; ?>

        
        <!-- service area -->
        <?php if (isset($page_title) && $page_title != "Edit Category"): ?>
          <div class="col-md-8 <?php if(strlen(settings()->ind_code) != 40){echo "d-none";} ?>">

            <div class="card add_area <?php if(isset($page_title) && $page_title == "Edit"){echo "d-block";}else{echo "hide";} ?>">
                <div class="card-header with-border">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?></h3>
                  <?php else: ?>
                    <h3 class="card-title pt-2"><?php echo trans('create-new-service') ?> </h3>
                  <?php endif; ?>

                  <div class="card-tools pull-right">
                    <?php if (isset($page_title) && $page_title == "Edit"): ?>
                      <a href="<?php echo base_url('admin/services') ?>" class="pull-right btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>
                    <?php else: ?>
                      <a href="#" class="text-right btn btn-secondary cancel_btn btn-sm"><?php echo trans('services') ?></a>
                    <?php endif; ?>
                  </div>
                </div>


                <form method="post" enctype="multipart/form-data" class="validate-form" action="<?php echo base_url('admin/services/add')?>" role="form" novalidate>
                  <div class="card-body">

                    <div class="form-group">
                      <label><?php echo trans('service-name') ?> <span class="text-danger">*</span></label>
                      <input type="text" class="form-control" required name="name" value="<?php if(isset($service[0]['name'])){echo html_escape($service[0]['name']);} ?>" >
                    </div>

                    <div class="form-group">
                        <label><?php echo trans('service-image') ?> <span class="text-danger">*</span></label>
                        <?php if (isset($page_title) && $page_title == "Edit"): ?>
                            <p><img src="<?php echo base_url($service[0]['thumb']) ?>"> <p>
                        <?php endif ?>
                        <div class="custom-file">
                          <input type="file" class="custom-file-input" name="photo" id="customFileUp">
                          <label class="custom-file-label" for="customFileUp"><?php echo trans('upload-image') ?></label>
                        </div>
                    </div>

                   
                    <div class="form-group">
                      <label><?php echo trans('assign-staffs') ?> </label>
                      <div class="select2-blue">
                        <select name="staffs[]" class="select2 w-100" multiple="multiple" data-placeholder="<?php echo trans('select-staffs') ?>" data-dropdown-css-class="select2-blue" style="width: 100%;">
                          <?php $selected = ''; ?>
                          <?php foreach ($staffs as $staff): ?>

                              <?php if (isset($page_title) && $page_title == 'Edit'): ?>
                                <?php $assign_staffs = json_decode($service[0]['staffs']);?>
                                <?php foreach ($assign_staffs as $asn_staff): ?>
                                  <?php if ($asn_staff == $staff->id): ?>
                                    <?php $selected = 'selected'; break; ?>
                                  <?php else: ?>
                                    <?php $selected = ''; ?>
                                  <?php endif ?>
                                <?php endforeach ?>
                              <?php endif ?>
              
                            <option <?php echo html_escape($selected); ?> value="<?php echo html_escape($staff->id) ?>"><?php echo html_escape($staff->name) ?></option>
                          <?php endforeach ?>
                        </select>
                      </div>
                    </div>

                    <div class="row mt-4 mb-2">

                      <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label" for="example-input-normal"><?php echo trans('category') ?> <span class="text-danger">*</span></label>
                            <select class="form-control" name="category_id">
                                <option value=""><?php echo trans('select') ?></option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?php echo html_escape($category->id); ?>" 
                                      <?php echo (isset($service[0]['category_id']) && $service[0]['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                      <?php echo html_escape($category->name); ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                          </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo trans('price') ?> <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <input type="text" class="form-control" name="price" value="<?php if(isset($service[0]['price'])){echo html_escape($service[0]['price']);} ?>">
                            <div class="input-group-append">
                              <span class="input-group-text"><?php echo html_escape($this->business->currency_symbol) ?></span>
                            </div>
                          </div>
                          <p class="text-muted small pt-2"><i class="fas fa-info-circle"></i> <?php echo trans('set-0-for-free') ?></p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo trans('capacity') ?> <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <input type="number" class="form-control" name="capacity" value="<?php if(isset($service[0]['capacity'])){echo html_escape($service[0]['capacity']);} ?>">
                            <div class="input-group-append">
                              <span class="input-group-text"><?php echo trans('person') ?></span>
                            </div>
                          </div>
                          <p class="text-muted small pt-2"><i class="fas fa-info-circle"></i> <?php echo trans('set-1-for-unlimited') ?></p>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group">
                          <label><?php echo trans('duration') ?> <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <input type="number" class="form-control" name="duration" value="<?php if(isset($service[0]['duration'])){echo html_escape($service[0]['duration']);} ?>">
                            <div class="input-group-append">
                              <span class="input-group-text"><?php echo trans('minutes') ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                      
                      <div class="col-md-6 hide">
                        <div class="form-group">
                          <label><?php echo trans('order') ?></label>
                          <input type="number" placeholder="Ex: 1 2 3" class="form-control" name="orders" value="<?php if(isset($service[0]['orders'])){echo html_escape($service[0]['orders']);} ?>" >
                        </div>
                      </div>

                    </div>

                    <?php if (check_feature_access('zoom-meeting') == TRUE): ?>
                    <div class="form-group">
                      <div class="icheck-success d-inline">
                        <input type="checkbox" id="checkboxPrimary2" name="allow_zoom" class="allow_zoom" value="1" <?php if(!empty($service[0]['zoom_link'])){echo 'checked';} ?>>
                        <label for="checkboxPrimary2"> <?php echo trans('allow-zoom-meeting') ?></span>
                        </label>
                      </div>
                    </div>

                    <div class="form-group link_area d-<?php if(!empty($service[0]['zoom_link'])){echo 'show';}else{echo'hide';} ?>">
                      <label><?php echo trans('zoom-invitation-link') ?></label>
                      <input type="text" placeholder="" class="form-control" name="zoom_link" value="<?php if(isset($service[0]['zoom_link'])){echo html_escape($service[0]['zoom_link']);} ?>" >
                    </div>
                    <?php endif; ?>

                     <div class="form-group">
                        <label><?php echo trans('details') ?></label>
                        <textarea id="summernote" class="form-control" name="details"><?php if(isset($service[0]['details'])){echo html_escape($service[0]['details']);} ?></textarea>
                    </div>

                    

                    <div class="form-group clearfix">
                      <label><?php echo trans('status') ?></label><br>

                      <div class="icheck-primary radio radio-inline d-inline mr-4 mt-2">
                        <input type="radio" id="radioPrimary3" value="1" name="status" <?php if(isset($service[0]['status']) && $service[0]['status'] == 1){echo "checked";} ?> <?php if (isset($page_title) && $page_title != "Edit"){echo "checked";} ?>>
                        <label for="radioPrimary3"> <?php echo trans('show') ?>
                        </label>
                      </div>

                      <div class="icheck-primary radio radio-inline d-inline">
                        <input type="radio" id="radioPrimary4" value="2" name="status" <?php if(isset($service[0]['status']) && $service[0]['status'] == 2){echo "checked";} ?>>
                        <label for="radioPrimary4"> <?php echo trans('hide') ?>
                        </label>
                      </div>
                    </div>

                  </div>

                  <div class="card-footer">
                    <input type="hidden" name="id" value="<?php if(isset($service[0]['id'])){echo html_escape($service[0]['id']);} ?>">
                    <!-- csrf token -->
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">

                    <?php if (isset($page_title) && $page_title == "Edit"): ?>
                      <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save-changes') ?></button>
                      <?php else: ?>
                        <button type="submit" class="btn btn-primary pull-left"> <?php echo trans('save') ?></button>
                      <?php endif; ?>
                    </div>

                </form>

            </div>

            <?php if (isset($page_title) && $page_title != "Edit"): ?>
              <div class="card list_area">
                <div class="card-header with-border">
                  <?php if (isset($page_title) && $page_title == "Edit"): ?>
                    <h3 class="card-title pt-2"><?php echo trans('edit') ?> <a href="<?php echo base_url('admin/services') ?>" class="pull-right btn btn-sm btn-primary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a></h3>
                    <?php else: ?>
                      <h3 class="card-title pt-2"><?php echo trans('services') ?> </h3>
                    <?php endif; ?>

                    <div class="card-tools pull-right">
                      <a href="#" class="pull-right btn btn-sm btn-secondary add_btn"><i class="fa fa-plus"></i> <?php echo trans('create-new-service') ?></a>
                    </div>
                </div>

                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-hover text-nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th><?php echo trans('name') ?></th>
                          <th><?php echo trans('category') ?></th>
                          <th><?php echo trans('staffs') ?></th>
                          <th><?php echo trans('details') ?></th>
                          <th><?php echo trans('price') ?></th>
                          <th><?php echo trans('status') ?></th>
                          <th><?php echo trans('action') ?></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $i=1; foreach ($services as $service): ?>
                        <tr id="row_<?php echo html_escape($service->id); ?>">

                          <td><?= $i; ?></td>
                          <td><?php echo html_escape($service->name); ?></td>
                          <td>
                            <?php if (!empty($service->category_id)): ?>
                              <?php $category = get_by_id($service->category_id, 'service_category')->name; ?>
                              <span class="badge badge-primary"><?php if(isset($category)){echo html_escape($category);} ?></span>
                            <?php else: ?>
                             <span class="text-muted"> <?php echo trans('not-found') ?></span>
                            <?php endif ?>
                          </td>
                          <td>
                              <?php $staffs = json_decode($service->staffs);?>
                              <?php if (!empty($staffs)): ?>
                                <div class="staffs-list">
                                  <?php foreach ($staffs as $staff): ?>
                                    <img class="staff-avatar" src="<?php echo base_url(get_by_id($staff, 'staffs')->thumb) ?>" data-toggle="tooltip" data-placement="top" title="<?php echo get_by_id($staff, 'staffs')->name; ?>">
                                  <?php endforeach ?>  
                                </div>
                              <?php endif ?>
                          </td>
                          <td>
                            <p class="p-0 m-0">
                              <span class="badge badge-light"><i class="far fa-user"></i> <?php if($service->capacity == -1){echo "Unlimited";}else{echo html_escape($service->capacity).' person';} ?> </span>
                            </p>
                            <p class="p-0 m-0">
                              <span class="badge badge-light"><i class="far fa-clock"></i> <?php if($service->duration == -1){echo "Unlimited";}else{echo html_escape($service->duration).' min';} ?></span>
                            </p>
                          </td>

                          <td>
                            <p class="p-0 m-0">
                              <?php if ($service->price == 0): ?>
                                  <?php echo trans('free') ?>
                              <?php else: ?>
                                <?php echo html_escape($this->business->currency_symbol) ?><?php echo html_escape($service->price) ?> 
                              <?php endif ?>
                              
                            </p>
                          </td>

                          <td>
                            <?php if ($service->status == 1): ?>
                              <span class="badge badge-success"><i class="fas fa-check-circle"></i> <?php echo trans('active') ?></span>
                            <?php else: ?>
                              <span class="badge badge-secondary"><i class="fas fa-eye-slash"></i> <?php echo trans('hidden') ?></span>
                            <?php endif ?>
                          </td> 

                          <td class="actions">
                            <div class="btn-group">
                              <button type="button" class="btn btn-tool" data-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-ellipsis-h"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-right" role="menu" >
                                <a href="<?php echo base_url('admin/services/edit/'.html_escape($service->id));?>" class="dropdown-item"><?php echo trans('edit') ?></a>
                                <a data-val="Category" data-id="<?php echo html_escape($service->id); ?>" href="<?php echo base_url('admin/services/delete/'.html_escape($service->id));?>" class="dropdown-item delete_item"><?php echo trans('delete') ?></a>
                              </div>
                            </div>
                          </td>
                        </tr>

                        <?php $i++; endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                </div>

              </div>
            <?php endif; ?>

          </div>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>
