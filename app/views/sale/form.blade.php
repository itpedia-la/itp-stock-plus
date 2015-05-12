@include('layout.header')


    
    <div class="row">
		 <div class="col-md-12">
			<h3>ເພີ່ມລາຍການຂາຍ</h3>
			<!--  <p>Please enter your new purchase details below. Fields with * are required. </p>-->
		</div>
	</div>

	<div class="row">
    <div class="col-md-8 col-md-offset-0">
    
    <div class="panel panel-default">
  <div class="panel-body">
	    
	      <form class="form-horizontal" role="form" id="frm_main" method="post">
	      
	      <div class="form-group">
		    <label class="control-label col-sm-3" for="sale_number">ລະຫັດລາຍການຂາຍ: *</label>
		    <div class="col-sm-4">
		      <input type="text" class="typeahead form-control" id="sale_number" name="sale_number" placeholder="Sale No." > 
		    </div>
		     <label class="control-label col-sm-2" for="date" >ວັນທີ: *</label>
		     <div class="col-sm-3">
		      <input type="text" class="form-control" id="date" value="{{ date('d-M-Y') }}" name="date" placeholder="Sale Date"> 
		    </div>
		    
		    
		  </div>
		
		  
		  <div class="form-group">
		    <label class="control-label col-sm-3" for="product_code">ລະຫັດສິນຄ້າ: *</label>
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
		    <div class="col-sm-9">
		     <input type="text" class="form-control" id="description" readonly="readonly" name="description" placeholder="Product Description">
		    </div>

		  </div>
		  
		  <div class="form-group">
		    <label class="control-label col-sm-3" for="customer_code"></label>
		    <div class="col-sm-4">
		      
		    </div> 

		     <label class="control-label col-sm-1" for="note">ໝາຍເຫດ:</label>
		     <div class="col-sm-4">
		       <input type="text" class="form-control" id="note" name="note" placeholder="Sale Note">
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-3 col-sm-1">
		     <button type="button" id="btn_submit" data-loading-text="ບັນທຶກ..." class="btn btn-primary">
ບັນທຶກ
</button>

		    </div>
		    <div class="col-sm-offset-1 col-sm-7" align="right">
		     
<button type="reset" id="btn_reset" data-loading-text="Saving..." class="btn btn-default">
Reset
</button>
		    </div>
		  </div>
		</form>
	
	
    </div>
    </div>

</div>

	<!--  <div class="col-md-4 col-md-offset-0">	  

    <div class="panel panel-primary">
    	<div class="panel-heading">
    	Summary
    	</div>
        <div class="panel-body">
        <div class="row">
        	<div class="col-sm-6">
					<h4>Total:</h4>
		    </div>
		    <div class="col-sm-6">
					<h4><span class="label label-default">350,000.00</span></h4>
		    </div>
        </div>
        <div class="row">
        	<div class="col-sm-6">
					<h4>Disount:</h4>
		    </div>
		    <div class="col-sm-6">
					<h4><span class="label label-danger">-20,000.00</span></h4>
		    </div>
        </div>
        <hr style="margin:14px 0px 14px 0px"/>
        <div class="row">
        	<div class="col-sm-6">
					<h3>Grand Total:</h3>
		    </div>
		    <div class="col-sm-6">
					<h3><span class="label label-success">11,350,000.00</span></h3>
		    </div>
        </div>
        </div> 
        <div class="panel-footer clearfix">
            <div class="pull-right">
                <a href="#" class="btn btn-primary">Check Out</a>
            </div>
        </div>
    </div>

	  
	  
	</div>
</div>-->

	<div class="row">
    <div class="col-md-12 col-md-offset-0">

	<div id="toolbar">
            <div class="form-inline" role="form">
            	 <!--<a href="{{ URL::to('purchase/add') }}" class="btn btn btn-primary">ເພີ່ມລາຍການຈັດຊຶ້</a>
            	 <button type="button" id="btn_edit" class="btn btn-default">ແກ້ໄຂ</button> --> 
                <button type="button" id="btn_remove" class="btn btn btn-danger">ລົບລ້າງ</button>  <button type="button" id="btn_print" class="btn btn-default">Print</button>
            </div>
        </div>
    <table id="table"
               data-toggle="table"
               data-url="{{ URL::to('sale/json?search=null') }}"
               data-height="500"
               data-side-pagination="server"
               data-toolbar="#toolbar"
               data-pagination="true"
               data-page-size="10"
               data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="false">
            <thead>
             <tr class="active">
            	<th data-field="state" data-checkbox="true"></th>
                <th data-field="date">ວັນທີ</th>
                <th data-field="sale_number">ລະຫັດລາຍການຂາຍ</th>
                <th data-field="product_code">ລະຫັດສິນຄ້າ</th>
                <th data-field="product_description">ລາຍລະອຽດ</th>
                
                <th data-field="quality" align="center">ຈຳນວນ</th>
                <th data-field="product_unit">ຫົວໜ່ວຍ</th>
                <!-- <th data-field="sale_net_total" align="right">ລວມ</th>
                <th data-field="product_price">ລາຄາ</th>
                <th data-field="sale_net_profit">ກຳໄລ</th> 
                <th data-field="customer_name">ລູກຄ້າ (Customer)</th>-->
                <th data-field="note">ໝາຍເຫດ</th>
            </tr>
            </thead>
        </table>
	</div>
	</div>
   
<script>
$(document).ready(function(){

	var $table = $('#table');
		$sale_number = $("#sale_number");
	    $product_id = $("#product_id");
	    $date = $("#date");
	    $product_code = $("#product_code");
	    $quality = $("#quality");
	    $note = $("#note");
	    $description = $("#description");
		$btn_remove = $("#btn_remove");

        /** From Submit **/
    	$("#btn_submit").click(function() {
    	    var $btn = $(this);
    	    $btn.button('loading');
    	    $.ajax({
    			url : "{{ URL::to('sale/add/save') }}",
    			type : "POST",
    			dataType : 'json',
    			data : $("#frm_main").serialize(),
    			success : function(data) {

    	            $table.bootstrapTable('insertRow', {
    	                index: 0,
    	                row: {
    		                id : data.id,
    		                date : $date.val(),
    		               	sale_number : data.sale.sale_number,
    		                product_code : data.sale.product_code,
    		                product_description : data.sale.product_description,
    		                quality : data.sale.quality,
    		                product_unit : data.sale.product_unit,
    		                product_price : data.sale.product_price,
    		                sale_net_total : data.sale.sale_net_total,
    		                customer_name : data.sale.customer_name,
    		                note : data.sale.note
    	                }
    	            });
    				
    				$btn.button('reset');

    				$quality.val("");
    				$note.val("");
    				$product_id.val("");
    				$description.val("");
    				$product_code.val("");
    				$product_code.focus();

    				//$table.bootstrapTable('refresh');
    				
    			},
    			error: function(data){

    				alert(data.responseJSON.message);
    			    $btn.button('reset');
    		     
    		    }
    		});
    	});

    	/** Search product by code **/
    	function product_by_code() {
    		$.ajax({
    			url : "{{ URL::to('product/find') }}/"+$product_code.val(),
    			type : "GET",
    			dataType : 'json',
    			success : function(product) {

    				$product_id.val(product[0].id);
    				$description.val(product[0].description);
    				$quality.focus();
    			},
    			error : function() {
    				alert('ຂໍອະໄພ ລະຫັດສິນຄ້າບໍ່ຖືກຕ້ອງ');
    				$quality.val("");
    				$note.val("");
    				$product_id.val("");
    				$product_code.val("");
    			}
    		})
    	}

    	/** sael_search **/
    	function sale_number_search() {
    		if( $sale_number.val() != '' ) {
    			$table.bootstrapTable('refresh', {
    				url : "{{ URL::to('sale/json?search="+$sale_number.val()+"&order=asc&limit=10&offset=0') }}"
    			});
    		}
    	}

    	/** Product search by code */
        $product_code.keypress(function(e) {
    		if(e.which == 13) {
    			product_by_code();
    		}
        });

        /** sale number searhc **/
    	$sale_number.blur(function(e){

    		sale_number_search();
    	});

    	$sale_number.keypress(function(e){
			if(e.which == 13) {
				sale_number_search();
			}
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

				var $get_confirm = confirm('ທ່ານຕ້ອງການລົບລ້າງລາຍການນີ້ຫລືບໍ່?');
				if( $get_confirm == true ) {
					
					$.ajax({
						url : '{{ URL::to("sale/remove") }}/'+ids,
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
        format: "dd MM yyyy",
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });

});
</script>
	
@include('layout.footer')
