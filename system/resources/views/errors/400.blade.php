@extends('errors::minimal')

@section('title', Str::title(__('errors.400.title')))

@section('code', '400')

@section('message', Str::of(__('errors.400.message'))->title()->toHtmlString())
