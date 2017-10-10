<html>
	<table>
		<thead>
			<tr>
		    	<td valign="middle" align="right" colspan="10">
		    		<h1 style="text-align: center;">Order Reports</h1>
	    		</td>	
			</tr>
			<tr>
		    	<td valign="middle" align="right" colspan="10">
		    		<h4 style="text-align: center;">Supremie Company</h4>
	    		</td>
			</tr>
			<tr>
		    	<td valign="middle" align="right" colspan="5">
		    		<h5 style="text-align: center;">{{$sub_title}}</h5>
	    		</td>
		    	<td valign="middle" align="right" colspan="5">
		    		<h5 style="text-align: center;">Date: {{Carbon::now()}}</h5>
	    		</td>
			</tr>
			<tr>
				<th valign="middle" align="center">No</th>
				<th valign="middle" align="center">Id</th>
				<th valign="middle" align="center">Food Order</th>
				<th valign="middle" align="center">Drink Order</th>
				<th valign="middle" align="center">Order Date</th>
				<th valign="middle" align="center">Payment Method</th>
				<th valign="middle" align="center">Type</th>
				<th valign="middle" align="center">Total Price</th>
				<th valign="middle" align="center">Paid</th>
				<th valign="middle" align="center">Cooked</th>
			</tr>
		</thead>
		<tbody>
			@foreach($list as $item)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$item->id}}</td>
				<td>
					{{$item->mies->count()}}
				</td>
				<td>
					{{$item->drinks->count()}}
				</td>
				<td>{{$item->created_at}}</td>
				<td>{{ucwords($item->payment_method)}}</td>
				<td>{{ucwords($item->dining_method)}}</td>
				<td>{{$item->total_price}}</td>
				<td>{{$item->paid?'true':'false'}}</td>
				<td>{{$item->cooked?'true':'false'}}</td>				
			</tr>
			@endforeach
		</tbody>
	</table>
	
	
    

</html>