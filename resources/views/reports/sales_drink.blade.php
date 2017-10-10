@extends('layouts.app')
@section('title','Report Sales Drink')
@section('contents')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
			  	Report of Sales Drink
			  	<div class="pull-right">			  		
		  			<button class="btn-link link-default" type="button" onclick="$('#reportSalesDrink').submit()">
		  				<i class="glyphicon glyphicon-search"></i>
		  			</button>
			  	</div>
			</div>
			<div class="panel-body">
				<div class="col-sm-6 col-sm-offset-3">
				  	{!!Form::model($filter,['route' => ['reports.sales_drink'],'method'=>'GET','class'=>'form-horizontal','id'=>'reportSalesDrink'])!!}
				  		<div class="form-group">
				  			{{Form::label('periode','Periode',['class'=>'control-label col-sm-4'])}}
						    <div class="col-sm-4">
						    	{{Form::select('periode',['all'=>'All','today'=>'Today','yesterday'=>'Yesterday','this_week'=>'This Week','this_month'=>'This Month','this_year'=>'This Year','custom'=>'Custom'],old('periode'),['class'=>'form-control','onchange'=>'onPriodeChange(this.value)'])}}
						    </div>
					  	</div>
				  		<div class="form-group" style="{{$filter['periode']!='custom'?'display: none;':''}}" id="custom_date">
				  			{{Form::label('from','Order Date',['class'=>'control-label col-sm-4'])}}
						    <div class="col-sm-4">
						    	{{Form::text('from',old('from'),['class'=>'form-control picker', 'disabled'=>$filter['periode']!='custom','placeholder'=>'From Date'])}}
						    </div>
						    <div class="col-sm-4">
						    	{{Form::text('to',old('to'),['class'=>'form-control picker', 'disabled'=>$filter['periode']!='custom','placeholder'=>'To Date'])}}
						    </div>
					  	</div>
				  		<div class="form-group">
				  			{{Form::label('limit','Show',['class'=>'control-label col-sm-4'])}}
						    <div class="col-sm-4">
						    	{{Form::select('limit',['15'=>'15','25'=>'25','50'=>'50','100'=>'100'],old('limit'),['class'=>'form-control','onchange'=>"$('#reportSalesDrink').trigger('submit')"])}}
						    </div>
					  	</div>
				  	{!!Form::close()!!}			  		
			  	</div>			
				<div class="table-responsive">
					@if($list->count())
					<div class="col-sm-12">
						{!!Form::model($filter,['route'=>['reports.export.sales_drink','type'=>'xlsx']])!!}
							{{Form::hidden('periode',old('periode'))}}
							{{Form::hidden('from',old('from'))}}
							{{Form::hidden('to',old('to'))}}
							<button class="btn-link pull-right">Export</button>
						{!!Form::close()!!}						
					</div>
					@endif
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<td>#</td>
								<td>OrderId</td>
								<td>Order Date</td>
								<td>DrinkId</td>
								<td>Name</td>
								<td>Qty</td>
								<td>Price</td>
							</tr>
						</thead>
						<tbody>
							@forelse($list as $item)
							<tr>
								<td>{{$loop->iteration+(($list->currentPage()-1)*$list->perPage())}}</td>
								<td>{{$item->order_id}}</td>
								<td>{{Carbon::parse($item->order->created_at)->format('d M Y h:i:s')}}</td>
								<td><a href="{{ route('drink.edit',['id'=>$item->drink_id]) }}" title="Details Drink">{{$item->drink_id}}</a></td>
								<td>{{$item->name}}</td>
								<td>{{$item->quantity}}</td>
								<td>{{$item->price}}</td>
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
					{{$list->appends(\Request::input())->links()}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@push('scripts')
<script>
	function onPriodeChange(val)
	{
		if(val!='custom')
		{
			if($('#custom_date').attr('display')===undefined)
			{
				$('#custom_date').hide();
				$('#custom_date .form-control').attr('disabled','');
			}
		}
		else
		{
			$('#custom_date').show();
			$('#custom_date .form-control').removeAttr('disabled');

		}
	}
</script>
@endpush