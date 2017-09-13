@extends('layouts.app')

@section('content')
<div class="container">
	@if(null!==(session('message')))
		<div class="alert alert-success">
		{{session('message')}}
		</div>
	@endif
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<form method="POST">
		<h2> {{$user->name}}</h2>
		<div class="panel panel-default">
			<div class="panel-heading">Characteristics</div>
			<div class="panel-body">
				<div class="row well-sm">
					<div class="col-md-12">ID: {{$user->id}}</div>
				</div>
				<div class="row well-sm">
					<div class="col-md-12">Status: <font color="@if($user->status=='manager') red @else black @endif">{{$user->status}}</font></div>
				</div>
				<div class="row well-sm">
					<div class="col-md-12">Salary: @if($user->salary==1)Job wage @else Time-based @endif {{$user->countSalary($user->salary)}} Rub.</div>
				</div>
				<div class="row well-sm">
					<div class="col-md-12">Email: {{$user->email}}</div>
				</div>
				<div class="form-inline well-sm">
					Phone: <input class="form-control" size="15" width="15" type="text" name="phone" value="{{$user->phone}}"/>
				</div>
				<div class="form-group well-sm">
					About: <textarea class="form-control" rows="4" name="about" id="editor">{{$user->about}}</textarea>
				</div>
			</div>
		</div>

		@if(count($user->employees)>0)
		<div class="panel panel-default">
			<div class="panel-heading">Employees</div>
			<div class="panel-body">
				<table class="table">
					<tr>
						<td><b>ID</b></td>
						<td><b>Name</b></td>
						<td><b>Status</b></td>
						<td><b>Salary</b></td>
						<td><b>Email</b></td>
						<td><i class="fa fa-remove"></td>
					</tr>
					@foreach($user->employees as $employee)
						<tr>
							<td>{{$employee->id}}</td>
							<td><a href="{{url('')}}/{{$employee->status}}/{{$employee->id}}">{{$employee->name}} <i class="fa fa-sign-in"></i></a></td>
							<td>{{$employee->status}}</td>
							<td>@if($employee->salary==1)Job wage @else Time-based @endif {{$user->countSalary($employee->salary)}} Rub.</td>
							<td>{{$employee->email}}</td>
							<td><input type="checkbox" id="" name="detach[]" value="{{$employee->id}}"></td>
						</tr>
					@endforeach
				</table>
			</div>
		</div>
		@endif

		@if(count($user->submanagers)>0)
			<div class="panel panel-default">
				<div class="panel-heading">Submanagers</div>
				<div class="panel-body">
					<table class="table">
						<tr>
							<td><b>ID</b></td>
							<td><b>Name</b></td>
							<td><b>Status</b></td>
							<td><b>Salary</b></td>
							<td><b>Email</b></td>
							<td><i class="fa fa-remove"></td>
						</tr>
						@foreach($user->submanagers as $submanager)
							<tr>
								<td>{{$submanager->id}}</td>
								<td><a href="{{url('')}}/{{$submanager->status}}/{{$submanager->id}}">{{$submanager->name}} <i class="fa fa-sign-in"></i></a></td>
								<td>{{$submanager->status}}</td>
								<td>@if($submanager->salary==1)Job wage @else Time-based @endif {{$user->countSalary($submanager->salary)}} Rub.</td>
								<td>{{$submanager->email}}</td>
								<td><input type="checkbox" id="" name="detach[]" value="{{$submanager->id}}"></td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		@endif

		<div class="row">
			<div class="col-md-4">
				<button class="btn btn-default btn-lg" type="submit">Update</button>
			</div>
		</div>
		<br />

		<input type="hidden" value="{!! csrf_token() !!}" name="_token">
	</form>
</div>
@endsection
