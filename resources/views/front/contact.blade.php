@extends('layouts.master')

@section('content')
<div class="row">
	<h1 class="mb-2 text-center">Contact Us</h1>
	
	@if(session('message'))
	<div class='alert alert-success'>
		{{ session('message') }}
	</div>
	@endif
	
    <div class="col-12 col-md-3"></div>
        <div class="col-12 col-md-6">
            <form class="form-horizontal" method="POST" action="/contact">
                {{ csrf_field() }} 

                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="text" class="form-control" id="email" placeholder="john@example.com" name="email" value="{{old('email')}}"required>
                    @if($errors->has('email'))<span class="error" style="color : red;">{{$errors->first('email')}}</span>@endif
                </div>

                <div class="form-group">
                    <label for="message">message: </label>
                    <textarea type="text" class="form-control luna-message" id="message" placeholder="Type your messages here" name="message" required>{{old('message')}}</textarea>
                    @if($errors->has('message'))<span class="error" style="color : red;">{{$errors->first('message')}}</span>@endif
                </div>

                <div class="form-group text-right">
                    <button type="submit" class="btn btn-primary" value="Send">Send</button>
                </div>
            </form>
        </div>
 </div> <!-- /container -->
@endsection