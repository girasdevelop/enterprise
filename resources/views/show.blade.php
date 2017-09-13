@extends('layouts.app')

@section('content')
<div class="container">
	@if(null!==(session('message')))
		<div class="alert alert-success">
			{{session('message')}}
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
					<div class="col-md-3">
						Salary: @if($user->salary==1)Job wage @else Time-based @endif {{$user->countSalary($user->salary)}} Rub / Month
					</div>
					@can('edit')
						@if(($user->parent_id==NULL || Auth::user()->id==$user->parent_id) && Auth::user()->id!=$user->id && Auth::user()->parent_id!=$user->id)
							<div class="col-md-9">
								<select class="" name="salary">
									<option value="1" @if($user->salary==1) selected @endif >Job wage</option>
									<option value="2" @if($user->salary==2) selected @endif >Time-based</option>
								</select>
							</div>
						@endif
					@endcan
				</div>

				<div class="row well-sm">
					<div class="col-md-12">Email: {{$user->email}}</div>
				</div>

				@if($user->phone!=NULL && $user->phone!='')
				<div class="row well-sm">
					<div class="col-md-12">Phone: {{$user->phone}}</div>
				</div>
				@endif

				@if($user->about!=NULL && $user->about!='')
				<div class="row well-sm">
					<div class="col-md-12">About: {{$user->about}}</div>
				</div>
				@endif

				@can('attachment')
					@if(($user->parent_id==NULL || Auth::user()->id==$user->parent_id) && Auth::user()->id!=$user->id && Auth::user()->parent_id!=$user->id)
						<div class="row well-sm">
							<div class="col-md-12"><input type="checkbox" id="" name="attach[]" value="{{$user->id}}" @if(Auth::user()->id==$user->parent_id) checked disabled @endif > - Attache</div>
							<div class="col-md-12"><input type="checkbox" id="" name="detach[]" value="{{$user->id}}" @if(Auth::user()->id!=$user->parent_id) disabled @endif > - Detach</div>
						</div>

					@else
						<div class="row well-sm">
							<div class="col-md-12">Available for attachment</div>
						</div>
					@endif
				@endcan

				@can('edit')
					<div class="row well-sm">
						<div class="col-md-12"><button class="btn btn-default btn-lg" type="submit">Update</button></div>
					</div>
				@endcan

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
						<td><b>Phone</b></td>
					</tr>
					@foreach($user->employees as $employee)
						<tr>
							<td>{{$employee->id}}</td>
							<td><a href="{{url('')}}/{{$employee->status}}/{{$employee->id}}">{{$employee->name}} <i class="fa fa-sign-in"></i></a></td>
							<td>{{$employee->status}}</td>
							<td>@if($employee->salary==1)Job wage @else Time-based @endif {{$user->countSalary($employee->salary)}} Rub.</td>
							<td>{{$employee->email}}</td>
							<td>
								@if($employee->phone!=NULL && $employee->phone!='')
									{{$employee->phone}}
								@else
									No phone
								@endif
							</td>
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
							<td><b>Phone</b></td>
						</tr>
						@foreach($user->submanagers as $submanager)
							<tr>
								<td>{{$submanager->id}}</td>
								<td><a href="{{url('')}}/{{$submanager->status}}/{{$submanager->id}}">{{$submanager->name}} <i class="fa fa-sign-in"></i></a></td>
								<td>{{$submanager->status}}</td>
								<td>@if($submanager->salary==1)Job wage @else Time-based @endif {{$user->countSalary($submanager->salary)}} Rub.</td>
								<td>{{$submanager->email}}</td>
								<td>
									@if($submanager->phone!=NULL && $submanager->phone!='')
										{{$submanager->phone}}
									@else
										No phone
									@endif
								</td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		@endif

		<input type="hidden" value="{!! csrf_token() !!}" name="_token">
	</form>
</div>
@endsection
