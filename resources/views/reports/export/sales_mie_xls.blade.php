<html>
	<table>
		<thead>
			<tr>
		    	<td valign="middle" align="right" colspan="9">
		    		<h1 style="text-align: center;">Sales Mie Reports</h1>
	    		</td>	
			</tr>
			<tr>
		    	<td valign="middle" align="right" colspan="9">
		    		<h4 style="text-align: center;">Supremie Company</h4>
	    		</td>
			</tr>
			<tr>
		    	<td valign="middle" align="right" colspan="5">
		    		<h5 style="text-align: center;">{{$sub_title}}</h5>
	    		</td>
		    	<td valign="middle" align="right" colspan="4">
		    		<h5 style="text-align: center;">Date: {{Carbon::now()}}</h5>
	    		</td>
			</tr>
			<tr>
				<th valign="middle" align="center">No</th>
				<th valign="middle" align="center">OrderId</th>
				<th valign="middle" align="center">Order Date</th>
				<th valign="middle" align="center">MieId</th>
				<th valign="middle" align="center">Name</th>
				<th valign="middle" align="center">Extra Chili</th>
				<th valign="middle" align="center">Quantity</th>
				<th valign="middle" align="center">Price</th>
				<th valign="middle" align="center">Note</th>
			</tr>
		</thead>
		<tbody>
			@foreach($list as $item)
			<tr>
				<td>{{$loop->iteration}}</td>
				<td>{{$item->order_id}}</td>
				<td>{{$item->order->created_at}}</td>
				<td>{{$item->mie_id}}</td>
				<td>{{$item->name}}</td>
				<td>{{$item->extra_chili}}</td>
				<td>{{$item->quantity_mie}}</td>			
				<td>{{$item->price}}</td>			
				<td>{{$item->note}}</td>			
			</tr>
			@endforeach
		</tbody>
	</table>
	
	
    

</html>