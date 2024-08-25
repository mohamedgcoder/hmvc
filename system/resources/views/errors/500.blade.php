@extends('errors::minimal')

@section('title', Str::title(__('errors.500.title')))

@section('code', '500')

@section('message', Str::of(__('errors.500.message'))->title()->toHtmlString())
