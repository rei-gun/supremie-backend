@extends('layouts.app')
@section('title','Report Drink')
@section('contents')
<div class="container">
	<div class="row">
		<div class="panel panel-default">
			<div class="panel-heading">Report Stock Out Drink</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<td>Id</td>
								<td>Brand - Flavour</td>
								<td>Stock</td>
								<td>Active</td>
								<td>Total Sale Out</td>
								<td>Updated At</td>
								<td>Last Order</td>
							</tr>
						</thead>
						<tbody>
							@forelse($list as $item)
								<tr>
									<td>
										<a href="{{ route('drink.edit',['id'=>$item->id]) }}" class="link link-default">{{$item->id}}</a>
									</td>
									<td>{{$item->brand_flavour}}</td>
									<td>{{$item->stock}}</td>
									<td>{{$item->active?'Active':'Inactive'}}</td>
									<td>{{$item->total_out}}</td>
									<td>
										{{\Carbon::parse($item->updated_at)->format('d M Y h:i')}}
									</td>
									<td>
										{{$item->last_order?\Carbon::parse($item->last_order)->format('d M Y h:i'):NULL}}
									</td>
								</tr>
								@empty
									<tr>
										<td colspan="7">
											<div class="alert alert-danger">
												<p class="text-center">No Record Found !</p>
											</div>
										</td>
									</tr>
							@endforelse
						</tbody>
					</table>
					{{$list->links()}}
				</div>				
			</div>
		</div>
	</div>
</div>
@endsection