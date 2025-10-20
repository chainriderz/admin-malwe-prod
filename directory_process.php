<?php 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

function OnlyFolders($dir2, $curr)
  {
    $directories = array_filter(glob($dir2.'/*'), 'is_dir');
    echo "<option value='".$dir2."/".$curr."'>";
    echo $dir2;
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
          echo "<option value='".$value1."/".$curr."'>";
          echo $value1;
          echo "</option>";
          foreach ($value2 as $key3 => $value3)
          {                                                        
            OnlyFolders($value3, $curr);
          }
        }
      }
    }                
  }

function listFolder($drty, $curr_file)
  {                  
    $ffs = scandir($drty);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // prevent empty ordered elements
    if (count($ffs) < 1)
    {
      return;
    }

    foreach($ffs as $ff)
    {
      $folder_load = $drty."/".$ff;
      if(is_dir($folder_load))
      {
        echo "<option value='".$folder_load."/".$curr_file."'>".$folder_load."</option>";
        listFolder($folder_load, $curr_file);
      }
    }
  }
  
function getDirectory($path)
{
  // Old Code
  $dirs = array();
  // directory handle
  $dir = $path;
  if ($dh = opendir($dir))
  {
    while (false !== ($entry = readdir($dh)))
    {
        if ($entry != '.' && $entry != '..')
        {
           // if (is_dir($path . '/' .$entry))
           // {
              $dirs[] = $entry;
           // }
        }
    }
  }
  // Old Code End

  $files_fetch = scandir($path);
  $files_fetch = array_diff(scandir($path), array('.', '..'));
  
//   print_r($path);

  echo 
  '
    <div class="modal fade" id="createFolder">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Create New Folder</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <input type="hidden" class="form-control" id="source" value="'.$dir.'">
            <div class="input-group mb-3">
              <input type="text" class="form-control" id="folder" value="New Folder">
              <div class="input-group-append">
                <button type="button" onclick="createFolder( $('."'#source'".').val(), $('."'#folder'".').val(), event );" class="btn btn-success">Create Folder</button>
              </div>
            </div>
          </div>
          
        </div>
      </div>
    </div>
  ';

  echo 
  '
    <div class="modal fade" id="uploadFiles">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        
          <!-- Modal Header -->
          <div class="modal-header">
            <h4 class="modal-title">Upload Files</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          
          <!-- Modal body -->
          <div class="modal-body">
            <form method="POST" enctype="multipart/form-data" class="uploadFiles">
              <input type="hidden" class="form-control" id="source" name="source" value="'.$dir.'">
              <div class="input-group mb-3">
                <input type="file" class="form-control" id="file" name="file[]" multiple accept=".jpg, .jpeg, .png, .pdf, .doc, .docx, .xls, .xlsx, .txt" required>
                <div class="input-group-append">
                  <input type="submit" class="btn btn-success submit_upload" value="Upload File">
                </div>
              </div>
              <p class="text-danger">.PNG, .JPEG, .JPG, .PDF, .DOC, .DOCX, .XLS, .XLSX, .TXT</p>
            </form>
          </div>
          
        </div>
      </div>
    </div>
  ';

  echo '
        <div class="table-responsive mb-0">
              <table id="filemanager" class="table align-middle table-nowrap table-hover mb-0">
                  <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Date modified</th>
                        <th scope="col">Type</th>
                        <th scope="col" colspan="">Size</th>
                        <th></th>
                      </tr>
                    </thead>
                  <tbody>
        ';

  // print_r($dirs);
  foreach ($files_fetch as $key => $value)
  {
    $folder = $path.$value;
    
    if(is_dir($folder))
    {
      // echo date("Y-m-d h:i:s A", filemtime($folder));

      echo '            
          <tr>
              <td>
                <a href="javascript: void(0);" id="'.$folder.'/" onclick="FetchFolder(this.id, event);" class="text-dark fw-medium">
                <i class="fa fa-folder font-size-16 align-middle text-warning mr-2"></i> 
                '.$value.'
                </a>
              </td>
              <td>'.date("Y-m-d", filemtime($folder)).'</td>
              <td>File Folder</td>
              <td></td>
              <td>
                  <div class="dropdown">
                      <a class="font-size-16 text-muted" role="button" data-toggle="dropdown" aria-haspopup="true">
                          <i class="fa fa-ellipsis-h"></i>
                      </a>
                      
                      <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="#" id="'.$folder.'/" onclick="FetchFolder(this.id, event);">Open</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Copy</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Move</a>
                          <a class="dropdown-item rename_folder" href="#" data-toggle="modal" data-target="#RenameFOLDER_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Rename</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" id="'.$folder.'" onclick="remove(this.id, '."'folder'".', event);">Remove</a>
                      </div>

                      <div class="modal fade copyModal" id="copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Copy Folder</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="source_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_copy" value="Copy"
                                  onclick="CopyFunction($('."'#source_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade moveModal" id="moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Move Folder</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="msource_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_move" value="Move"
                                  onclick="MoveFunction($('."'#msource_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade rename_folder_modal" id="RenameFOLDER_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Rename Folder "'.$value.'"</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="text" class="form-control d-inline-block w-75" id="rename_folder_value_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.pathinfo($folder, PATHINFO_FILENAME).'" />
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" id="'.pathinfo($folder, PATHINFO_FILENAME).'" folder="'.$path.'"
                              onclick="RenameFOLDER($('."'#rename_folder_value_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), this.id, $(this).attr('."'folder'".'));">Rename</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                  </div>
              </td>
          </tr>                       
      ';
    }
    else if(is_file($folder))
    {
      // echo $path.$value;
      $filesize = filesize($folder);
      // echo date("Y-m-d h:i:s A", filemtime($folder));
      if(pathinfo($folder, PATHINFO_EXTENSION) == 'jpg' ||
        pathinfo($folder, PATHINFO_EXTENSION) == 'jpeg' ||
        pathinfo($folder, PATHINFO_EXTENSION) == 'png')
      {
        echo '            
          <tr>
              <td>
                <a href="'.$folder.'" target="_blank" class="text-dark fw-medium">
                <i class="fa fa-image font-size-16 align-middle text-info mr-2"></i> 
                '.$value.'
                </a>
              </td>
              <td>'.date("Y-m-d", filemtime($folder)).'</td>
              <td>Image File</td>
              <td>'.formatSizeUnits($filesize).'</td>
              <td>
                  <div class="dropdown">
                      <a class="font-size-16 text-muted" role="button" data-toggle="dropdown" aria-haspopup="true">
                          <i class="fa fa-ellipsis-h"></i>
                      </a>
                      
                      <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="'.$folder.'" target="_blank">Open</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Copy</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Move</a>
                          <a class="dropdown-item" href="'.$folder.'" download>Download</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Share</a>
                          <a class="dropdown-item rename_img" href="#" data-toggle="modal" data-target="#RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Rename</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" id="'.$folder.'" onclick="remove(this.id, '."'file'".', event);">Remove</a>
                      </div>

                      <div class="modal fade copyModal" id="copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Copy File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="source_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_copy" value="Copy"
                                  onclick="CopyFunction($('."'#source_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade moveModal" id="moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Move File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="msource_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_move" value="Move"
                                  onclick="MoveFunction($('."'#msource_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>
                      
                      <div class="modal fade shareModal" id="shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Share File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" name="filename" id="filename_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="http://malwe.online/'.str_replace('../', '', $folder).'" required>
                              <div class="input-group mb-3">
                                <input type="email" name="email" id="email_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" class="form-control" placeholder="Enter Email" required>
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-success submit_share"
                                  onclick="ShareFunction($('."'#email_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#filename_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                    <i class="fa fa-envelope-o mr-1" aria-hidden="true"></i>
                                    Share
                                  </button>
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade rename_img_modal" id="RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Rename File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="text" class="form-control d-inline-block w-75" id="rename_img_file_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.pathinfo($folder, PATHINFO_FILENAME).'" />.'.pathinfo($folder, PATHINFO_EXTENSION).'
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" id="'.pathinfo($folder, PATHINFO_FILENAME).'.'.pathinfo($folder, PATHINFO_EXTENSION).'" folder="'.$path.'" extension=".'.pathinfo($folder, PATHINFO_EXTENSION).'"
                              onclick="RenameIMG($('."'#rename_img_file_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), this.id, $(this).attr('."'folder'".'), $(this).attr('."'extension'".'));">Rename</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                  </div>
              </td>
          </tr>                       
        ';
      }
      elseif (pathinfo($folder, PATHINFO_EXTENSION) == 'pdf')
      {
        echo '            
                    <tr>
                        <td>
                        <a href="'.$folder.'" target="_blank" class="text-dark fw-medium">
                          <i class="fa fa-file-archive-o font-size-16 align-middle text-danger mr-2"></i> 
                          '.$value.'
                          </a>
                        </td>
                        <td>'.date("Y-m-d", filemtime($folder)).'</td>
                        <td>PDF File</td>
                        <td>'.formatSizeUnits($filesize).'</td>
                        <td>
                            <div class="dropdown">
                                <a class="font-size-16 text-muted" role="button" data-toggle="dropdown" aria-haspopup="true">
                                    <i class="fa fa-ellipsis-h"></i>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="'.$folder.'" target="_blank">Open</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Copy</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Move</a>
                                    <a class="dropdown-item" href="'.$folder.'" download>Download</a>
                                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Share</a>
                                    <a class="dropdown-item rename_pdf" href="#" data-toggle="modal" data-target="#RenamePDF_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Rename</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#" id="'.$folder.'" onclick="remove(this.id, '."'file'".', event);">Remove</a>
                                </div>

                                <div class="modal fade copyModal" id="copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Copy File</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                        <input type="hidden" class="form-control" name="source" id="source_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                                        <label>Select Path</label>
                                        <div class="input-group mb-3">
                                          ';                                              
                                            echo "<select class='form-control' id='destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                            echo "<option value='../Documents/".$value."'>Documents</option>";
                                  			listFolder('../Documents', $value);
                                            echo "</select>";
                                          echo '
                                          <div class="input-group-append">
                                            <input type="button" class="btn btn-success submit_copy" value="Copy"
                                            onclick="CopyFunction($('."'#source_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                          </div>
                                        </div>

                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
  
                                <div class="modal fade moveModal" id="moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Move File</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                        <input type="hidden" class="form-control" name="source" id="msource_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                                        <label>Select Path</label>
                                        <div class="input-group mb-3">
                                          ';                                              
                                            echo "<select class='form-control' id='mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                            echo "<option value='../Documents/".$value."'>Documents</option>";
                                  		    listFolder('../Documents', $value);
                                            echo "</select>";
                                          echo '
                                          <div class="input-group-append">
                                            <input type="button" class="btn btn-success submit_move" value="Move"
                                            onclick="MoveFunction($('."'#msource_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                          </div>
                                        </div>

                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                                
                                <div class="modal fade shareModal" id="shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Share File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" name="filename" id="filename_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="http://malwe.online/'.str_replace('../', '', $folder).'" required>
                              <div class="input-group mb-3">
                                <input type="email" name="email" id="email_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" class="form-control" placeholder="Enter Email" required>
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-success submit_share"
                                  onclick="ShareFunction($('."'#email_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#filename_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                    <i class="fa fa-envelope-o mr-1" aria-hidden="true"></i>
                                    Share
                                  </button>
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                                <div class="modal fade rename_pdf_modal" id="RenamePDF_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                                  <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                    
                                      <!-- Modal Header -->
                                      <div class="modal-header">
                                        <h4 class="modal-title">Rename File</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                      </div>
                                      
                                      <!-- Modal body -->
                                      <div class="modal-body">
                                        <input type="text" class="form-control d-inline-block w-75" id="rename_pdf_file_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.pathinfo($folder, PATHINFO_FILENAME).'" />.pdf
                                      </div>
                                      
                                      <!-- Modal footer -->
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" id="'.pathinfo($folder, PATHINFO_FILENAME).'" folder="'.$path.'"
                                        onclick="RenamePDF($('."'#rename_pdf_file_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), this.id, $(this).attr('."'folder'".'));">Rename</button>
                                      </div>
                                      
                                    </div>
                                  </div>
                                </div>
                            </div>
                        </td>
                    </tr>
            ';
      }
      elseif(pathinfo($folder, PATHINFO_EXTENSION) == 'doc' ||
        pathinfo($folder, PATHINFO_EXTENSION) == 'docx')
      {
        echo '            
          <tr>
              <td>
                <a href="'.$folder.'" target="_blank" class="text-dark fw-medium">
                <i class="fa fa-file-word-o font-size-16 align-middle text-primary mr-2"></i> 
                '.$value.'
                </a>
              </td>
              <td>'.date("Y-m-d", filemtime($folder)).'</td>
              <td>Word File</td>
              <td>'.formatSizeUnits($filesize).'</td>
              <td>
                  <div class="dropdown">
                      <a class="font-size-16 text-muted" role="button" data-toggle="dropdown" aria-haspopup="true">
                          <i class="fa fa-ellipsis-h"></i>
                      </a>
                      
                      <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="'.$folder.'" target="_blank">Open</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Copy</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Move</a>
                          <a class="dropdown-item" href="'.$folder.'" download>Download</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Share</a>
                          <a class="dropdown-item rename_img" href="#" data-toggle="modal" data-target="#RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Rename</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" id="'.$folder.'" onclick="remove(this.id, '."'file'".', event);">Remove</a>
                      </div>

                      <div class="modal fade copyModal" id="copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Copy File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="source_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_copy" value="Copy"
                                  onclick="CopyFunction($('."'#source_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade moveModal" id="moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Move File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="msource_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_move" value="Move"
                                  onclick="MoveFunction($('."'#msource_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>
                      
                      <div class="modal fade shareModal" id="shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Share File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              
                              <input type="hidden" name="filename" id="filename_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="http://malwe.online/'.str_replace('../', '', $folder).'" required>
                              <div class="input-group mb-3">
                                <input type="email" name="email" id="email_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" class="form-control" placeholder="Enter Email" required>
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-success submit_share"
                                  onclick="ShareFunction($('."'#email_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#filename_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                    <i class="fa fa-envelope-o mr-1" aria-hidden="true"></i>
                                    Share
                                  </button>
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade rename_img_modal" id="RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Rename File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="text" class="form-control d-inline-block w-75" id="rename_img_file_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.pathinfo($folder, PATHINFO_FILENAME).'" />.'.pathinfo($folder, PATHINFO_EXTENSION).'
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" id="'.pathinfo($folder, PATHINFO_FILENAME).'.'.pathinfo($folder, PATHINFO_EXTENSION).'" folder="'.$path.'" extension=".'.pathinfo($folder, PATHINFO_EXTENSION).'"
                              onclick="RenameIMG($('."'#rename_img_file_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), this.id, $(this).attr('."'folder'".'), $(this).attr('."'extension'".'));">Rename</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                  </div>
              </td>
          </tr>                       
        ';
      }
      elseif(pathinfo($folder, PATHINFO_EXTENSION) == 'xls' ||
        pathinfo($folder, PATHINFO_EXTENSION) == 'xlsx')
      {
        echo '            
          <tr>
              <td>
                <a href="'.$folder.'" target="_blank" class="text-dark fw-medium">
                <i class="fa fa-file-excel-o font-size-16 align-middle text-success mr-2"></i> 
                '.$value.'
                </a>
              </td>
              <td>'.date("Y-m-d", filemtime($folder)).'</td>
              <td>Excel File</td>
              <td>'.formatSizeUnits($filesize).'</td>
              <td>
                  <div class="dropdown">
                      <a class="font-size-16 text-muted" role="button" data-toggle="dropdown" aria-haspopup="true">
                          <i class="fa fa-ellipsis-h"></i>
                      </a>
                      
                      <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="'.$folder.'" target="_blank">Open</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Copy</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Move</a>
                          <a class="dropdown-item" href="'.$folder.'" download>Download</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Share</a>
                          <a class="dropdown-item rename_img" href="#" data-toggle="modal" data-target="#RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Rename</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" id="'.$folder.'" onclick="remove(this.id, '."'file'".', event);">Remove</a>
                      </div>

                      <div class="modal fade copyModal" id="copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Copy File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="source_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_copy" value="Copy"
                                  onclick="CopyFunction($('."'#source_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade moveModal" id="moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Move File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="msource_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_move" value="Move"
                                  onclick="MoveFunction($('."'#msource_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>
                      
                      <div class="modal fade shareModal" id="shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Share File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              
                              <input type="hidden" name="filename" id="filename_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="http://malwe.online/'.str_replace('../', '', $folder).'" required>
                              <div class="input-group mb-3">
                                <input type="email" name="email" id="email_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" class="form-control" placeholder="Enter Email" required>
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-success submit_share"
                                  onclick="ShareFunction($('."'#email_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#filename_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                    <i class="fa fa-envelope-o mr-1" aria-hidden="true"></i>
                                    Share
                                  </button>
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade rename_img_modal" id="RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Rename File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="text" class="form-control d-inline-block w-75" id="rename_img_file_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.pathinfo($folder, PATHINFO_FILENAME).'" />.'.pathinfo($folder, PATHINFO_EXTENSION).'
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" id="'.pathinfo($folder, PATHINFO_FILENAME).'.'.pathinfo($folder, PATHINFO_EXTENSION).'" folder="'.$path.'" extension=".'.pathinfo($folder, PATHINFO_EXTENSION).'"
                              onclick="RenameIMG($('."'#rename_img_file_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), this.id, $(this).attr('."'folder'".'), $(this).attr('."'extension'".'));">Rename</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                  </div>
              </td>
          </tr>                       
        ';
      }
      elseif(pathinfo($folder, PATHINFO_EXTENSION) == 'txt')
      {
        echo '            
          <tr>
              <td>
                <a href="'.$folder.'" target="_blank" class="text-dark fw-medium">
                <i class="fa fa-file-text-o font-size-16 align-middle mr-2"></i> 
                '.$value.'
                </a>
              </td>
              <td>'.date("Y-m-d", filemtime($folder)).'</td>
              <td>Text File</td>
              <td>'.formatSizeUnits($filesize).'</td>
              <td>
                  <div class="dropdown">
                      <a class="font-size-16 text-muted" role="button" data-toggle="dropdown" aria-haspopup="true">
                          <i class="fa fa-ellipsis-h"></i>
                      </a>
                      
                      <div class="dropdown-menu dropdown-menu-end">
                          <a class="dropdown-item" href="'.$folder.'" target="_blank">Open</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Copy</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Move</a>
                          <a class="dropdown-item" href="'.$folder.'" download>Download</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Share</a>
                          <a class="dropdown-item rename_img" href="#" data-toggle="modal" data-target="#RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">Rename</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" id="'.$folder.'" onclick="remove(this.id, '."'file'".', event);">Remove</a>
                      </div>

                      <div class="modal fade copyModal" id="copyModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Copy File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="source_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_copy" value="Copy"
                                  onclick="CopyFunction($('."'#source_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#destination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade moveModal" id="moveModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Move File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="hidden" class="form-control" name="source" id="msource_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.$folder.'">
                              <label>Select Path</label>
                              <div class="input-group mb-3">
                                ';                                              
                                  echo "<select class='form-control' id='mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."' name='destination'>";
                                  echo "<option value='../Documents/".$value."'>Documents</option>";
                                  listFolder('../Documents', $value);
                                  echo "</select>";
                                echo '
                                <div class="input-group-append">
                                  <input type="button" class="btn btn-success submit_move" value="Move"
                                  onclick="MoveFunction($('."'#msource_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#mdestination_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>
                      
                      <div class="modal fade shareModal" id="shareModal_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Share File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              
                              <input type="hidden" name="filename" id="filename_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="http://malwe.online/'.str_replace('../', '', $folder).'" required>
                              <div class="input-group mb-3">
                                <input type="email" name="email" id="email_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" class="form-control" placeholder="Enter Email" required>
                                <div class="input-group-append">
                                  <button type="button" class="btn btn-success submit_share"
                                  onclick="ShareFunction($('."'#email_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), $('."'#filename_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val());">
                                    <i class="fa fa-envelope-o mr-1" aria-hidden="true"></i>
                                    Share
                                  </button>
                                </div>
                              </div>

                            </div>
                            
                          </div>
                        </div>
                      </div>

                      <div class="modal fade rename_img_modal" id="RenameIMG_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                          
                            <!-- Modal Header -->
                            <div class="modal-header">
                              <h4 class="modal-title">Rename File</h4>
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                              <input type="text" class="form-control d-inline-block w-75" id="rename_img_file_'.str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME)).'" value="'.pathinfo($folder, PATHINFO_FILENAME).'" />.'.pathinfo($folder, PATHINFO_EXTENSION).'
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" id="'.pathinfo($folder, PATHINFO_FILENAME).'.'.pathinfo($folder, PATHINFO_EXTENSION).'" folder="'.$path.'" extension=".'.pathinfo($folder, PATHINFO_EXTENSION).'"
                              onclick="RenameIMG($('."'#rename_img_file_".str_replace(array(' ', '(', ')', '-'), array('_', '', '', ''), pathinfo($folder, PATHINFO_FILENAME))."'".').val(), this.id, $(this).attr('."'folder'".'), $(this).attr('."'extension'".'));">Rename</button>
                            </div>
                            
                          </div>
                        </div>
                      </div>
                  </div>
              </td>
          </tr>                       
        ';
      }
    }
  }
}

getDirectory('../Documents/');
// Snippet from PHP Share: http://www.phpshare.org

function formatSizeUnits($bytes)
{
  if ($bytes >= 1073741824)
  {
      $bytes = number_format($bytes / 1073741824, 2) . ' GB';
  }
  elseif ($bytes >= 1048576)
  {
      $bytes = number_format($bytes / 1048576, 2) . ' MB';
  }
  elseif ($bytes >= 1024)
  {
      $bytes = number_format($bytes / 1024, 2) . ' KB';
  }
  elseif ($bytes > 1)
  {
      $bytes = $bytes . ' bytes';
  }
  elseif ($bytes == 1)
  {
      $bytes = $bytes . ' byte';
  }
  else
  {
      $bytes = '0 byte';
  }

  return $bytes;
}
?>