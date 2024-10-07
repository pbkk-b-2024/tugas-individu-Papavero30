@extends('TemplateLayout')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-12">
            <h4>Dashboard</h4>
            @role('admin')
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-users fa-3x mb-3"></i>
                            <h5 class="card-title">Registered Customers</h5>
                            <p class="card-text">{{ $data['customerCount'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-box fa-3x mb-3"></i>
                            <h5 class="card-title">Products Created</h5>
                            <p class="card-text">{{ $data['productCount'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-star fa-3x mb-3"></i>
                            <h5 class="card-title">Average Rating</h5>
                            <p class="card-text">{{ number_format($data['averageRating'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endrole

            @role('customer')
            <div class="row">
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                            <h5 class="card-title">Orders Placed</h5>
                            <p class="card-text">{{ $data['orderCount'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-comments fa-3x mb-3"></i>
                            <h5 class="card-title">Feedback Given</h5>
                            <p class="card-text">{{ $data['feedbackCount'] }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center">
                        <div class="card-body">
                            <i class="fas fa-thumbs-up fa-3x mb-3"></i>
                            <h5 class="card-title">Recommendations Given</h5>
                            <p class="card-text">{{ $data['recommendationCount'] }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
        </div>
    </div>
</div>
@endsection