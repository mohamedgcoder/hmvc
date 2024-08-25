@extends('errors::minimal')

@section('title', Str::title(__('errors.405.title')))

@section('code', '405')

@section('message', Str::of(__('errors.405.message'))->title()->toHtmlString())
