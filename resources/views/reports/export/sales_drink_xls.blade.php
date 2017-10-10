<html>
	<table>
		<thead>
			<tr>
		    	<td valign="middle" align="right" colspan="7">
		    		<h1 style="text-align: center;">Sales Drink Reports</h1>
	    		</td>	
			</tr>
			<tr>
		    	<td valign="middle" align="right" colspan="7">
		    		<h4 style="text-align: center;">Supremie Company</h4>
	    		</td>
			</tr>
			<tr>
		    	<td valign="middle" align="right" colspan="4">
		    		<h5 style="text-align: center;">{{$sub_title}}</h5>
	    		</td>
		    	<td valign="middle" align="right" colspan="3">
		    		<h5 style="text-align: center;">Date: {{Carbon::now()}}</h5>
	    		</td>
			</tr>
			<tr>
				<th valign="middle" align="center">No</th>
				<th valign="middle" align="center">OrderId</th>
				<th valign="middle" align="center">Order Date</th>
				<th valign="middle" align="center">DrinkId</th>
				<th valign="middle" align="center">Name</th>
				<th valign="middle" align="center">Quantity</th>
				<th valign="middle" align="center">Price</th>
			</tr>
		</thead>
		<tbody>
			@foreach($list as $item)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$item->order_id}}</td>
				<td>{{$item->order->created_at}}</td>	
				<td>{{$item->drink_id}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->quantity}}</td>		
				<td>{{$item->price}}</td>		
			</tr>
			@endforeach
		</tbody>
	</table>
	
	
    

</html>