@extends('layouts.admin')
@section('title')
Listado de ciudades
@endsection
@section('page_active')
ciudades
@endsection
@section('subpage_active')
Nuevo
@endsection

@section('content')

<section class="pull-up">
    <div class="container-fluid">
        {!! Form::model($data, ['url' => [$form_url],'files' => true],['class' => 'col s12']) !!}
            @include('admin.city.form')
        </form>
    </div>
</section>

@endsection