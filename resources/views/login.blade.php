@extends('layout')


@section('main')

<div style="height: 100vh;display: flex;align-content: center;justify-content:center;">
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-6 login-box">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                    </div>
                                    {{ Form::open(array('url' => '/login','class' => 'user',"method"=>"POST")) }}

                                        @if(Session::has('failure'))
                                            <div class="alert alert-danger" style="margin-top: 10px;">
                                                <i class="fa fa-ban-circle"></i><strong>Failure!</strong> {{Session::get('failure')}}
                                            </div>
                                        @endif

                                        @if(Session::has('success'))
                                            <div class="alert alert-success">
                                               <i class="fa fa-ban-circle"></i><strong>success!</strong> {{Session::get('success')}}
                                             </div>    
                                        @endif

                                    
                                        <div class="form-group">
                                            
                                            {{Form::text('email','',["class"=>"form-control form-control-user","id"=>"exampleInputEmail","autocomplete"=>"off","placeholder"=>"Enter Email Address..."])}}
                                            <span class="error">{{$errors->first('email')}}</span>
                                            
                                        </div>
                                        <div class="form-group">
                                           
                                            {{Form::password('password',["class"=>"form-control form-control-user","required"=>"true","id"=>"exampleInputPassword","placeholder"=>"Password"])}}
                                        </div>
                                       
                                       
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>
                                        <hr>
                                       
                                    {{Form::close()}}
                                    
                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>


@endsection