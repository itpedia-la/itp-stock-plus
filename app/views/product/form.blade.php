@include('layout.header')

<h3>@if(Route::input('product_id'))ແກ້ໄຂ@elseເພີ່ມ @endif ລາຍການ ສິນຄ້າ</h3>
			
	<div class="row">
	
    <div class="col-md-8">
    
    <div class="panel panel-default">
  <div class="panel-body">
	    
	      <form class="form-horizontal" role="form" method="post" action="{{ URL::to('product/add/save') }}" enctype="multipart/form-data">
	      <input type="hidden" name="product_id" value="{{ Route::input('product_id') }}">
		  <div class="form-group">
		    <label class="control-label col-sm-4" for="code">ລະຫັດສິນຄ້າ: *</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="code" name="code" placeholder="Enter Product ID / Barcode" value="@if(Route::input('product_id')){{ @$product->code }}@else{{ Input::old('code') }}@endif">
		    </div>
		  </div>
		  
		   <div class="form-group">
		    <label class="control-label col-sm-4" for="description">ລາຍລະອຽດ ສິນຄ້າ:</label>
		    <div class="col-sm-8">
		      <input type="text" class="form-control" id="description" name="description" placeholder="Enter Product Description" value="@if(Route::input('product_id')){{ $product->item_name}}@else{{ Input::old('description') }}@endif">
		    </div>
		    
		  </div>
		  
		  <div class="form-group">
		    <label class="control-label col-sm-4" for="category">ໝວດ: *</label>
		    <div class="col-sm-4">
		      <select class="form-control" name="category" id="category">
			    <option value="">- ເລືອກ -</option>
				@foreach( Category::all() as $category )
				<option value="{{ $category->idx }}" @if(@$product->stock_category_idx==$category->idx) selected="selected" @endif>{{ $category->category_name }}</option>
				@endforeach
			 </select>
		    </div>
		  </div>
		  

		   <div class="form-group">
		    <label class="control-label col-sm-4" for="quality">ຈຳນວນ: *</label>
		    <div class="col-sm-4">
		      <input type="number" min="0" class="form-control" id="quality" name="quality" placeholder="Enter Quality" value="@if(Route::input('product_id')){{ $product->quality }}@else{{ Input::old('quality') }}@endif">
		    </div>
		  </div>
		  
		  <div class="form-group">
		    <label class="control-label col-sm-4" for="unit">ຫົວໜ່ວຍ: *</label>
		    <div class="col-sm-4">
		      <select class="form-control" name="unit" id="unit">
			   <option value="">- ເລືອກ -</option>
				@foreach( Unit::all() as $unit )
				<option value="{{ $unit->idx }}" @if(@$product->stock_unit_idx_use==$unit->idx) selected="selected" @endif>{{ $unit->name }}</option>
				@endforeach
			 </select>
		    </div>
		  </div>
		  
		  <!-- <div class="form-group">
		    <label class="control-label col-sm-4" for="cost">ລາຄາຕົ້ນທຶນ: *</label>
		    <div class="col-sm-6">
		      <input type="number" min="0" class="form-control" id="cost" name="cost" placeholder="Enter Product Cost" value="@if(Route::input('product_id')){{ $product->cost }}@else{{ Input::old('cost') }}@endif">
		    </div>
		  </div>
		  
		    <div class="form-group">
		    <label class="control-label col-sm-4" for="price">ລາຄາຂາຍ: *</label>
		    <div class="col-sm-6">
		      <input type="number" min="0" class="form-control" id="price" name="price" placeholder="Enter Product Price" value="@if(Route::input('product_id')){{ $product->price }}@else{{ Input::old('price') }}@endif">
		    </div>
		  </div> -->
		  
		   <div class="form-group">
		    <label class="control-label col-sm-4" for="alert_quality">ຈຳນວນແຈ້ງເຕືອນ: *</label>
		    <div class="col-sm-5">
		      <input type="number" min="0" class="form-control" id="alert_quality" name="alert_quality" placeholder="Enter Alert Quality"  value="@if(Route::input('product_id')){{ $product->alert_quality}}@else{{ Input::old('alert_quality') }}@endif">
		    </div>
		  </div>
		  
		  <!-- <div class="form-group">
		    <label class="control-label col-sm-4" for="image">ຮູບພາບ ສິນຄ້າ:</label>
		    <div class="col-sm-5">
		      {{ Form::file('image') }}
		    </div>
		  </div> -->
		
		  <div class="form-group">
		    <div class="col-sm-offset-4 col-sm-3">
		      <button type="submit" class="btn btn-primary">ບັນທຶກ</button>
		    </div>
		  </div>
		</form>
	
    </div>
    </div>
    
</div>

<div class="col-md-4">

	@if ($errors->has())
	<div class="panel panel-warning">
    	<div class="panel-heading">
       		<h3 class="panel-title">Error</h3>
    	</div>
    	<div class="panel-body">{{ $errors->all()[0] }}</div>
	</div>
	@endif

	@if( Session::get('message') )
	
	<div class="panel panel-success">
    	<div class="panel-heading">
       		<h3 class="panel-title">Message</h3>
    	</div>
    	<div class="panel-body">{{ Session::get('message') }}</div>
	</div>
	@endif

</div>


   
	 
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
	
@include('layout.footer')
