@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Welcome</div>

                <div class="panel-body">
                    <div class="row">
                                 <div class="col-md-4">
					              <a href="/MyFavouriteAppliances/importdishwasher" class="btn btn-info" role="button">Import Dishwasher Products</a>
								 </div>
                                 <div class="col-md-4">
					              <a href="/MyFavouriteAppliances/importsmallappliances" class="btn btn-info" role="button">Import Small Appliances</a>
								 </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
