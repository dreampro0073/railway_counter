<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
	<style type="text/css">
		@page { margin: 5px; }
		body { margin: 5px; }
		.main{
			/*width: 200px;*/
		}
		h4{
			
			font-size: 14px;
		}
		h4,h5,p{
			text-align: center;
			margin: 0;
		}
		.m-space{
			margin: 4px 0;
		}
		.table-div{
			display: table;
			/*width: 200px;*/
		}
		.table-div > div{
			display: table-cell;
			vertical-align: middle;
			/*border: 1px solid #000;*/
			padding: 2px;
		}
		.w-50{
			width: 50%;
		}
		.w-16{
			width: 16.66%;
		}
		td,span,p{
			font-size: 12px;
		}
		.text-right{
			text-align: right;
		}
		.name{
			text-align: left;
		}
	</style>
</head>
<body>
	<div class="main" id="printableArea">
		<h4>
			M/s New Nabaratna Hospitality Pvt. Ltd.
		</h4>
		<p class="m-space">
			AC Executive Lounge, Guwahati Railway Station, PF No. 1
		</p>
		<h5>
			GSTIN: 18AAICN4763E1ZA
		</h5>
		<div class="table-div">
			<div class="w-50">
				<span class="text">Bill No: 212112</span>
			</div>
			<div class="w-50 text-right">
				<span class="text">Date: <?php echo date("d-m-Y"); ?></span>
			</div>
		</div>
		<span class="name">Name : {{$print_data->name}}</span>
		<div class="table-div">
			<div class="w-50">
				<span class="text">PNR/ID No.: {{$print_data->pnr_uid}}</span>
			</div>
			<div class="w-50">
				<span class="text">Mob: {{$print_data->mobile_no}}</span>
			</div>
		</div>
		<div class="table-div" style="margin-bottom: 20px;">
			<div class="w-50">
				<span class="text">In Time: {{$print_data->check_in}}</span>
			</div>
			<div class="w-50">
				<span class="text">Out Time: {{$print_data->check_out}}</span>
			</div>
		</div>
		<table style="width:100%;margin: -1;" border="1" cellpadding="4" cellspacing="0" >
			<tr>
				<td class="w-50">Description</td>
				<td class="w-16">Fee Type</td>
				<td class="w-16">Quantity</td>
				<td class="w-16">Amount</td>
			</tr>
			<tr>
				<td class="w-50">For First hours or part there of</td>
				<td class="w-16">Adult 30/- Perpersal</td>
				<td class="w-16">{{$print_data->no_of_adults}}</td>
				<td class="w-16">{{$print_data->adult_first_hour_amount}}</td>
			</tr>
			<tr>
				<td class="w-50">Per Exterded hours or part there of</td>
				<td class="w-16">Adult 20/- Perpersal</td>
				<td class="w-16">{{$print_data->no_of_adults}}</td>
				<td class="w-16">{{$print_data->adult_other_hour_amount}}</td>
			</tr>
			<tr>
				<td class="w-50">1st hours of part there of</td>
				<td class="w-16">Age 5 to 12, 20/ Perchilores</td>
				<td class="w-16">{{$print_data->no_of_children}}</td>
				<td class="w-16">{{$print_data->children_first_hour_amount}}</td>
			</tr>
			<tr>
				<td class="w-50">Per Exterded hours or part there of</td>
				<td class="w-16">Age 5 to 12, 10/ Perchilores</td>
				<td class="w-16">{{$print_data->no_of_children}}</td>
				<td class="w-16">{{$print_data->children_other_hour_amount}}</td>
			</tr>
			<tr>
				<td class="w-50">Age Below5 Years</td>
				<td class="w-16">Free</td>
				<td class="w-16">{{$print_data->no_of_baby_staff}}</td>
				<td class="w-16">--</td>
			</tr>
			<tr>
				<td class="w-50"><b>Total</b></td>
				<td class="w-16"></td>
				<td class="w-16">{{$print_data->total_member}}</td>
				<td class="w-16">{{$print_data->paid_amount}}</td>
			</tr>
		</table>
		<div style="margin-top: 20px;text-align: right;">
			<span style="text-align:right;font-weight: bold;">E.&.O.E</span>
		</div>
		<div style="margin-top:50px;text-align:center;">
			<p>
				<b>*Note : Passengers must protect their own Mobile and luggage.</b>
			</p>
		</div>
		
	</div>
</body>
</html>