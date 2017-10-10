@extends('layouts.app')
@section('title','Report Orders')
@section('contents')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
			  <div class="panel-heading">
			  	Report of Orders
			  	<div class="pull-right">
		  			<button class="btn-link link-default" type="button" onclick="$('#reportOrder').submit()">
		  				<i class="glyphicon glyphicon-search"></i>
		  			</button>
			  	</div>
			  </div>
			  <div class="panel-body">
			  	<div class="col-sm-6 col-sm-offset-3">
				  	{!!Form::model($filter,['route' => ['reports.order'],'method'=>'GET','class'=>'form-horizontal','id'=>'reportOrder'])!!}
				  		<div class="form-group">
				  			{{Form::label('periode','Periode',['class'=>'control-label col-sm-4'])}}
						    <div class="col-sm-4">
						    	{{Form::select('periode',['all'=>'All','today'=>'Today','yesterday'=>'Yesterday','this_week'=>'This Week','this_month'=>'This Month','this_year'=>'This Year','custom'=>'Custom'],old('periode'),['class'=>'form-control','onchange'=>'onPriodeChange(this.value)'])}}
						    </div>
					  	</div>
					  	{{-- {{dd(old('periode'))}} --}}
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
				  			{{Form::label('from','Total Price Range',['class'=>'control-label col-sm-4'])}}
						    <div class="col-sm-4">
						    	{{Form::number('from_price',old('from_price'),['class'=>'form-control','placeholder'=>'From Price'])}}
						    </div>
						    <div class="col-sm-4">
						    	{{Form::number('to_price',old('to_price'),['class'=>'form-control','placeholder'=>'To Price'])}}
						    </div>
					  	</div>
				  		<div class="form-group">
						    <div class="col-sm-offset-4 col-sm-8">
								<label class="checkbox-inline">
									{{Form::checkbox('paid',true,old('paid'))}} Paid
								</label>
								<label class="checkbox-inline">
									{{Form::checkbox('cooked',true,old('cooked'))}} Cooked
								</label>
								<label class="checkbox-inline">
									{{Form::checkbox('all_status',true,old('all_status'))}} All
								</label>
						    </div>
					  	</div>
				  		<div class="form-group">
				  			{{Form::label('limit','Show',['class'=>'control-label col-sm-4'])}}
						    <div class="col-sm-4">
						    	{{Form::select('limit',['15'=>'15','25'=>'25','50'=>'50','100'=>'100'],old('limit'),['class'=>'form-control','onchange'=>"$('#reportOrder').trigger('submit')"])}}
						    </div>
					  	</div>
				  	{!!Form::close()!!}			  		
			  	</div>
				
				<div class="table-responsive">
					@if($list->count())
					<div class="col-sm-12">
						{!!Form::model($filter,['route'=>['reports.export.order','type'=>'xlsx']])!!}
							{{Form::hidden('periode',old('periode'))}}
							{{Form::hidden('from',old('from'))}}
							{{Form::hidden('to',old('to'))}}
							{{Form::hidden('from_price',old('from_price'))}}
							{{Form::hidden('to_price',old('to_price'))}}
							{{Form::hidden('paid',old('paid'))}}
							{{Form::hidden('all_status',old('all_status'))}}
							<button class="btn-link pull-right">Export</button>
						{!!Form::close()!!}						
					</div>
					@endif
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<td>Id</td>
								<td colspan="2">Pesanan</td>
								<td>Order Date</td>
								<td>Payment Method</td>
								<td>Type</td>
								<td>Total Price</td>
								<td>Status</td>
							</tr>
						</thead>
						<tbody>
						@forelse($list as $item)
							<tr>
								<td><a href="{{ route('drink.edit',['id'=>$item->id]) }}" class="link link-default">{{$item->id}}</a></td>
								<td colspan="2">
									<table style="width: 100%;">
										<tbody>
											@foreach($item->mies as $mie)
											<tr>
												<td>{{$mie->name}} (x{{$mie->quantity_mie}})</td>										
												<td class="text-right">{{$mie->price}}</td>										
											</tr>
											@endforeach
											@foreach($item->drinks as $drink)
											<tr>
												<td>{{$drink->name}} (x{{$drink->quantity}})</td>
												<td></td>								
											</tr>
											@endforeach
										</tbody>
									</table>
								</td>
								<td>{{\Carbon::parse($item->created_at)->format('d M Y h:i')}}</td>
								<td>{{ucwords($item->payment_method)}}</td>
								<td>{{(ucwords($item->dining_method))}}</td>
								<td>{{$item->total_price}}</td>
								<td>
									<span class="text-{{$item->paid?'success':'danger'}}">
										<i class="glyphicon glyphicon-{{$item->paid?'ok':'remove'}}-circle"></i> Paid
									</span>
									<span class="text-{{$item->cooked?'success':'danger'}}">
										<i class="glyphicon glyphicon-{{$item->cooked?'ok':'remove'}}-circle"></i> Cooked
									</span>
									 
								</td>
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
						</tbody>
					</table>
					{{$list->appends(\Request::input())->links()}}
				</div>
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