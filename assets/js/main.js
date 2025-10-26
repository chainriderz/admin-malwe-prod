var FetchAllDirectories;
var FetchStaffs;
var DataTable;
$(document).ready(function ()
{
  // Function to calculate total from multiple fields
  function calculateTotal() {
      let total = 0;
      $('.calc-field').each(function() {
          total += parseFloat($(this).val()) || 0;
      });
      $('input[name="total_amt_disply"]').val(total);
      $('input[name="total_amt"]').val(total);
      calculateBalance(); // also update balance automatically
  }

  // Function to calculate balance
  function calculateBalance() {
      let total = parseFloat($('input[name="total_amt"]').val()) || 0;
      let received = parseFloat($('input[name="received_amt"]').val()) || 0;
      let balance = total - received;

      $('input[name="balance_amt_disply"]').val(balance);
      $('input[name="balance_amt"]').val(balance);
  }

  // Event: When any calc field changes → update total & balance
  $('.calc-field').on('input', calculateTotal);

  // Event: When received amount changes → update balance
  $('input[name="received_amt"]').on('input', calculateBalance);
  
	FetchAllDirectories = function()
	{
		$.ajax({
			url: "directory_process.php",
			beforeSend: function()
			{
				$("body").addClass("loading");
			},
			success: function(result)
			{
	   			$(".get_directory_contents").html(result);
	  		},
	  		complete:function(result)
	  		{
				$("body").removeClass("loading");
			}
	  	});
	}
	
	FetchStaffs = function()
	{
	    $.ajax({
			url: "fetch_staff.php",
			success: function(result)
			{
			 //   console.log(result);
	   			$("select.fetchstaff").html(result);
	  		}
	  	});
	}
	DataTable = function()
	{
	    $("#filemanager").DataTable();
	}
	
// 	setInterval(FetchStaffs, 1000);
	setInterval(DataTable, 1000);
	
	FetchAllDirectories();
// 	FetchStaffs();
	
	$(".select_staff").select2({
        dropdownParent: $(".shareModal")
    });
});

$(document).on('submit', 'form.uploadFiles', function(e)
{
    e.preventDefault();
    var data = new FormData();

    // Read selected files
	var totalfiles = document.getElementById('file').files.length;
	for (var index = 0; index < totalfiles; index++)
	{
		data.append("file[]", document.getElementById('file').files[index]);
	}

    $.each($('form.uploadFiles').serializeArray(), function (i, obj) {
        data.append(obj.name, obj.value)
    });

    $.ajax({
        url: "uploadfiles_process.php",
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function (result)
        {
            // console.log(result);
            if (result == 'file_exists')
   			{
   				alert("A File With The Same Name Already Exists");
   			}
   			else
   			{
   				alert("File(s) uploaded successfully !");
   				document.getElementById('file').value = '';
   				$('#uploadFiles').modal("hide");
   			}
        },
        error: function () {
            // alert("error in ajax form submission");
        }
     });
});

function CopyFunction(src, dst)
{
	$.ajax({
		type: "GET",
		url: "copy_process.php?src="+src+"&dst="+dst,
		success: function(result)
		{
			// console.log(result);
   			if (result == 'file_exists')
   			{
   				alert("A File With The Same Name Already Exists");
   			}
   			else if (result == 'folder_exists')
   			{
   				alert("A Folder With The Same Name Already Exists");
   			}
   			else if (result == 'file_copied')
   			{
   				alert("Successfully Copied file !");
   				$('.copyModal').modal("hide");
   			}
   			else if (result == 'folder_copied')
   			{
   				alert("Successfully Copied folder !");
   				$('.copyModal').modal("hide");
   			}
  		}
  	});
}

function MoveFunction(src, dst)
{
	$.ajax({
		type: "GET",
		url: "move_process.php?src="+src+"&dst="+dst,
		success: function(result)
		{
			// console.log(result);
   			if (result == 'file_exists')
   			{
   				alert("A File With The Same Name Already Exists");
   			}
   			else if (result == 'folder_exists')
   			{
   				alert("A Folder With The Same Name Already Exists");
   			}
   			else if (result == 'file_moved')
   			{
   				alert("Successfully Moved file !");
   				$('.moveModal').modal("hide");
   			}
   			else if (result == 'folder_moved')
   			{
   				alert("Successfully Moved folder !");
   				$('.moveModal').modal("hide");
   			}
  		}
  	});
}

function ShareFunction(email, file)
{
    if(email !== '')
    {
        $.ajax({
    		type: "POST",
    		url: "share_file.php",
    		data: {file:file, email:email},
    		success: function(result)
    		{
       	        if($.trim(result) == "success")
       	        {
       	            alert("File Shared Successfully!");
       	        }
       	        else
       	        {
       	            alert("There is a problem sharing file, please try again later!");
       	        }
      		}
      	});
    }
    else
    {
        alert("Please Enter Email!");
    }
}

function FetchFolder(id, event)
{
	event.preventDefault();
	$.ajax({
		type: "GET",
		url: "folder_process.php?folder="+id,
		beforeSend: function()
		{
			$("body").addClass("loading");
		},
		success: function(result)
		{
   			$(".get_directory_contents").html(result);
  		},
  		complete:function(result)
  		{
			$("body").removeClass("loading");
		}
  	});
//   	FetchStaffs();
}

function createFolder(source, folder, event)
{
	event.preventDefault();
	// console.log("Source: "+source);
	// console.log("Folder: "+folder);
	$.ajax({
		type: "GET",
		url: "createfolder_process.php?source="+source+"&folder="+folder,
		success: function(result)
		{
			// console.log(result);
   			if (result == 'folder_exists')
   			{
   				alert("A Folder With The Same Name Already Exists");
   			}
   			else
   			{
   				alert("Folder created successfully !");
   				$('#createFolder').modal("hide");
   			}
  		}
  	});
}

function RenamePDF(newval, oldval, folder)
{
	event.preventDefault();
	$.ajax({
		type: "GET",
		url: "renamepdf_process.php?old="+oldval+"&new="+newval+"&folder="+folder,
		success: function(result)
		{
			// console.log(result);
   			if (result == 'file_exists')
   			{
   				alert("A File With The Same Name Already Exists");
   			}
   			else
   			{
   				alert("Successfully Renamed file !");
   				$('.rename_pdf_modal').modal("hide");
   			}
  		}
  	});
}

function RenameFOLDER(newval, oldval, folder)
{
	event.preventDefault();
	$.ajax({
		type: "GET",
		url: "rename_process.php?old="+oldval+"&new="+newval+"&folder="+folder,
		success: function(result)
		{
			// console.log(folder+oldval);
			// console.log(folder+newval);
   			if (result == 'folder_exists')
   			{
   				alert("A Folder With The Same Name Already Exists");
   			}
   			else
   			{
   				alert("Successfully Renamed folder !");
   				$('.rename_folder_modal').modal("hide");
   			}
  		}
  	});
}

function RenameIMG(newval, oldval, folder, extension)
{
	event.preventDefault();
	$.ajax({
		type: "GET",
		url: "renameimg_process.php?old="+oldval+"&new="+newval+"&folder="+folder+"&extension="+extension,
		success: function(result)
		{
			// console.log(result);
   			if (result == 'file_exists')
   			{
   				alert("A File With The Same Name Already Exists");
   			}
   			else
   			{
   				alert("Successfully Renamed file !");
   				$('.rename_img_modal').modal("hide");
   			}
  		}
  	});
}

function remove(dir, type, event)
{
	event.preventDefault();
	if (type == 'folder')
	{
		if (confirm('Make sure the folder is empty! This will permanently delete the folder! Delete anyways ?') == true)
		{
			$.ajax({
				type: "GET",
				url: "remove_process.php?dir="+dir,
				success: function(result)
				{
					// console.log(result);
					alert("Folder Deleted Successfully !");
		  		}
		  	});
		}
	}
	else
	{
		if (confirm('Are you sure you want to permanently delete this file ?') == true)
		{
			$.ajax({
				type: "GET",
				url: "remove_process.php?dir="+dir,
				success: function(result)
				{
					alert("File Deleted Successfully !");
		  		}
		  	});
		}
	}
}

function refresh(dir = null, event)
{
    // FetchStaffs();
	if (dir == null)
	{
		FetchAllDirectories();
		// $(".category_refresh").refresh();
	}
	else
	{
		FetchFolder(dir, event);
	}
}

function ShareLoad(event)
{
	event.preventDefault();
	$.ajax({
		type: "GET",
		url: "share_process.php",
		beforeSend: function()
		{
			$("body").addClass("loading");
		},
		success: function(result)
		{
		  //  console.log(result);
   			$(".get_directory_contents").html(result);
  		},
  		complete:function(result)
  		{
			$("body").removeClass("loading");
		}
  	});
//   	FetchStaffs();
}

$(document).on('shown.bs.modal','#createFolder', function ()
{
  $(this).find('#folder').select();
});

$(document).on('shown.bs.modal','.rename_img_modal', function ()
{
  $(this).find('input').select();
});

$(document).on('shown.bs.modal','.rename_pdf_modal', function ()
{
  $(this).find('input').select();
});

$(document).on('shown.bs.modal','.rename_folder_modal', function ()
{
  $(this).find('input').select();
})

$(document).on('shown.bs.modal','.shareModal', function ()
{
  FetchStaffs();
})