@include('layout.header')
{{ Form::open(array('url' => 'user/remove/submit')) }}
<input type="hidden" value="{{ Route::input('user_id') }}" name="user_id">
<h3>Use Manage</h3>
<hr class="hrHeader"/>
<div align="center">

<div class="k-block extended auto" style="width:40%">
<b>Use delete</b>

<hr/>
 @if ($errors->has())
	 @foreach ($errors->all() as $error)
		<div class="message red">{{ $error }}<br/></div>
	 @endforeach
 @endif
	<table class="tableStyling" cellpadding="0" cellspacing="0" width="100%">

		<tr>
	
			<td>Would you like to remove this entry?</td>
		</tr>

		<tr>
	
			<td align="right">
				<button class="k-button" id="btnBack" type="button">Cancel</button> 
			{{Form::submit('Delete', ['class' => 'k-button k-primary'])}}
	
			</td>
			
		</tr>
	</table>
</div>
</div>
{{Form::close()}}
<script type="text/javascript">
	$(document).ready(function(e){
		// Button Back
		$("#btnBack").click(function(e){
			window.location.href="{{ URL::to('user/list') }}";
		});
	});
</script>
@include('layout.footer')