@extends('layouts.app')
@section('title','Drink List')
@section('contents')
	<div class="container">
		<div class="row">
			<h3>Stock Drink List</h3>
			<div class="col-xs-12" style="padding: 0px">
				<a href="{{route('drink.create')}}" title="Add Data" class="link link-default">
					Add Data
				</a>
			</div>
			<div class="table-responsive">
				<table class="table table-hover table-bordered">
					<thead>
						<tr>
							<td>Id</td>
							<td>Brand - Flavour</td>
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
							<td><a href="{{ route('drink.edit',['id'=>$item->id]) }}" class="link link-default">{{$item->id}}</a></td>
							<td>{{$item->brand.' - '.$item->flavour}}</td>
							<td>{{$item->stock}}</td>
							<td>{{$item->price}}</td>
							<td>{{$item->active?'Active':'Inactive'}}</td>
							<td>{{\Carbon::parse($item->updated_at)->format('d M Y h:i')}}</td>
							<td>-</td>
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
			</div>
		</div>
		<div class="row">
			{{$list->links()}}
		</div>
	</div>
@endsection