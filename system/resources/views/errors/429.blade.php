@extends('errors::minimal')

@section('title', Str::title(__('errors.429.title')))

@section('code', '429')

@section('message', Str::of(__('errors.429.message'))->title()->toHtmlString())
