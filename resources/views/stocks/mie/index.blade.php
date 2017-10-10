@extends('layouts.app')
@section('title','Mie List')
@section('contents')
	<div class="container">
		<div class="row">
			<h3>Stock Mie List</h3>
			<div class="col-xs-12" style="padding: 0px">
				<a href="{{route('mie.create')}}" title="Add Data" class="link link-default">
					Add Data
				</a>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<td>Id</td>
							<td>Brand</td>
							<td>Flavour</td>
							<td>Stock</td>
							<td>Price</td>
							<td>Active</td>
							<td>Updated At</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
					@forelse($list as $item)
						<tr>
							<td><a href="{{ route('mie.edit',['id'=>$item->id]) }}" class="link link-default">{{$item->id}}</a></td>
							<td>{{$item->brand}}</td>
							<td>{{$item->flavour}}</td>
							<td>{{$item->stock}}</td>
							<td>{{$item->price}}</td>
							<td>{{$item->active?'Active':'Inactive'}}</td>
							<td>{{\Carbon::parse($item->updated_at)->format('d M Y h:i')}}</td>
							<td>-</td>
						</tr>
						@empty
							<tr>
								<td colspan="8">
									<div class="alert alert-danger">
										<p class="text-center">No Record Found !</p>
									</div>
								</td>
							</tr>
					@endforelse
					</tbody>`					
				</table>
			</div>
		</div>
		<div class="row">
			{{$list->links()}}
		</div>
	</div>
@endsection