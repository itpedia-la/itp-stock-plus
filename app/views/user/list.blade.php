@include('layout.header')

<h3>User Manage</h3>
<hr class="hrHeader"/>
<div class="k-block extended">
<div class="floatLeft">
	User Group: <input type="text" id="ddUserGroup" style="width:250px"> <button class="k-button" id="btnGroupPermission">Set Group Permission</button>
</div>
<div class="floatRight">
	<button class="k-button k-primary" id="btnAddUser">Add new User</button> <button class="k-button" id="btnChangePassword">Change Password</button>  <button class="k-button" id="btnRemove">Delete</button>
</div>
<div class="ClearFix"></div>
<hr/>
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
<div id="gridUserList"></div>
</div>
<script type="text/javascript">

	// Page element initial stage
	$("#btnRemove").kendoButton({enable:false});
	$("#btnChangePassword").kendoButton({enable:false});

	$("#btnGroupPermission").kendoButton({enable:false});
	
	// form Action element reset
	function btnReset() {

		$("#btnChangePassword").removeData('user_id');
		$("#btnRemove").removeData('user_id');
		
		$("#btnChangePassword").data('kendoButton').enable(false);
		$("#btnRemove").data('kendoButton').enable(false);
		
	}

	// form Action element Set
	function btnSet(user_id) {

		$("#btnChangePassword").data('user_id', user_id);
		$("#btnRemove").data('user_id', user_id);

		$("#btnChangePassword").data('kendoButton').enable(true);
		$("#btnRemove").data('kendoButton').enable(true);
		
	}
	
	// User Group Dropdown
	$("#ddUserGroup").kendoDropDownList({
		dataValueField: "id",
        dataTextField: "name",
        autoBind: true,
        change: function(e) {
            var id = this.value() > 0 ? this.value() : 0;
            
            btnReset();

            var grid = $("#gridUserList").data("kendoGrid");
            grid.dataSource.transport.options.read.url = "user/json/list/group/"+id;
            grid.dataSource.read(); 

            if( id > 0 ) {
            	$("#btnGroupPermission").data('kendoButton').enable(true);
            	$("#btnGroupPermission").data('id',id);
            } else {
            	$("#btnGroupPermission").data('kendoButton').enable(false);
            	$("#btnGroupPermission").removeData('id');
            }
			
        },
        optionLabel: {
        	name: '- All Groups -',
            id: ""
        },
        dataSource: {
            transport: {
                read: {
                	url: "{{ URL::to('user/json/group') }}",
                    dataType: "json",
                }
            }
        }
	});
	
    // User Grid Datasource
	var sourceUserList = new kendo.data.DataSource({
		transport: {
	    	read:  {
	           		url: "{{ URL::to('user/json/list') }}",
	                dataType: "json"
	           },
	        },
		pageSize: 10,
	});

	// User Grid
	$("#gridUserList").kendoGrid({
		dataSource: sourceUserList,
		pageable: false,
		selectable: true,
		sortable: true,
		height: 400,
		change: function(e) {
			  grid = e.sender;
			  var selectedValue = grid.dataItem(this.select());
			  btnSet(selectedValue.id);
		}, 
		filter: true,
	    	columns: [
	    	    { field:"id", title: "ID", width: '5%',},
	    	    { field:"user_group", title: "User Group", width: '10%', encoded:false },
				{ field:"login", title: "ID / Email", width: '15%', encoded:false },
				{ field:"firstname", title: "Firstname", width: '10%', encoded:false },
				{ field:"lastname", title: "Lastname", width: '10%', encoded:false },
				{ field:"created_at", title: "Created", width: '10%', encoded:false },
				{ field:"updated_at", title: "Updated", width: '10%', encoded:false },
	        ],
	});

	// User Add
	$("#btnAddUser").click(function(e){
		window.location.href="{{ URL::to('user/form') }}";
	});

	// User Edit
	$("#btnChangePassword").click(function(e){
		window.location.href= 'user/changepassword/'+$(this).data('user_id');
	});

	// User remove
	$("#btnRemove").click(function(e){
		
		window.location.href= 'user/remove/'+$(this).data('user_id');
	});

	// Group Set Permission
	$("#btnGroupPermission").click(function(e){

		window.location.href= 'user/group/permission/'+$(this).data('id');
	});

</script>

@include('layout.footer')