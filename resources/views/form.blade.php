@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">URL Shortener</div>

                <div class="card-body">
                     @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <p><strong>Opps Something went wrong</strong></p>
                            <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="post" action="{{ route('saveUrl') }}">
                        @csrf
                        <label for="url" class="form-label">URL to shorten</label>
                        <input type="text" class="form-control" name="destination" id="url" placeholder="http://example.ex">
                        <button type="submit" class="btn btn-primary mb-3 mt-3">Shorten URL</button>
                    </form>    
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Latest URLs</div>

                <div class="card-body">
                   <table class="table">
                    <tr>
                        <th>Slug</th>
                        <th>URL</th>
                        <th>Created At</th>
                    </tr>
                    
                        @foreach ($links as $link)
                           <tr>
                               <td><a href="{{$link->destination}}">{{$link->shortUrl}}</a></td>
                               <td><a href="{{$link->destination}}">{{$link->destination}}</a></td>
                               <td>{{$link->created_at}}</td>
                           </tr> 
                        @endforeach
                        
                    
                       
                   </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
