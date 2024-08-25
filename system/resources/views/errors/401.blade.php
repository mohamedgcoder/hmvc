@extends('errors::minimal')

@section('title', Str::title(__('errors.401.title')))

@section('code', '401')

@section('message', Str::of(__('errors.401.message'))->title()->toHtmlString())
