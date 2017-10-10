@extends('layouts.app')
@section('title','Add Data Drink')
@section('contents')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-center">Tambah Data Drink</h3>
		</div>		
	</div>
	<div class="row">
		{!!Form::open(['route'=>'drink.store','class'=>'form-horizontal'])!!}
		<div class="form-group{{ $errors->has('brand')?' has-error':''}}">
			{{Form::label('brand','Brand',['class'=>'col-sm-4 control-label'])}}
			<div class="col-sm-6">
				{{Form::text('brand',old('brand'),['class'=>'form-control','placeholder'=>'Brand*'])}}
				@if($errors->has('brand'))
					<span class="help-block">
						<strong>{{ $errors->first('brand') }}</strong>
					</span>
				@endif
			</div>
		</div>
		<div class="form-group{{ $errors->has('flavour')?' has-error':''}}">
			{{Form::label('flavour','Flavour',['class'=>'col-sm-4 control-label'])}}
			<div class="col-sm-6">
				{{Form::text('flavour',old('flavour'),['class'=>'form-control','placeholder'=>'Flavour*'])}}
				@if($errors->has('flavour'))
					<span class="help-block">
						<strong>{{ $errors->first('flavour') }}</strong>
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
					<a href="{{ route('drink.index') }}" title="Back to List" class="btn btn-default">Back</a>
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</div>
		</div>
		{!!Form::close()!!}		
	</div>
</div>
@endsection