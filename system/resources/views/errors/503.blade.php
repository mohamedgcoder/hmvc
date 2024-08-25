@extends('errors::minimal')

@section('title', Str::title(__('errors.503.title')))

@section('code', '503')

@section('message', Str::of(__('errors.503.message'))->title()->toHtmlString())
