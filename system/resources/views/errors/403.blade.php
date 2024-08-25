@extends('errors::minimal')

@section('title', Str::title(__('errors.403.title')))

@section('code', '403')

@section('message', Str::of(__($exception->getMessage() ?: 'errors.403.message'))->title()->toHtmlString())
