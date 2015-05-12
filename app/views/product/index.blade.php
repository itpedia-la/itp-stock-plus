@include('layout.header')

    
    <div class="row">
		 <div class="col-md-12">
			<h3>@if(@$_GET['mode']=='stock_alert')ລາຍການ ສິນຄ້າ ແຈ້ງເຕືອນສິນຄ້າ@elseລາຍການ ສິນຄ້າ@endif</h3>
			
		<!-- <div class="alert alert-warning"><strong>Warning!</strong> Be very careful while deleting a product as this will delete all purchase and sale order of that product.</div> -->
		
		</div>
	</div>


	<div class="row">
    <div class="col-md-12 col-md-offset-0">

	<div id="toolbar">
            <div class="form-inline" role="form">
            	@if(@$_GET['mode']!='stock_alert')
            	 <a href="{{ URL::to('product/add') }}" class="btn btn btn-primary">ເພີ່ມລາຍການ ສິນຄ້າ</a>
            	 <button type="button" id="btn_edit" class="btn btn-default">ແກ້ໄຂ</button>
                <button type="button" id="btn_remove" class="btn btn btn-danger">ລົບລ້າງ</button>
                @endif
            </div>
        </div>
    <table id="table"
               data-toggle="table"
               @if(@$_GET['mode']=='stock_alert')
               data-url="{{ URL::to('product/json?mode=stock_alert') }}"
               data-search="false"
               @else
               data-url="{{ URL::to('product/json?mode=general') }}"
               data-search="true"
               @endif
               data-height="700"
               data-side-pagination="server"
               data-toolbar="#toolbar"
               data-pagination="true"
           	   data-page-size="20"
               data-page-list="[5, 10, 20, 50, 100, 200]"
               data-row-style="rowStyle"
               >
            <thead>
            <tr class="active">
            	<th data-field="state" data-checkbox="true"></th>
                <!--  <th data-field="image">ຮູບພາບ</th>-->
                <th data-field="category">ໝວດ</th>
                <th data-field="code">ລະຫັດ</th>
                <th data-field="description">ລາຍລະອຽດ</th>
                <th data-field="quality">ຈຳນວນຍັງເຫລືອ</th>
                <th data-field="unit">ຫົວໜ່ວຍ</th>
                <!--<th data-field="cost">ລາຄາຕົ້ນທຶນ</th>
                <th data-field="price">ລາຄາຂາຍ</th>  -->
               <th data-field="alert_quality">ຈຳນວນແຈ້ງເຕືອນ</th>
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

	/** Edit **/
	$(function () {
        $btn_edit.click(function () {
            var id = $.map($table.bootstrapTable('getSelections'), function(row) {
				return row.id
            });
           	window.location.href= '{{ URL::to("product/edit") }}/'+id;
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
						url : '{{ URL::to("product/remove") }}/'+ids,
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
