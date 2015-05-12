@include('layout.header')

    
    <div class="row">
		 <div class="col-md-12">
			<h3>ເພີ່ມລາຍການ ສິນຄ້າເຂົ້າ</h3>
			
		</div>
	</div>

	<div class="row">
    <div class="col-md-8 col-md-offset-0">
    
    <div class="panel panel-default">
  <div class="panel-body">
	    
	      <form class="form-horizontal" role="form" id="frm_main" method="post">
	      
	      <div class="form-group">
		    <label class="control-label col-sm-3" for="purchase_number">ລະຫັດໃບຈັດຊື່: *</label>
		    <div class="col-sm-4">
		      <input type="text" class="typeahead form-control" id="purchase_number" name="purchase_number" placeholder="Purchase No." > 
		    </div>
		     <label class="control-label col-sm-2" for="date">ວັນທີ: *</label>
		     <div class="col-sm-3">
		      <input type="text" class="form-control" id="date" value="{{ date('d-M-Y') }}" name="date" placeholder="Purchase Date"> 
		    </div>
		    
		    
		  </div>
		
		  
		  <div class="form-group">
		    <label class="control-label col-sm-3" for="product_id">ລະຫັດສິນຄ້າ: *</label>
		    <div class="col-sm-4">
		      <input type="hidden" class="form-control" id="product_id" name="product_id">
		    <input type="text" class="form-control" id="product_code" name="product_code" placeholder="Enter ID or Barcode">
		    </div>
		    <label class="control-label col-sm-2" for="quality">ຈຳນວນ: *</label>
		     <div class="col-sm-3">
		    
		       <input type="number" min="0" class="form-control" id="quality" name="quality" placeholder="Enter Quality"> 
		    </div>
		  </div>
		  
		   <div class="form-group">
		    <label class="control-label col-sm-3" for="description">ລາຍລະອຽດສິນຄ້າ:</label>
		    <div class="col-sm-4">
		     <input type="text" class="form-control" id="description" readonly="readonly" name="description" placeholder="Product Description">
		    </div>

		    <label class="control-label col-sm-2" for="unit">ຫົວໜ່ວຍ:</label>
		    <div class="col-sm-3">
		     <input type="text" class="form-control" id="unit" readonly="readonly" name="unit" placeholder="Unit">
		    </div>
		    
		  </div>
		  
		   <div class="form-group">
		    <label class="control-label col-sm-3" for="supplier_id">ຜູ້ຈັດຈຳໜ່າຍ (Supplier):</label>
		    <div class="col-sm-4">
		      <select class="form-control" name="supplier_id" id="supplier_id">
			    <option value="">- ເລືອກ -</option>
			    @if( Supplier::all() )
				@foreach( Supplier::all() as $supplier )
				<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
				@endforeach
				@endif
			 </select>
		    </div>
		    
		    
		     <label class="control-label col-sm-1" for="note">ໝາຍເຫດ:</label>
		     <div class="col-sm-4">
		       <input type="text" class="form-control" id="note" name="note" placeholder="Purchase note">
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-3 col-sm-1">
		     <button type="button" id="btn_submit" data-loading-text="ບັນທຶກ..." class="btn btn-primary">
ບັນທຶກ
</button>

		    </div>
		    <div class="col-sm-offset-1 col-sm-7" align="right">
		     
<button type="reset" id="btn_reset" data-loading-text="Saving..." class="btn btn-default btn-sm">
Reset
</button>
		    </div>
		  </div>
		</form>
	
	
    </div>
    </div>
    
</div>

<div class="col-md-4">
	<div class="panel panel-warning" id="panel-warning" style="display:none">
    	<div class="panel-heading">
       		<h3 class="panel-title">ຂໍ້ມູນບໍ່ຄົບຖ້ວນ</h3>
    	</div>
    	<div class="panel-body">123</div>
	</div>
</div> 

</div>
	
	
	<div class="row">
    <div class="col-md-12 col-md-offset-0">

	<p><button type="button" id="btn_remove" class="btn btn btn-danger">ລົບລ້າງ</button></p>
    <table id="table"
               data-toggle="table"
               data-url="{{ URL::to('purchase/json?search=null&order=asc&limit=10&offset=0') }}"
               data-height="700"
               data-side-pagination="server"
               data-pagination="true"
               data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="false">
            <thead>
            <tr class="active">
            	<th data-field="state" data-checkbox="true"></th>
                <th data-field="purchase_date">ວັນທີ</th>
                <th data-field="purchase_number">ລະຫັດລາຍການຈັດຊື້</th>
                <th data-field="product_code">ລະຫັດສິນຄ້າ</th>
                <th data-field="product_description">ລາຍລະອຽດ</th>
                <th data-field="quality">ຈຳນວນ</th>
                <th data-field="unit">ຫົວໜ່ວຍ</th>
                <th data-field="supplier">ຜູ້ຈັດຈຳໜ່າຍ (Supplier)</th>
                <th data-field="note">ໝາຍເຫດ</th>
            </tr>
            </thead>
        </table>


	</div>
	
	
	</div>
   
<script>
$(document).ready(function(){

	var $table = $('#table');
		$purchase_number = $("#purchase_number");
	    $product_id = $("#product_id");
	    $date = $("#date");
	    $product_code = $("#product_code");
	    $quality = $("#quality");
	    $note = $("#note");
	    $description = $("#description");
		$txt_purchase_number = $("#txt_purchase_number");
		$btn_remove = $("#btn_remove");
        $unit = $("#unit");
        
	/** Search product by code **/
	function product_by_code() {
		$.ajax({
			url : "{{ URL::to('product/find') }}/"+$product_code.val(),
			type : "GET",
			dataType : 'json',
			success : function(product) {

				$product_id.val(product[0].idx);
				$description.val(product[0].item_name);
				
				$unit.val(product[0].unit_name);
				
				$quality.focus();
			},
			error : function() {
				alert('ຂໍອະໄພ ລະຫັດສິນຄ້າບໍ່ຖືກຕ້ອງ');
				$quality.val("");
				$note.val("");
				$product_id.val("");
				$product_code.val("");
				$unit.val("");
			}
		})
	}

	/** Pruchase saerch function **/
	function purchase_number_search() {
		if( $purchase_number.val() != '' ) {
			$table.bootstrapTable('refresh', {
				url : "{{ URL::to('purchase/json?search=byPon&pon="+$purchase_number.val()+"&order=asc&limit=10&offset=0') }}"
			});
		}
	}
	
	/** purchse number searhc **/
	$purchase_number.blur(function(e){

		purchase_number_search();
	});
	
	$purchase_number.keypress(function(e){
		if(e.which == 13) {
			purchase_number_search();
		}
    });
	
   	/** Product search by code */
    $product_code.keypress(function(e) {
		if(e.which == 13) {
			product_by_code();
		}
    });
			
	/** From Submit **/
	$("#btn_submit").click(function() {
	    var $btn = $(this);
	    $btn.button('loading');
	    $.ajax({
			url : "{{ URL::to('purchase/add/save') }}",
			type : "POST",
			dataType : 'json',
			data : $("#frm_main").serialize(),
			success : function(data) {

	            $table.bootstrapTable('insertRow', {
	                index: 0,
	                row: {
		                id : data.id,
		                purchase_date : $date.val(),
		                purchase_number : data.purchase.purchase_number,
		                product_code : data.purchase.product_code,
		                product_description : data.purchase.product_description,
		                quality : data.purchase.quality,
		                supplier : data.purchase.supplier_name,
		                note : data.purchase.note
	                }
	            });
				
				$btn.button('reset');

				$quality.val("");
				$note.val("");
				$product_id.val("");
				$description.val("");
				$product_code.val("");
				$product_code.focus();
				$unit.val("");
				//$table.bootstrapTable('refresh');
				
			},
			error: function(data){

				$("#panel-warning").fadeIn("fast");
			    $("#panel-warning .panel-body").html( data.responseJSON.message);
			    $btn.button('reset');
		     
		    }
		});
	});
	
	/** Remove **/
	$(function(){
		$btn_remove.click(function(){

			var ids = $.map($table.bootstrapTable('getSelections'), function (row) {
                return row.id;
            });

			if( ids == "" ) {
				alert('ກະລຸນາເລືອກລາຍການສຳຫລັບລົບລ້າງ');
			} else {

				var $get_confirm = confirm('ທ່ານຕ້ອງການລົບລ້າງລາຍການສິນຄ້ານີ້ຫລືບໍ່?');
				if( $get_confirm == true ) {
					
					$.ajax({
						url : '{{ URL::to("purchase/remove") }}/'+ids,
						type : 'POST',
						dataType : 'json',
						success : function(data) {
	
							if( data.success == true ) {
								 $table.bootstrapTable('remove', {
						                field: 'id',
						                values: ids
						         });
							}
						}
					});
	
				} else { return  false }

			}
			
		});
	});

    $("#date").datepicker({
        format: "dd-MM-yyyy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });

});
</script>
	
@include('layout.footer')
