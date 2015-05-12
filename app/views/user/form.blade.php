@include('layout.header')
{{ Form::open(array('url' => 'user/form/submit')) }}
<h3>User Manage</h3>
<hr class="hrHeader"/>
<div align="center">

<div class="k-block extended auto" style="width:40%">
<b>Add new User</b>

<hr/>
 @if ($errors->has())
	 @foreach ($errors->all() as $error)
		<div class="message red">{{ $error }}<br/></div>
	 @endforeach
 @endif
<!-- <div class="message green">Successfull</div> -->
	<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<td width="40%">User Group:</td>
			<td><input type="text" id="ddUserGroup" style="width:100%" name="user_group_id" value=""></td>
		</tr>
		<tr>
			<td>ID / Email: *</td>
			<td><input type="text" class="k-textbox" style="width:100%" name="login" value=""></td>
		</tr>
		<tr>
			<td>Password: *</td>
			<td><input type="password" class="k-textbox" style="width:100%" name="password"></td>
		</tr>
<tr>
			<td>Firstname: *</td>
			<td><input type="text" class="k-textbox" style="width:100%" name="firstname" value=""></td>
		</tr>
		<tr>
			<td>Lastname:</td>
			<td><input type="text" class="k-textbox" style="width:100%" name="lastname" value=""></td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			
			<td align="right">
			<button class="k-button" id="btnBack" type="button">Cancel</button> 
			{{Form::submit('Save', ['class' => 'k-button k-primary'])}}
	
			</td>
			
		</tr>
	</table>
</div>
</div>
{{Form::close()}}
<script type="text/javascript">
	$(document).ready(function(e){
		
		// User Group Dropdown
		$("#ddUserGroup").kendoDropDownList({
			dataValueField: "id",
	        dataTextField: "name",
	        autoBind: true,
	        change: function(e) {
	            var id = this.value();
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

		// Button Back
		$("#btnBack").click(function(e){
			window.location.href="{{ URL::to('user/list') }}";
		});
	});
</script>
@include('layout.footer')