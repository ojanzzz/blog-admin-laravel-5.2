 <!--Category Modal -->
            <!-- Modal -->
              <div id="categoryModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Jenis Makanan</h4>
                    </div>
                    <div class="modal-body">
                        
                        <div id="ajax_response" class="alert hide-ajax bg-success" role="alert"></div>
                        <div id="ajax_error" class="alert hide-ajax bg-danger" role="alert"></div>

                        <div class="panel panel-blue">
                          <div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-clipboard-with-paper"></use></svg>To-do List</div>
                          <div class="panel-body panel-category-list">
                            <ul id="category_list" class="todo-list">
                            
                            <?php foreach($categories as $category): ?>
                              <li class="todo-list-item" id="todo_list<?php echo e($category->id); ?>">
                                <label><?php echo e($category->name); ?></label>
                                <div class="pull-right action-buttons">
                                  <a href="" data-toggle="modal" id="EditCat" data-target="#EditcategoryModal" data-item-id="<?php echo e($category->id); ?>" data-id="<?php echo e($category->name); ?>"><svg class="small-icon glyph stroked pencil"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-pencil"></use></svg></a>
                                  <button class="destroyCat btn-hidden" value="<?php echo e($category->id); ?>"><svg class="small-icon glyph stroked trash"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-trash"></use></svg></button>
                                </div>
                              </li>
                              <?php endforeach; ?>
                              
                            </ul>
                          </div>
                          <div class="panel-footer">
                            <div class="input-group">
                              <!-- addNewCategory -->
                              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                              <input type="hidden" name="id" value="<?php echo e($role->id); ?>">
                              <input type="text" id="name" name="name" placeholder="Tambahkan kategori" class="form-control input-md" required="required">
                              <!-- addNewCategory -->
                              <span class="input-group-btn">
                              <button class="btn btn-primary btn-md" id="addCat">Add</button>
                              </span>
                            </div>
                          </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
            <!--Category Modal -->

            <!--Edit Category Modal -->
            <!-- Modal -->
              <div id="EditcategoryModal" class="modal fade" role="dialog">
                <div class="modal-dialog">

                  <!-- Modal content-->
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Jenis Makanan</h4>
                    </div>
                    <div class="modal-body edit-modal">
                        
                        <div id="ajax_edit" class="alert hide-ajax bg-success" role="alert"></div>
                        <div id="ajax_edit_error" class="alert hide-ajax bg-danger" role="alert"></div>

                        <div class="panel panel-blue edit-modal">
                          <div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#stroked-clipboard-with-paper"></use></svg>To-do List</div>
                          <div class="panel-body panel-category-list">
                            
                          </div>
                          <div class="panel-footer">
                            <div class="input-group">
                              <!-- addNewCategory -->
                              <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" class="edits">
                              <input type="hidden" id="id" name="id" class="edits form-control input-md">
                              <input type="hidden" name="id" value="<?php echo e($role->id); ?>">
                              <input type="text" id="name" name="name" class="edits form-control input-md" required="required">
                              <!-- addNewCategory -->
                              <span class="input-group-btn">
                              <button class="btn btn-primary btn-md" id="EditSave">Save</button>
                              </span>
                            </div>
                          </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>

                </div>
              </div>
            <!--Edit Category Modal -->