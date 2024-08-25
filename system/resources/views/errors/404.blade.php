@extends('errors::minimal')

@section('title', Str::title(__('errors.404.title')))

@section('code', '404')

@section('message', Str::of(__('errors.404.message'))->title()->toHtmlString())
