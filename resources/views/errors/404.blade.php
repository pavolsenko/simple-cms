@extends('layouts/default')

@section('content')

    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="section-heading text-center">
                    <h4 class="small section-title"><span>Error 404</span></h4>
                    <h1 class="large section-title">Page not found</h1>
                </div>
            </div>

            <div class="col-md-8 col-md-offset-2">
                Sorry. The page you are looking for was not found. Please check the URL or try some of the options bellow.
                <br><br>
                <div class="text-center">
                    <a href="/" class="btn btn-success">Go back to homepage</a><br><br>
                    <a href="{{ URL::route('blog') }}" class="btn btn-info">Go to blog homepage</a><br><br>
                    <a href="{{ URL::route('contact') }}" class="btn btn-warning">Go to contact form</a>
                </div>
                <br><br><br><br><br>
                <br><br><br><br><br>
            </div>
        </div>
    </div>

@stop