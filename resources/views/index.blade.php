@extends('layouts.app')

@section('content')
	<div class="container">
		<h1><small>User list</small></h1>
		<div class="row">
			<table class="table table-bordered">
				<tr class="warning">
					<td><b>ID</b></td>
					<td><b>Name</b></td>
					<td><b>Status</b></td>
					<td><b>Salary</b></td>
					<td><b>Dependent users</b></td>
				</tr>
				@foreach($users as $user)
				<tr @if($user->status=='manager')class="active"@endif >
					<td>{{$user->id}}</td>
					<td><a href="{{url('')}}/{{$user->status}}/{{$user->id}}">{{$user->name}} <i class="fa fa-sign-in"></i></a></td>
					<td><font color="@if($user->status=='manager') red @else black @endif">{{$user->status}}</font></td>
					<td>@if($user->salary==1)Job wage @else Time-based @endif {{$user->countSalary($user->salary)}} Rub.</td>
					<td>
						@if(count($user->employees)>0)
							<table class="table table-bordered">
								<tr class="warning">
									<td><b>ID</b></td>
									<td><b>Name</b></td>
									<td><b>Status</b></td>
									<td><b>Salary</b></td>
								</tr>
								@foreach($user->employees as $employee)
								<tr>
									<td>{{$employee->id}}</td>
									<td><a href="{{url('')}}/{{$employee->status}}/{{$employee->id}}">{{$employee->name}} <i class="fa fa-sign-in"></i></a></td>
									<td><font color="black">{{$employee->status}}</font></td>
									<td>@if($employee->salary==1)Job wage @else Time-based @endif {{$employee->countSalary($employee->salary)}} Rub.</td>
								</tr>
								@endforeach
							</table>
						@endif

						@if(count($user->submanagers)>0)
							<table class="table table-bordered">
								<tr class="warning">
									<td><b>ID</b></td>
									<td><b>Name</b></td>
									<td><b>Status</b></td>
									<td><b>Salary</b></td>
								</tr>
								@foreach($user->submanagers as $submanager)
									<tr>
										<td>{{$submanager->id}}</td>
										<td><a href="{{url('')}}/{{$submanager->status}}/{{$submanager->id}}">{{$submanager->name}} <i class="fa fa-sign-in"></i></a></td>
										<td><font color="red">{{$submanager->status}}</font></td>
										<td>@if($submanager->salary==1)Job wage @else Time-based @endif {{$submanager->countSalary($submanager->salary)}} Rub.</td>
									</tr>
								@endforeach
							</table>
						@endif

						@if(count($user->employees)==0 && count($user->submanagers)==0)
							No dependent
						@endif

					</td>
				</tr>
				@endforeach
			</table>
		</div>
		{!! $users->render() !!}
	</div>
@endsection
