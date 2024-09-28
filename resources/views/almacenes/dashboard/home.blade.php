@extends("layouts.app")

@section('title') Dashboard | JSPacas. @endsection

@section('page_active') Dashboard @endsection 

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">  
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4>Bienvenido al Dashboard Almacen</h4>
                </div> 
            </div>
        </div>
    </div>


    <div class="row">
        @if (count($almacens) > 0)
        @foreach ($almacens as $item)
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-4">{{ $item->name }}</h4>
                    <div class="widget-chart-1">
                        <div class="widget-chart-box-1 float-start" dir="ltr">
                            <input data-plugin="knob" data-width="70" data-height="70" data-fgColor="#f05050 "
                                    data-bgColor="#F9B9B9" value="58"
                                    data-skin="tron" data-angleOffset="180" data-readOnly=true
                                    data-thickness=".15"/>
                        </div>
                        <div class="widget-detail-1 text-end">
                            <h2 class="fw-normal pt-2 mb-1"> $0 </h2>
                            <p class="text-muted mb-1">{{$item->products_count}} Productos</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else 
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body widget-user">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0 avatar-lg me-3">
                            <img src="../assets/images/users/user-3.jpg" class="img-fluid rounded-circle" alt="user">
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="mt-0 mb-1">Sin Elementos</h5>
                            <p class="text-muted mb-2 font-13 text-truncate">Aun no has registrado bodegas</p>
                            <small class="text-warning"><b>{{ Auth::user()->name }}</b></small>
                        </div>
                    </div>
                </div>   
            </div>
        </div><!-- end col -->
        @endif 
    </div>
</div>
@endsection