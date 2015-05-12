@include('layout.header')

    <div class="row">
		 <div class="col-md-12">
			<h3>ລາຍການ ສິນຄ້າອອກ</h3>
		
		</div>
	</div>

	<div class="row">
    <div class="col-md-12 col-md-offset-0">

	<div id="toolbar">
            <div class="form-inline" role="form">
            	 <!-- <a href="{{ URL::to('sale/add') }}" class="btn btn btn-primary">ເພີ່ມລາຍ ສິນຄ້າອອກ</a>
            	<button type="button" id="btn_edit" class="btn btn-default">ແກ້ໄຂ</button> --> 
                <!-- <button type="button" id="btn_remove" class="btn btn btn-danger">ລົບລ້າງ</button> -->
                 <div class="input-daterange input-group" id="datepicker">
			        <input type="text" class="input-sm form-control" name="start" id="date_from" value="{{ date('d-M-Y') }}" />
			        <span class="input-group-addon">to</span>
			        <input type="text" class="input-sm form-control" name="end" id="date_to" value="{{ date('d-M-Y') }}" />
			    	</div> <button type="button" id="btn_date" class="btn btn-default">ຕົກລົງ</button>
			    
			     <button type="button" id="btn_refresh" class="btn btn-default">Refresh</button>
            </div>
        </div>
    <table id="table"
               data-toggle="table"
               data-url=""
               data-height="700"
               data-side-pagination="server"
               data-toolbar="#toolbar"
               data-pagination="true"
              data-show-footer="true"
              data-page-size="20"
               data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="false">
            <thead>
             <tr>
            	<th data-field="state" data-checkbox="true"></th>
            	
                <th data-field="date">ວັນທີ</th>
                <!--   <th data-field="sale_number">ລະຫັດລາຍການຂາຍ</th>-->
                <th data-field="product_code">ລະຫັດສິນຄ້າ</th>
                <th data-field="product_description">ລາຍລະອຽດ</th>
                <th data-field="quality" data-footer-formatter="totalPriceFormatter">ຈຳນວນ</th>
                <th data-field="product_unit">ຫົວໜ່ວຍ</th>
               <!-- <th data-field="customer_name">ລູກຄ້າ (Customer)</th>
                <th data-field="note">ໝາຍເຫດ</th>-->
            </tr>
            </thead>
        </table>


	</div>
	</div>
   
<script>
$(document).ready(function(){

	var $table = $('#table');
		$txt_purchase_number = $("#txt_purchase_number");
		$btn_remove = $("#btn_remove");
		$btn_date = $("#btn_date");
		$date_from = $("#date_from");
		$date_to = $("#date_to");
		$btn_refresh = $("#btn_refresh");
		
		$table.bootstrapTable('refresh', {
			url : "{{ URL::to('sale/json?search=byDate&date_from="+$date_from.val()+"&date_to="+$date_to.val()+"&order=asc&limit=10&offset=0') }}"
		});
		 	
        function totalQualityFormatter(data) {
            var total = 0;
            $.each(data, function (i, row) {
                total += +(row.price.substring(1));
            });
            return '$' + total;
        }
			
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
				if(data.success == true) {

		            var randomId = 100 + ~~(Math.random() * 100);
		           
		            $table.bootstrapTable('insertRow', {
		                index: 0,
		                row: {
		                	id : randomId,
							image : 'image.png',
						    category : 'General',
						    code : '1235676780' + randomId,
							description : 'Product Description...',
						    quality : randomId
		                }
		            });
					
					//$table.bootstrapTable('refresh');
					$btn.button('reset');
				}
				
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

	/** Date fileter */
	$btn_date.click(function(e){
		e.preventDefault();
		$table.bootstrapTable('refresh', {
			url : "{{ URL::to('sale/json?search=byDate&date_from="+$date_from.val()+"&date_to="+$date_to.val()+"&order=asc&limit=10&offset=0') }}"
		});
	});

	$btn_refresh.click(function(e){
		e.preventDefault();
		$date_from.val("{{ date('d-M-Y') }}");
		$date_to.val("{{ date('d-M-Y') }}");
		$table.bootstrapTable('refresh', {
			url : "{{ URL::to('sale/json?search=byDate&date_from="+$date_from.val()+"&date_to="+$date_to.val()+"&order=asc&limit=10&offset=0') }}"
		});
	});

	$('.input-daterange').datepicker({
    	todayHighlight: true,
    	format: "dd-MM-yyyy",
        forceParse: false
    });

});
</script>
	
@include('layout.footer')
