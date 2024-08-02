@extends('cfb.base')
@section('title','College Football')
@section('Components')

<div class="flex flex-wrap justify-center">
    @foreach ($organizations as $organization)
        <div class="max-w-sm w-full sm:w-1/2 md:w-1/3 lg:w-1/4 p-4">
            <div class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <a href="#">
                    <img class="rounded-t-lg w-full h-auto" src="{{ asset('storage/'.$organization->logo) }}" alt="" />
                </a>
            </div>
        </div>
    @endforeach
</div>


@endsection