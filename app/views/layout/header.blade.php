 <!DOCTYPE html>
<html lang="en">
<head>
  <title>ITP Stock Plus</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Jquery -->
  <script src="{{ URL::to('packages/jquery.min.js') }}"></script>
  <!-- Bootstrap core -->
  <link rel="stylesheet" href="{{ URL::to('packages/bootstrap/css/bootstrap.min.css') }}">
  <script src="{{ URL::to('packages/bootstrap/js/bootstrap.js') }}"></script>
  <!-- Bootstrap date and time picker -->
  <link rel="stylesheet" href="{{ URL::to('packages/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
  <script src="{{ URL::to('packages/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
  <link rel="stylesheet" href="{{ URL::to('packages/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <script src="{{ URL::to('packages/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
  <!-- Boostrap Table -->
  <link rel="stylesheet" href="{{ URL::to('packages/bootstrap-table/dist/bootstrap-table.min.css') }}">
  <script src="{{ URL::to('packages/bootstrap-table/dist/bootstrap-table.min.js') }}"></script>
  <!-- Boostrap Typeheader -->
 <script src="{{ URL::to('packages/typeahead.js/dist/typeahead.bundle.js') }}"></script>

</head>
<style type="text/css">


* {
   font-size: 13px;
   line-height: 1;
}
.table tbody>tr>td.vert-align{
    vertical-align: middle;
}

.tt-query {
  -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
     -moz-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
          box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
}

.tt-hint {
  color: #999
}

.tt-menu {
  width: 200px;
  margin-top: 4px;
  padding: 4px 0;
  background-color: #fff;
  border: 1px solid #ccc;
  border: 1px solid rgba(0, 0, 0, 0.2);
  -webkit-border-radius: 4px;
     -moz-border-radius: 4px;
          border-radius: 4px;
  -webkit-box-shadow: 0 5px 10px rgba(0,0,0,.2);
     -moz-box-shadow: 0 5px 10px rgba(0,0,0,.2);
          box-shadow: 0 5px 10px rgba(0,0,0,.2);
}

.tt-suggestion {
  padding: 3px 20px;
  line-height: 24px;

}

.tt-suggestion:hover {
 background:#337AB7;
 color:#fff;
}

.tt-suggestion.tt-cursor {
  color: #fff;
  background-color: #0097cf;

}

.tt-suggestion p {
  margin: 0;
}

/** Customize Navbar **/
.navbar-custom {
  background-color: #005186;
  border-color: #003d65;
}
.navbar-custom .navbar-brand {
  color: #ffffff;
}
.navbar-custom .navbar-brand:hover,
.navbar-custom .navbar-brand:focus {
  color: #e6e6e6;
  background-color: transparent;
}
.navbar-custom .navbar-text {
  color: #ffffff;
}
.navbar-custom .navbar-nav > li:last-child > a {
  border-right: 1px solid #003d65;
}
.navbar-custom .navbar-nav > li > a {
  color: #ffffff;
  border-left: 1px solid #003d65;
}
.navbar-custom .navbar-nav > li > a:hover,
.navbar-custom .navbar-nav > li > a:focus {
  color: #c0c0c0;
  background-color: transparent;
}
.navbar-custom .navbar-nav > .active > a,
.navbar-custom .navbar-nav > .active > a:hover,
.navbar-custom .navbar-nav > .active > a:focus {
  color: #c0c0c0;
  background-color: #003d65;
}
.navbar-custom .navbar-nav > .disabled > a,
.navbar-custom .navbar-nav > .disabled > a:hover,
.navbar-custom .navbar-nav > .disabled > a:focus {
  color: #cccccc;
  background-color: transparent;
}
.navbar-custom .navbar-toggle {
  border-color: #dddddd;
}
.navbar-custom .navbar-toggle:hover,
.navbar-custom .navbar-toggle:focus {
  background-color: #dddddd;
}
.navbar-custom .navbar-toggle .icon-bar {
  background-color: #cccccc;
}
.navbar-custom .navbar-collapse,
.navbar-custom .navbar-form {
  border-color: #003b62;
}
.navbar-custom .navbar-nav > .dropdown > a:hover .caret,
.navbar-custom .navbar-nav > .dropdown > a:focus .caret {
  border-top-color: #c0c0c0;
  border-bottom-color: #c0c0c0;
}
.navbar-custom .navbar-nav > .open > a,
.navbar-custom .navbar-nav > .open > a:hover,
.navbar-custom .navbar-nav > .open > a:focus {
  background-color: #003d65;
  color: #c0c0c0;
}
.navbar-custom .navbar-nav > .open > a .caret,
.navbar-custom .navbar-nav > .open > a:hover .caret,
.navbar-custom .navbar-nav > .open > a:focus .caret {
  border-top-color: #c0c0c0;
  border-bottom-color: #c0c0c0;
}
.navbar-custom .navbar-nav > .dropdown > a .caret {
  border-top-color: #ffffff;
  border-bottom-color: #ffffff;
}
@media (max-width: 767) {
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a {
    color: #ffffff;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > li > a:focus {
    color: #c0c0c0;
    background-color: transparent;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a,
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > .active > a:focus {
    color: #c0c0c0;
    background-color: #003d65;
  }
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a,
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:hover,
  .navbar-custom .navbar-nav .open .dropdown-menu > .disabled > a:focus {
    color: #cccccc;
    background-color: transparent;
  }
}
.navbar-custom .navbar-link {
  color: #ffffff;
}
.navbar-custom .navbar-link:hover {
  color: #c0c0c0;
}
</style>
<body>

<div class="container">
	<img src="{{ URL::to('img/logo.png') }}">
	  <nav class="navbar navbar-custom">
  <div class="container-fluid">
    <!-- <div class="navbar-header">
      <a class="navbar-brand" href="#">ITP Stock Manager</a>
    </div> -->
    <div>
      <ul class="nav navbar-nav">
       <li ><a href="{{ URL::to('product') }}">ລາຍການສິນຄ້າ</a></li> 
       <li ><a href="{{ URL::to('purchase/') }}">ລາຍການ ສິນຄ້າເຂົ້າ</a></li> 
        <li ><a href="{{ URL::to('sale/') }}">ລາຍການ ສິນຄ້າອອກ</a></li> 
        <!--  <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ສິນຄ້າ
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="{{ URL::to('product/') }}">ລາຍການ ສິນຄ້າ</a></li>
            <li><a href="{{ URL::to('product/add') }}">ເພີ່ມລາຍການ ສິນຄ້າ</a></li>
          </ul>
        </li>
 		<li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ລາຍການ ສິນຄ້າເຂົ້າ
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
          	<li><a href="{{ URL::to('purchase/') }}">ລາຍການຈັດຊື້ ສິນຄ້າ</a></li>
            <li><a href="{{ URL::to('purchase/add') }}">ເພີ່ມລາຍການຈັດຊື້ ສິນຄ້າ</a></li>
          </ul>
        </li>
        
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ລາຍການ ສິນຄ້າອອກ
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
           
            <li><a href="{{ URL::to('sale/') }}">ລາຍການຂາຍ ສິນຄ້າ</a></li>
             <li><a href="{{ URL::to('sale/add') }}">ເພີ່ມລາຍການຂາຍ ສິນຄ້າ</a></li>
          </ul>
        </li>
       <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">ລາຍງານ
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{ URL::to('report/order/cancelled') }}">ລາຍງານ ການຍົກເລີກເມນູ</a></li>
          
          </ul>	-->
        </li> 

      	</ul>
      
      <ul class="nav navbar-nav navbar-right">
      	<li><a href="{{ URL::to('product?mode=stock_alert') }}">ແຈ້ງເຕືອນສິນຄ້າ <span class="label label-danger">{{ Product::stock_alert() }}</span></a></li>
       <!--   <li><a href="#"><span class="glyphicon glyphicon-user"></span> Logout</a></li>-->
      </ul>
      
    </div>
  </div>
</nav>
</div>

<div class="container">