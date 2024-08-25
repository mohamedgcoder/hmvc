@extends('errors::minimal')

@section('title', __('payment_required'))
@section('code', '402')
@section('message', __('payment_required'))


@section('title', Str::title(__('errors.402.title')))

@section('code', '402')

@section('message', Str::of(__('errors.402.message'))->title()->toHtmlString())
