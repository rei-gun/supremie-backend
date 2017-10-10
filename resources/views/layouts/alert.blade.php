@if(Session::get('success'))
	@component('alerts.success')
		<strong>Success!</strong> {!!Session::get('success')!!}
	@endcomponent
@endif
@if(Session::get('error'))
	@component('alerts.danger')
		<strong>Whooops!</strong> {!!Session::get('error')!!}
	@endcomponent
@endif