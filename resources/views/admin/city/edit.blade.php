@extends('layouts.admin')
@section('title')
Listado de ciudades
@endsection
@section('page_active')
ciudades
@endsection
@section('subpage_active')
Editar
@endsection

@section('content')

<section class="pull-up">
    <div class="container-fluid">
        <div class="row ">
            <div class="col-lg-12 mx-auto  mt-2">
                <div class="card py-3 m-b-30">
                    <div class="card-body">
                        {!! Form::model($data, ['url' => [$form_url],'files' => true,'method' => 'PATCH'],['class' => 'col s12']) !!}
                            @include('admin.city.form')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection