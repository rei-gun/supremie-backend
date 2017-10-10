@extends('layouts.app')
@section('title','Edit Data Topping')
@section('contents')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-center">Edit Data Topping</h3>
		</div>
		<div class="col-sm-offset-4 col-sm-6" style="padding-bottom: 15px;padding-right: 0px;">
			<div class="pull-right">
				{!!Form::open(['route'=>['topping.destroy',$model->id],'method'=>'DELETE'])!!}
				<div class="btn-group">
					<a href="{{ route('topping.index') }}" class="btn btn-default" title="Back to List">Back</a>
					<button type="submit" class="btn btn-danger" title="Delete Data">Delete</button>
				</div>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
	<div class="row">
		{!!Form::model($model,['route'=>['topping.update',$model->id],'method'=>'PUT','class'=>'form-horizontal'])!!}
		<div class="form-group{{ $errors->has('name')?' has-error':''}}">
			{{Form::label('name','Name',['class'=>'col-sm-4 control-label'])}}
			<div class="col-sm-6">
				{{Form::text('name',old('name'),['class'=>'form-control','placeholder'=>'Name*'])}}
				@if($errors->has('name'))
					<span class="help-block">
						<strong>{{ $errors->first('name') }}</strong>
					</span>
				@endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('stock')?' has-error':''}}">
			{{Form::label('stock','Stock',['class'=>'col-sm-4 control-label'])}}
			<div class="col-sm-6">
				{{Form::number('stock',old('stock'),['class'=>'form-control','placeholder'=>'Stock*'])}}
				@if($errors->has('stock'))
					<span class="help-block">
						<strong>{{ $errors->first('stock') }}</strong>
					</span>
				@endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('price')?' has-error':''}}">
			{{Form::label('price','Price',['class'=>'col-sm-4 control-label'])}}
			<div class="col-sm-6">
				{{Form::text('price',old('price'),['class'=>'form-control','placeholder'=>'Price*'])}}
				@if($errors->has('price'))
					<span class="help-block">
						<strong>{{ $errors->first('price') }}</strong>
					</span>
				@endif
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-6 col-sm-offset-4">
				<div class="checkbox">
					<label>
						{{Form::checkbox('active',true,old('active'))}}
						Active
					</label>
				</div>
			</div>	
		</div>
		<div class="form-group">
			<div class="col-sm-8 col-md-offset-4">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</div>
		{!!Form::close()!!}		
	</div>
	
</div>
@endsection