@extends('layouts.app')
@section('title','Edit Data Mie')
@section('contents')
<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<h3 class="text-center">Edit Data Mie</h3>
		</div>
		<div class="col-sm-offset-4 col-sm-6" style="padding-bottom: 15px;padding-right: 0px;">
			<div class="pull-right">
				{!!Form::open(['route'=>['mie.destroy',$model->id],'method'=>'DELETE'])!!}
				<div class="btn-group">
					<a href="{{ route('mie.index') }}" class="btn btn-default" title="Back to List">Back</a>
					<button type="submit" class="btn btn-danger" title="Delete Data">Delete</button>
				</div>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
	<div class="row">
		{!!Form::model($model,['route'=>['mie.update',$model->id],'method'=>'PUT','class'=>'form-horizontal'])!!}
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