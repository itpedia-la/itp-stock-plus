@include('layout.header')
<div align="center">
<img src="img/logo.png"  style="display:block; margin-bottom:20px" width="100">
<div class="k-block extended auto">

 @if ($errors->has())
	 @foreach ($errors->all() as $error)
		<span class="tag red"> {{ $error }}</span><br>    
	 @endforeach
 @endif
@if( Session::get('message') ) <div class="message green">{{ Session::get('message') }}</div>@endif
{{ Form::open(array('url' => 'user/login/submit')) }}
<!--  <table class="tableStyling" cellpadding="0" cellspacing="0">
	<tr>
		<td>ID / Email:</td>
		<td><input type="textbox" class="k-textbox" name="email" id="email" value="{{ Input::get('email') }}"></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" class="k-textbox" name="password" id="password"></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td align="right"><button class="k-button k-primary" type="submit">Login</button></td>
	</tr>
</table>-->

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Panel title</h3>
  </div>
  <div class="panel-body">
    Panel content
  </div>
</div>
</div>
</div>
{{ Form::close() }}
@include('layout.footer')