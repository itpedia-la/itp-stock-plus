@include('layout.header')
    
    <div class="row">
		 <div class="col-md-12">
			<h3>ລາຍການ ສິນຄ້າເຂົ້າ</h3>

		</div>
	</div>

	<div class="row">
    <div class="col-md-12 col-md-offset-0">

	<div id="toolbar">
            <div class="form-inline" role="form">
            	 <a href="{{ URL::to('purchase/add') }}" class="btn btn btn-primary">ເພີ່ມລາຍການ ສິນຄ້າເຂົ້າ</a>
            	<!-- <button type="button" id="btn_edit" class="btn btn-default">ແກ້ໄຂ</button> --> 
                <button type="button" id="btn_remove" class="btn btn btn-danger">ລົບລ້າງ</button>
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
               data-page-size="20"
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
                <th data-field="supplier">Supplier</th>
                <th data-field="note">ໝາຍເຫດ</th>
            </tr>
            </thead>
        </table>


	</div>
	</div>

<script>
$(document).ready(function(){

	var $table = $('#table');
		$btn_edit = $("#btn_edit");
		$btn_remove = $("#btn_remove");
		$btn_date = $("#btn_date");
		$date_from = $("#date_from");
		$date_to = $("#date_to");
		$btn_refresh = $("#btn_refresh");

		$table.bootstrapTable('refresh', {
			url : "{{ URL::to('purchase/json?search=byDate&date_from="+$date_from.val()+"&date_to="+$date_to.val()+"&order=asc&limit=10&offset=0') }}"
		});
	
	/** Edit **/
	$(function () {
        $btn_edit.click(function () {
            var id = $.map($table.bootstrapTable('getSelections'), function(row) {
				return row.id
            });
           	//window.location.href= '{{ URL::to("purchase/edit") }}/'+id;
            $("#myModal").modal('show');
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

				var $get_confirm = confirm('ທ່ານຕ້ອງການລົບລ້າງລາຍການຈັດຊື້ນີ້ຫລືບໍ່?');
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

	/** Date fileter */
	$btn_date.click(function(e){
		e.preventDefault();
		$table.bootstrapTable('refresh', {
			url : "{{ URL::to('purchase/json?search=byDate&date_from="+$date_from.val()+"&date_to="+$date_to.val()+"&order=asc&limit=10&offset=0') }}"
		});
	});

	$btn_refresh.click(function(e){
		e.preventDefault();
		$date_from.val("{{ date('d-M-Y') }}");
		$date_to.val("{{ date('d-M-Y') }}");
		$table.bootstrapTable('refresh', {
			url : "{{ URL::to('purchase/json?search=byDate&date_from="+$date_from.val()+"&date_to="+$date_to.val()+"&order=asc&limit=10&offset=0') }}"
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
