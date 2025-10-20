<?php include("header.php");  ?>
<div class="content">
    <!-- Image loader -->
<div id="loader"></div>
<!-- Image loader -->
    <div class="container-fluid">
  <!-- start page title -->
  <div class="row">
      <div class="col-12">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
              <h4 class="mb-sm-0 font-size-18">File Manager</h4>

              <!-- <div class="page-title-right">
                  <ol class="breadcrumb m-0">
                      <li class="breadcrumb-item"><a href="javascript: void(0);">Apps</a></li>
                      <li class="breadcrumb-item active">File Manager</li>
                  </ol>
              </div> -->

          </div>
      </div>
  </div>
  <!-- end page title -->

  <div class="d-xl-flex">
      <div class="w-100">
          <div class="d-md-flex">
              <!-- filemanager-leftsidebar -->
              <div class="card filemanager-sidebar flex-column mr-md-2 mb-4">
                  <div class="card-body">

                      <div class="d-flex flex-column h-100">
                          <div class="mb-4">
                            
                              <ul class="list-unstyled categories-list">
                                  <li>
                                      <div class="custom-accordion">
                                          <a class="text-body fw-medium py-1 d-flex align-items-center" data-toggle="collapse" href="#categories-collapse" role="button" aria-expanded="false" aria-controls="categories-collapse">
                                              <i class="fa fa-folder font-size-16 text-warning mr-2"></i> My Documents <i class="fa fa-chevron-up accor-down-icon ml-auto"></i>
                                          </a>
                                          <div class="collapse show" id="categories-collapse">
                                              <div class="card border-0 shadow-none pl-2 mb-0 category_refresh">
                                                  <ul class="list-unstyled mb-0">
                                                    <?php
                                                      $path = '../Documents/';

                                                      $files_fetch = scandir($path);
                                                      $files_fetch = array_diff(scandir($path), array('.', '..'));

                                                      foreach ($files_fetch as $key => $value)
                                                      {      
                                                        $folder = $path.$value;
                                                        
                                                        if(is_dir($folder))
                                                        {
                                                    ?>
                                                      <li>
                                                          <a href="javascript: void(0);" id="<?php echo $folder; ?>/" onclick="FetchFolder(this.id, event);" class="text-dark d-flex align-items-center">
                                                              <i class="fa fa-folder text-warning font-size-16 mr-2"></i> <span class="mr-auto"><?php echo $value; ?></span>
                                                          </a>
                                                      </li>
                                                    <?php
                                                        }
                                                        elseif(is_file($folder))
                                                        {
                                                          if(pathinfo($folder, PATHINFO_EXTENSION) == 'jpg' ||
                                                            pathinfo($folder, PATHINFO_EXTENSION) == 'jpeg' ||
                                                            pathinfo($folder, PATHINFO_EXTENSION) == 'png')
                                                          {
                                                    ?>
                                                      <li>
                                                          <a href="<?php echo $folder; ?>" target="_blank" class="text-dark d-flex align-items-center">
                                                              <i class="fa fa-image text-info font-size-16 mr-2"></i> <span class="mr-auto"><?php echo $value; ?></span>
                                                          </a>
                                                      </li>
                                                    <?php
                                                          }
                                                          elseif (pathinfo($folder, PATHINFO_EXTENSION) == 'pdf')
                                                          {
                                                    ?>
                                                      <li>
                                                          <a href="<?php echo $folder; ?>" target="_blank" class="text-dark d-flex align-items-center">
                                                              <i class="fa fa-file-archive-o text-danger font-size-16 mr-2"></i> <span class="mr-auto"><?php echo $value; ?></span>
                                                          </a>
                                                      </li>
                                                    <?php
                                                          }
                                                          elseif(pathinfo($folder, PATHINFO_EXTENSION) == 'doc' ||
                                                            pathinfo($folder, PATHINFO_EXTENSION) == 'docx')
                                                          {
                                                    ?>
                                                      <li>
                                                          <a href="<?php echo $folder; ?>" target="_blank" class="text-dark d-flex align-items-center">
                                                              <i class="fa fa-file-word-o text-primary font-size-16 mr-2"></i> <span class="mr-auto"><?php echo $value; ?></span>
                                                          </a>
                                                      </li>
                                                    <?php
                                                          }
                                                          elseif(pathinfo($folder, PATHINFO_EXTENSION) == 'xls' ||
                                                            pathinfo($folder, PATHINFO_EXTENSION) == 'xlsx')
                                                          {
                                                    ?>
                                                      <li>
                                                          <a href="<?php echo $folder; ?>" target="_blank" class="text-dark d-flex align-items-center">
                                                              <i class="fa fa-file-excel-o text-success font-size-16 mr-2"></i> <span class="mr-auto"><?php echo $value; ?></span>
                                                          </a>
                                                      </li>
                                                    <?php
                                                          }
                                                          elseif(pathinfo($folder, PATHINFO_EXTENSION) == 'txt')
                                                          {
                                                    ?>
                                                      <li>
                                                          <a href="<?php echo $folder; ?>" target="_blank" class="text-dark d-flex align-items-center">
                                                              <i class="fa fa-file-text-o font-size-16 mr-2"></i> <span class="mr-auto"><?php echo $value; ?></span>
                                                          </a>
                                                      </li>
                                                    <?php
                                                          }
                                                        }
                                                        

                                                      }
                                                    ?>
                                                  </ul>
                                              </div>
                                          </div>
                                      </div>
                                  </li>
                                  <!--<li>-->
                                  <!--    <a href="javascript: void(0);" onclick="ShareLoad(event);" class="text-body d-flex align-items-center">-->
                                  <!--        <i class="fa fa-share-alt font-size-16 mr-2"></i> <span class="mr-auto">Shared</span>-->
                                  <!--    </a>-->
                                  <!--</li>-->
                              </ul>
                          </div>

                      </div>

                  </div>
              </div>
              <!-- filemanager-leftsidebar -->

              <?php

              function OnlyFolders_old($dir)
              {
                $directories = array_filter(glob($dir.'/*'), 'is_dir');
                echo "<option value='".$dir."'>";
                echo $dir;
                echo "</option>";
                foreach ($directories as $key => $value)
                {
                  $subdirectories[] = array_filter(glob($value.'/*'), 'is_dir');
                  // echo $value."<br>";
                }
                
                foreach ($directories as $key1 => $value1)
                {
                  foreach ($subdirectories as $key2 => $value2)
                  {
                    if ($key1 == $key2)
                    {
                      echo "<option value='".$value1."'>";
                      echo $value1;
                      echo "</option>";
                      foreach ($value2 as $key3 => $value3)
                      {
                        // echo "<option value='".$value3."'>";
                        // echo $value3;
                        // echo "</option>";
                        
                        OnlyFolders($value3);
                      }
                    }
                  }
                }                
              }

              // echo "<select class='form-control'>";
              // OnlyFolders_old('Documents');
              // echo "</select>";
              ?>

              <div class="card flex-column w-100 mb-4">
                  <div class="card-body">
                      <div>
                          <div class="row mb-3">
                              <div class="col-xl-2 col-6">
                                <div class="dropdown">
                                  <button class="btn btn-outline-primary w-100" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-plus mr-1"></i> New
                                  </button>
                                  <div class="dropdown-menu">
                                    <a class="dropdown-item px-3" href="#" data-toggle="modal" data-target="#createFolder"><i class="fa fa-folder mr-1 text-warning"></i> New Folder</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item px-3" href="#" data-toggle="modal" data-target="#uploadFiles"><i class="fa fa-arrow-up mr-1"></i> Upload Files</a>
                                  </div>
                                </div>                                
                              </div>
                              <div class="col-xl-2 col-6">
                                <button class="btn btn-outline-dark w-100" type="button" onclick="refresh($('.fetch_folder').attr('href'), event);">
                                  <i class="fa fa-refresh mr-1"></i> Refresh
                                </button>
                              </div>
                              <!--<div class="col-xl-8 col-12">-->
                              <!--    <form class="mt-4 mt-sm-0 float-sm-right d-flex align-items-center">-->
                              <!--        <div class="search-box mb-2 mr-2">-->
                              <!--            <div class="position-relative">-->
                              <!--                <input type="text" class="form-control bg-light border-light rounded" placeholder="Search...">-->
                              <!--                <i class="fa fa-search search-icon" aria-hidden="true"></i>-->
                              <!--            </div>-->
                              <!--        </div>-->

                              <!--        <div class="dropdown dropright mb-0">-->
                              <!--            <a class="btn btn-link text-muted mt-n2" role="button" data-toggle="dropdown" aria-haspopup="true">-->
                              <!--                <i class="fa fa-ellipsis-v font-size-20"></i>-->
                              <!--            </a>-->
                                        
                              <!--            <div class="dropdown-menu">-->
                              <!--                <a class="dropdown-item" href="#">Share Files</a>-->
                              <!--                <a class="dropdown-item" href="#">Share with me</a>-->
                              <!--                <a class="dropdown-item" href="#">Other Actions</a>-->
                              <!--            </div>-->
                              <!--        </div>-->
                                      
                                      
                              <!--    </form>-->
                              <!--</div>-->
                          </div>
                      </div>

                      <div>
                          <div class="row get_directory_contents" id="get_directory_contents">
                          </div>
                          <!-- end row -->
                      </div>

                  </div>
              </div>
              <!-- end card -->

          </div>
      </div>

  </div>
  <!-- end row -->
  </div>
</div>
<?php include("footer.php"); ?>
<script>
    $(document).ready(function()
    {
      // Initialize select2
    //   $(".selUser").select2();
        $(".sidebar .nav .drive").addClass("active");
    });
</script>