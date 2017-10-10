@extends('layouts.app')
@section('title','Add Data Topping')
@section('contents')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-center">Tambah Data Topping</h3>
		</div>		
	</div>
	<div class="row">
		{!!Form::open(['route'=>'topping.store','class'=>'form-horizontal'])!!}
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
			<div class="col-sm-8 col-md-offset-4">
				<div class="btn-group">
					<a href="{{ route('topping.index') }}" title="Back to List" class="btn btn-default">Back</a>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
		{!!Form::close()!!}		
	</div>
</div>
@endsection