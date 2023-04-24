@extends('layouts.admin.admin')

@section('title', 'Create a State')

@section('content')
    <section>
        <div class="section-body">
            <form class="form form-validate floating-label" action="{{route('state.store')}}" method="POST" enctype="multipart/form-data">
            @include('state.form',['header' => 'Create a State'])
            </form>
        </div>
    </section>
@endsection

