@extends("layouts.app")

@section('title') Dashboard | JSPacas. @endsection

@section('page_active') Dashboard @endsection 

@section('content')
<!-- Start Content-->
<div class="container-fluid">
    @if (Auth::user()->role == 0 || Auth::user()->role == 1)
    <div class="row">  
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <h4>Bienvenido al Dashboard Almacen</h4>
                </div>
            </div>
        </div>
    </div>
    @elseif(Auth::user()->role == 2)
    <div class="row">
        <div class="col-xl-6 col-md-6 m-auto">
            <div class="card">
                <div class="card-body widget-user">
                    <div class="d-flex align-items-center">
                        <div class="avatar-lg me-3 flex-shrink-0">
                            <img src="{{ asset('assets/images/logo-sm-dark.png') }}" class="img-fluid rounded-circle" alt="user">
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <h5 class="mt-0 mb-1">
                                Bienvenido(a) {{ strtoupper(Auth::user()->name) }}
                            </h5>
                            <p class="text-muted mb-2 font-13 text-truncate">{{ Auth::user()->email }}</p>
                            <small class="text-info"><b>Tu panel de almacenista</b></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    @if (Auth::user()->role == 0 || Auth::user()->role == 1)
    <div class="row">
        @if (count($almacens) > 0)
        @foreach ($almacens as $item)
        <div class="col-xl-3 col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-4">{{ $item->name }} <small>({{$item->products_count}} Productos)</small> </h4>

                    <div class="widget-box-2">
                        <div class="widget-detail-2 text-end">
                            <span class="badge bg-info rounded-pill float-start mt-3">{{$item->percentAdvance}}% <i class="mdi mdi-trending-up"></i> </span>
                            <h2 class="fw-normal mb-1">  ${{$item->sum_amount}}  </h2>
                            <p class="text-muted mb-3">{{$item->entradas}} Entradas | {{ $item->salidas }} Salidas</p>
                        </div>
                        <div class="progress progress-bar-alt-info progress-sm">
                            <div class="progress-bar bg-info" role="progressbar"
                                    aria-valuenow="{{$item->percentAdvance}}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{$item->percentAdvance}}%;">
                                <span class="visually-hidden">{{$item->percentAdvance}}% Complete</span>
                            </div>
                        </div>
                        <section class="d-flex justify-content-end pt-2">
                            <a href="{{ url('view_bodega/'.$item->id) }}" class="btn btn-info">Ver más</a>
                        </section>
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
    @endif
</div>
@endsection